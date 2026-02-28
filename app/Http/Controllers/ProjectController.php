<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $projects = Project::with('skills')
        //     ->published()
        //     ->ordered()
        //     ->paginate(12);
            
        // $featuredProjects = Project::with('skills')
        //     ->published()
        //     ->featured()
        //     ->latest()
        //     ->take(4)
        //     ->get();
            
        // // Get all skills for filter
        // $skills = Skill::orderBy('name')->get();

        // return view('projects.index', compact('projects', 'featuredProjects', 'skills'));
        $query = Project::published();
    
        // Filter by search
        if ($request->has('q') && !empty($request->q)) {
            $query->search($request->q);
        }
        
        // Filter by status/featured
        if ($request->has('filter')) {
            switch($request->filter) {
                case 'featured':
                    $query->where('is_featured', true);
                    break;
                case 'completed':
                    $query->where('status', 'completed');
                    break;
                case 'in_progress':
                    $query->where('status', 'in_progress');
                    break;
            }
        }
        
        // Sorting
        switch($request->get('sort', 'newest')) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'popular':
                $query->orderBy('view_count', 'desc');
                break;
            case 'name':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $projects = $query->paginate(9)->withQueryString();
        
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        // Cek apakah project published atau user adalah admin
        // Jika tidak published dan user bukan admin, tampilkan 404
        // Cek visibility
        // Dapatkan user yang sedang login dengan benar
        $user = Auth::user(); // Gunakan Auth::user() bukan auth()->user()
        $isAdmin = $this->isAdmin($user);
        
        if (!$project->is_published && !$isAdmin) {
            abort(404);
        }
        
        // Increment view count
        // $project->increment('view_count');
        // Increment view count hanya jika bukan admin (untuk menghindari view count palsu)
        if (!$isAdmin) {
            $project->increment('view_count');
        }
        
        // Get related projects
        $relatedProjects = $this->getRelatedProjects($project);

        return view('projects.show', compact('project', 'relatedProjects', 'isAdmin'));
    }

    /**
     * Increment like count
     */
    public function like(Project $project)
    {
        $project->increment('likes_count');
        
        return response()->json([
            'success' => true,
            'likes_count' => number_format($project->likes_count)
        ]);
    }

    /**
     * Increment share count
     */
    public function share(Project $project, Request $request)
    {
        $project->increment('shares_count');
        
        return response()->json([
            'success' => true,
            'shares_count' => number_format($project->shares_count)
        ]);
    }

    /**
     * Get related projects
     */
    private function getRelatedProjects(Project $project)
    {
        $query = Project::published()
            ->where('id', '!=', $project->id);
            
        // Related by skills
        if ($project->skills->count() > 0) {
            $query->whereHas('skills', function($q) use ($project) {
                $q->whereIn('skills.id', $project->skills->pluck('id'));
            });
        }
        
        // Or by category (jika ada)
        if ($project->categories && count($project->categories) > 0) {
            $query->orWhere(function($q) use ($project) {
                foreach ($project->categories as $category) {
                    $q->orWhereJsonContains('categories', $category);
                }
            });
        }
        
        return $query->latest()
            ->take(4)
            ->get();
    }

    /**
     * Filter projects by skill
     */
    public function filterBySkill($skillSlug)
    {
        $skill = Skill::where('slug', $skillSlug)->firstOrFail();
        
        $projects = Project::with('skills')
            ->published()
            ->whereHas('skills', function($query) use ($skill) {
                $query->where('skills.id', $skill->id);
            })
            ->ordered()
            ->paginate(12);
            
        $skills = Skill::orderBy('name')->get();
            
        return view('admin.projects.index', [
            'projects' => $projects,
            'skills' => $skills,
            'featuredProjects' => Project::published()->featured()->take(4)->get(),
            'activeSkill' => $skill
        ]);
    }

    /**
     * Search projects
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
            
        return view('projects.index', [
            'projects' => $projects,
            'skills' => $skills,
            'featuredProjects' => Project::published()->featured()->take(4)->get(),
            'searchQuery' => $query
        ]);
    }

    /**
     * Check if current user is admin
     */
    private function isAdmin($user = null)
    {
        // Jika tidak ada user, return false
        if (!$user) {
            return false;
        }
        
        // Cek jika user memiliki property is_admin
        if (property_exists($user, 'is_admin') && $user->is_admin === true) {
            return true;
        }
        
        // Cek berdasarkan email (contoh sederhana)
        $adminEmails = [
            'admin@example.com',
            'administrator@example.com',
            // tambahkan email admin sesuai kebutuhan
        ];
        
        return in_array($user->email, $adminEmails);
        
        // Jika menggunakan spatie/laravel-permission:
        // return $user->hasRole('admin');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
