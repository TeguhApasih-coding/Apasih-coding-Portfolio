<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $statusFilter = $request->get('statusFilter', '');
        $featuredFilter = $request->get('featuredFilter', '');
        $publishedFilter = $request->get('publishedFilter', '');
        $perPage = $request->get('perPage', 10);
        $sortField = $request->get('sortField', 'created_at');
        $sortDirection = $request->get('sortDirection', 'desc');
        
        // Query projects dengan filter
        $query = Project::query();
        
        // Filter search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('short_description', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('client', 'like', '%' . $search . '%');
            });
        }
        
        // Filter status
        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }
        
        // Filter featured
        if ($featuredFilter === 'featured') {
            $query->where('is_featured', true);
        } elseif ($featuredFilter === 'not_featured') {
            $query->where('is_featured', false);
        }
        
        // Filter published
        if ($publishedFilter === 'published') {
            $query->where('is_published', true);
        } elseif ($publishedFilter === 'draft') {
            $query->where('is_published', false);
        }
        
        // Sorting
        $query->orderBy($sortField, $sortDirection);
        
        // Pagination
        $projects = $query->paginate($perPage);

        $projects = Project::latest()->paginate(10);
        $totalProjects = Project::count();
        $publishedProjects = Project::where('is_published', true)->count();
        $featuredProjects = Project::where('is_featured', true)->count();
        return view('admin.projects.index', [
            'projects' => $projects,
            'totalProjects' => $totalProjects,
            'publishedProjects' => $publishedProjects,
            'featuredProjects' => $featuredProjects,
            'statusOptions' => [
                'completed' => 'Completed',
                'in_progress' => 'In Progress',
                'planned' => 'Planned',
                'on_hold' => 'On Hold',
            ],
            'search' => $search,
            'statusFilter' => $statusFilter,
            'featuredFilter' => $featuredFilter,
            'publishedFilter' => $publishedFilter,
            'perPage' => $perPage,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create', [
            'skills' => Skill::all(),
            'statusOptions' => [
                'completed' => 'Completed',
                'in_progress' => 'In Progress',
                'planned' => 'Planned',
                'on_hold' => 'On Hold',
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            // Basic Information
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'conclusion' => 'nullable|string',
            
            // Project Status & Visibility
            'status' => 'required|in:completed,in_progress,planned,on_hold',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
            
            // Project Timeline
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'published_at' => 'nullable|date',
            
            // Technologies & Skills
            'technologies' => 'nullable|array',
            'technologies.*' => 'string|max:100',
            'categories' => 'nullable|array',
            'categories.*' => 'string|max:100',
            'client' => 'nullable|string|max:255',
            'client_url' => 'nullable|url|max:255',
            
            // Links & Resources
            'live_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'demo_url' => 'nullable|url|max:255',
            'documentation_url' => 'nullable|url|max:255',
            
            // SEO & Meta
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            
            // Media Gallery
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
            // Project Complexity & Details
            'estimated_hours' => 'nullable|integer|min:0',
            'budget' => 'nullable|numeric|min:0',
            'budget_currency' => 'nullable|string|max:3',
            'complexity' => 'nullable|in:beginner,intermediate,advanced,expert',
            
            // Team & Collaboration
            // DIHAPUS: 'user_id' => 'nullable|exists:users,id', // Tidak perlu validasi ini
            'team_members' => 'nullable|json',
            'collaborators' => 'nullable|json',
            
            // Project Challenges & Solutions
            'challenges' => 'nullable|string',
            'solutions' => 'nullable|string',
            'lessons_learned' => 'nullable|string',
            
            // Skills relationship
            'skill_ids' => 'nullable|array',
            'skill_ids.*' => 'exists:skills,id',
        ]);

        // Set default values
        $validated['user_id'] = $validated['user_id'] ?? Auth::id();
        $validated['is_published'] = $request->has('is_published');
        $validated['is_featured'] = $request->has('is_featured');
        
        // Handle main image upload
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('projects/images', 'public');
        //     $validated['image'] = $imagePath;
        // }

        // Handle main image upload ke public folder
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
            $folder = 'images/projects';
            
            // Pindahkan file ke public folder
            $image->move(public_path($folder), $fileName);
            
            // Simpan path relatif ke public
            $validated['image'] = $folder . '/' . $fileName;
        }
        
        // Handle thumbnail upload
        // if ($request->hasFile('thumbnail')) {
        //     $thumbnailPath = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        //     $validated['thumbnail'] = $thumbnailPath;
        // }

        // Handle thumbnail upload ke public folder
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $fileName = time() . '_thumb_' . Str::slug(pathinfo($thumbnail->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $thumbnail->getClientOriginalExtension();
            $folder = 'images/projects/thumbnails';
            
            // Pindahkan file ke public folder
            $thumbnail->move(public_path($folder), $fileName);
            
            // Simpan path relatif ke public
            $validated['thumbnail'] = $folder . '/' . $fileName;
        }
        
        // Handle gallery uploads
        // if ($request->hasFile('gallery')) {
        //     $galleryPaths = [];
        //     foreach ($request->file('gallery') as $galleryImage) {
        //         $galleryPaths[] = $galleryImage->store('projects/gallery', 'public');
        //     }
        //     $validated['gallery'] = json_encode($galleryPaths);
        // }

        // Handle gallery uploads
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            $folder = 'images/projects/gallery';
            
            foreach ($request->file('gallery') as $index => $galleryImage) {
                $fileName = time() . '_gallery_' . $index . '_' . Str::slug(pathinfo($galleryImage->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $galleryImage->getClientOriginalExtension();
                
                // Pindahkan file ke public folder
                $galleryImage->move(public_path($folder), $fileName);
                
                $galleryPaths[] = $folder . '/' . $fileName;
            }
            
            $validated['gallery'] = json_encode($galleryPaths);
        }
        
        // Convert arrays to JSON if needed
        if (isset($validated['technologies'])) {
            $validated['technologies'] = json_encode(array_filter($validated['technologies']));
        }
        
        if (isset($validated['categories'])) {
            $validated['categories'] = json_encode(array_filter($validated['categories']));
        }
        
        if (isset($validated['meta_keywords']) && is_string($validated['meta_keywords'])) {
            $keywords = array_map('trim', explode(',', $validated['meta_keywords']));
            $validated['meta_keywords'] = json_encode($keywords);
        }

        // Create project
        $project = Project::create($validated);
        
        // Attach skills
        if ($request->has('skill_ids')) {
            $project->skills()->attach($request->skill_ids);
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        $project->increment('view_count');
        $relatedProjects = Project::where('id', '!=', $id)->published()->take(4)->get();
        return view('admin.projects.show', compact('project', 'relatedProjects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::with('skills')->findOrFail($id);
        return view('admin.projects.edit', [
            'project' => $project,
            'skills' => Skill::all(),
            'statusOptions' => [
                'completed' => 'Completed',
                'in_progress' => 'In Progress',
                'planned' => 'Planned',
                'on_hold' => 'On Hold',
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // dd($project);
        Log::info('Update project called', [
            // 'id' => $id,
            'method' => $request->method(),
            'all_data' => $request->all()
        ]);

        // $project = Project::findOrFail($id);

        // Validasi data
        $validated = $request->validate([
            // Basic Information
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,' . $project->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'conclusion' => 'nullable|string',
            
            // Project Status & Visibility
            'status' => 'required|in:completed,in_progress,planned,on_hold',
            'is_published' => 'nullable',
            'is_featured' => 'nullable',
            'sort_order' => 'nullable|integer',
            
            // Project Timeline
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'published_at' => 'nullable|date',
            
            // Technologies & Skills
            'technologies' => 'nullable|array',
            'technologies.*' => 'string|max:100',
            'categories' => 'nullable|array',
            'categories.*' => 'string|max:100',
            'client' => 'nullable|string|max:255',
            'client_url' => 'nullable|url|max:255',
            
            // Links & Resources
            'live_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'demo_url' => 'nullable|url|max:255',
            'documentation_url' => 'nullable|url|max:255',
            
            // SEO & Meta
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            
            // Media Gallery
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
            // Project Complexity & Details
            'estimated_hours' => 'nullable|integer|min:0',
            'budget' => 'nullable|numeric|min:0',
            'budget_currency' => 'nullable|string|max:3',
            'complexity' => 'nullable|in:beginner,intermediate,advanced,expert',
            
            // Team & Collaboration
            'team_members' => 'nullable|string',
            'collaborators' => 'nullable|string',
            
            // Project Challenges & Solutions
            'challenges' => 'nullable|string',
            'solutions' => 'nullable|string',
            'lessons_learned' => 'nullable|string',
            
            // Skills relationship
            'skill_ids' => 'nullable|array',
            'skill_ids.*' => 'exists:skills,id',
        ]);

        // Set boolean values dengan benar
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        
        // Handle main image upload
        // if ($request->hasFile('image')) {
        //     // Delete old image if exists
        //     if ($project->image && !str_starts_with($project->image, 'http')) {
        //         Storage::disk('public')->delete($project->image);
        //     }
        //     $imagePath = $request->file('image')->store('projects/images', 'public');
        //     $validated['image'] = $imagePath;
        // } else {
        //     // Pertahankan image lama jika tidak ada file baru
        //     $validated['image'] = $project->image;
        // }

        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists and not default
            if ($project->image && file_exists(public_path($project->image)) && !str_contains($project->image, 'default')) {
                unlink(public_path($project->image));
            }
            
            $image = $request->file('image');
            $fileName = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
            $folder = 'images/projects';
            
            $image->move(public_path($folder), $fileName);
            $validated['image'] = $folder . '/' . $fileName;
        }
        
        // Handle thumbnail upload
        // if ($request->hasFile('thumbnail')) {
        //     // Delete old thumbnail if exists
        //     if ($project->thumbnail && !str_starts_with($project->thumbnail, 'http')) {
        //         Storage::disk('public')->delete($project->thumbnail);
        //     }
        //     $thumbnailPath = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        //     $validated['thumbnail'] = $thumbnailPath;
        // } else {
        //     // Pertahankan thumbnail lama jika tidak ada file baru
        //     $validated['thumbnail'] = $project->thumbnail;
        // }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($project->thumbnail && file_exists(public_path($project->thumbnail)) && !str_contains($project->thumbnail, 'default')) {
                unlink(public_path($project->thumbnail));
            }
            
            $thumbnail = $request->file('thumbnail');
            $fileName = time() . '_thumb_' . Str::slug(pathinfo($thumbnail->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $thumbnail->getClientOriginalExtension();
            $folder = 'images/projects/thumbnails';
            
            $thumbnail->move(public_path($folder), $fileName);
            $validated['thumbnail'] = $folder . '/' . $fileName;
        }
        
        // Handle gallery uploads
        // if ($request->has('clear_gallery') && $request->clear_gallery == '1') {
        //     // Delete all gallery images
        //     if ($project->gallery) {
        //         $galleryImages = is_string($project->gallery) ? json_decode($project->gallery, true) : $project->gallery;
        //         if (is_array($galleryImages)) {
        //             foreach ($galleryImages as $image) {
        //                 if (!str_starts_with($image, 'http')) {
        //                     Storage::disk('public')->delete($image);
        //                 }
        //             }
        //         }
        //     }
        //     $validated['gallery'] = json_encode([]);
        // } elseif ($request->hasFile('gallery')) {
        //     // Get existing gallery
        //     $existingGallery = [];
        //     if ($project->gallery) {
        //         $existingGallery = is_string($project->gallery) ? json_decode($project->gallery, true) : $project->gallery;
        //         if (!is_array($existingGallery)) {
        //             $existingGallery = [];
        //         }
        //     }
            
        //     // Add new gallery images
        //     foreach ($request->file('gallery') as $galleryImage) {
        //         $existingGallery[] = $galleryImage->store('projects/gallery', 'public');
        //     }
            
        //     $validated['gallery'] = json_encode($existingGallery);
        // } else {
        //     // Pertahankan gallery lama
        //     $validated['gallery'] = $project->gallery;
        // }

        // Handle gallery uploads
        if ($request->has('clear_gallery') && $request->clear_gallery == '1') {
            // Delete all gallery images
            if ($project->gallery) {
                $galleryImages = is_string($project->gallery) ? json_decode($project->gallery, true) : $project->gallery;
                if (is_array($galleryImages)) {
                    foreach ($galleryImages as $image) {
                        if (file_exists(public_path($image)) && !str_contains($image, 'default')) {
                            unlink(public_path($image));
                        }
                    }
                }
            }
            $validated['gallery'] = json_encode([]);
        } elseif ($request->hasFile('gallery')) {
            // Get existing gallery
            $existingGallery = [];
            if ($project->gallery) {
                $existingGallery = is_string($project->gallery) ? json_decode($project->gallery, true) : $project->gallery;
                if (!is_array($existingGallery)) {
                    $existingGallery = [];
                }
            }
            
            // Add new gallery images
            $folder = 'images/projects/gallery';
            foreach ($request->file('gallery') as $index => $galleryImage) {
                $fileName = time() . '_gallery_' . $index . '_' . Str::slug(pathinfo($galleryImage->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $galleryImage->getClientOriginalExtension();
                
                $galleryImage->move(public_path($folder), $fileName);
                $existingGallery[] = $folder . '/' . $fileName;
            }
            
            $validated['gallery'] = json_encode($existingGallery);
        }
        
        // Handle technologies - pastikan selalu array
        if ($request->has('technologies')) {
            $technologies = $request->input('technologies', []);
            if (is_array($technologies)) {
                $validated['technologies'] = json_encode(array_values(array_filter($technologies)));
            } else {
                $validated['technologies'] = json_encode([]);
            }
        } else {
            $validated['technologies'] = json_encode([]);
        }
        
        // Handle categories - pastikan selalu array
        if ($request->has('categories')) {
            $categories = $request->input('categories', []);
            if (is_array($categories)) {
                $validated['categories'] = json_encode(array_values(array_filter($categories)));
            } else {
                $validated['categories'] = json_encode([]);
            }
        } else {
            $validated['categories'] = json_encode([]);
        }

        // Handle meta_keywords
        if ($request->filled('meta_keywords')) {
            $keywords = array_map('trim', explode(',', $request->meta_keywords));
            $validated['meta_keywords'] = json_encode(array_filter($keywords));
        } else {
            $validated['meta_keywords'] = null;
        }

        // Hapus field yang tidak diperlukan
        unset($validated['clear_gallery']);
        unset($validated['gallery.*']);
        
        // try {
        //     // Update project
        //     $project->update($validated);
            
        //     // Sync skills
        //     if ($request->has('skill_ids')) {
        //         $project->skills()->sync($request->skill_ids);
        //     } else {
        //         $project->skills()->detach();
        //     }

        //     return redirect()->route('admin.projects.index')
        //         ->with('success', 'Project updated successfully!');
                
        // } catch (\Exception $e) {
        //     Log::error('Error updating project: ' . $e->getMessage(), [
        //         'trace' => $e->getTraceAsString()
        //     ]);
            
        //     return redirect()->back()
        //         ->withInput()
        //         ->with('error', 'Error updating project: ' . $e->getMessage());
        // }

        try {
            // Update project
            $project->update($validated);
            
            // Sync skills
            if ($request->has('skill_ids')) {
                $project->skills()->sync($request->skill_ids);
            } else {
                $project->skills()->detach();
            }

            return redirect()->route('admin.projects.index')
                ->with('success', 'Project updated successfully!');
                
        } catch (\Exception $e) {
            Log::error('Error updating project: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating project: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        
        // Delete associated images
        // if ($project->thumbnail_url && !str_starts_with($project->thumbnail_url, 'http')) {
        //     Storage::delete('public/' . $project->thumbnail_url);
        // }
        
        // // Delete gallery images jika ada
        // if ($project->gallery && is_array($project->gallery)) {
        //     foreach ($project->gallery as $image) {
        //         if (!str_starts_with($image, 'http')) {
        //             Storage::delete('public/' . $image);
        //         }
        //     }
        // }

        // Delete associated images
        if ($project->image && file_exists(public_path($project->image)) && !str_contains($project->image, 'default')) {
            unlink(public_path($project->image));
        }
        
        if ($project->thumbnail && file_exists(public_path($project->thumbnail)) && !str_contains($project->thumbnail, 'default')) {
            unlink(public_path($project->thumbnail));
        }
        
        // Delete gallery images
        if ($project->gallery) {
            $galleryImages = is_string($project->gallery) ? json_decode($project->gallery, true) : $project->gallery;
            if (is_array($galleryImages)) {
                foreach ($galleryImages as $image) {
                    if (file_exists(public_path($image)) && !str_contains($image, 'default')) {
                        unlink(public_path($image));
                    }
                }
            }
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    /**
     * Bulk actions for multiple projects
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $selectedProjects = $request->input('selected_projects', []);
        
        if (empty($selectedProjects) || empty($action)) {
            return redirect()->back()->with('error', 'No projects selected or no action specified.');
        }

        switch ($action) {
            case 'publish':
                Project::whereIn('id', $selectedProjects)->update(['is_published' => true]);
                $message = 'Selected projects have been published successfully!';
                break;
                
            case 'unpublish':
                Project::whereIn('id', $selectedProjects)->update(['is_published' => false]);
                $message = 'Selected projects have been unpublished successfully!';
                break;
                
            case 'feature':
                Project::whereIn('id', $selectedProjects)->update(['is_featured' => true]);
                $message = 'Selected projects have been featured successfully!';
                break;
                
            case 'unfeature':
                Project::whereIn('id', $selectedProjects)->update(['is_featured' => false]);
                $message = 'Selected projects have been unfeatured successfully!';
                break;
                
            case 'delete':
                Project::whereIn('id', $selectedProjects)->delete();
                $message = 'Selected projects have been deleted successfully!';
                break;
                
            default:
                return redirect()->back()->with('error', 'Invalid action specified.');
        }

        return redirect()->route('admin.projects.index')->with('success', $message);
    }

    /**
     * Search projects (for the old search route)
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $projects = Project::with('skills')
            ->published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('short_description', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%');
            })
            ->ordered()
            ->paginate(12);
            
        $skills = Skill::orderBy('name')->get();
            
        return view('admin.projects.index', [
            'projects' => $projects,
            'skills' => $skills,
            'featuredProjects' => Project::published()->featured()->take(4)->get(),
            'searchQuery' => $query,
            // Tambahkan parameter lainnya
            'search' => $query,
            'totalProjects' => Project::count(),
            'publishedProjects' => Project::where('is_published', true)->count(),
            'featuredProjects' => Project::where('is_featured', true)->count(),
            'statusOptions' => [
                'completed' => 'Completed',
                'in_progress' => 'In Progress',
                'planned' => 'Planned',
                'on_hold' => 'On Hold',
            ],
        ]);
    }
}
