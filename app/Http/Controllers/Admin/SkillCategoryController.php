<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = SkillCategory::orderBy('display_order')->orderBy('name')->paginate(10);

        // return view('admin.skill-categories.index', compact('categories'));
        $categories = SkillCategory::withCount('skills')
            ->orderBy('display_order')
            ->orderBy('name')
            ->paginate(10);
            
        return view('admin.skill-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $maxOrder = SkillCategory::max('display_order')+1;

        // return view('admin.skill-categories.create', compact('maxOrder'));
        return view('admin.skill-categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required|max:255|unique:skill_categories',
        //     'description' => 'nullable|string',
        //     'display_order' => 'nullable|integer|min:0',
        //     'is_active' => 'boolean',
        // ]);

        // if (empty($validated['display_order'])) {
        //     $validated['display_order'] = SkillCategory::max('display_order')+1;
        // }

        // SkillCategory::create($validated);

        // return redirect()->route('admin.skill-categories.index')
        // ->with('success', 'Skill category created successfully.');
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skill_categories',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        SkillCategory::create($validated);

        return redirect()
            ->route('admin.skill-categories.index')
            ->with('success', 'Skill category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SkillCategory $skillCategory)
    {
        $skillCategory->load(['skills' => function($query) {
            $query->oderBy('display_order')->orderBy('name');
        }]);

        return view('admin.skill-categories.show', compact('skillCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SkillCategory $skillCategory)
    {
        // return view('admin.skill-categories.edit', compact('skillCategory'));
        return view('admin.skill-categories.edit', compact('skillCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SkillCategory $skillCategory)
    {
        // $validated = $request->validate([
        //     'name' => 'required|max:255|unique:skill_categories,name,' . $skillCategory->id,
        //     'description' => 'nullable|string',
        //     'display_order' => 'required|integer|min:0',
        //     'is_active' => 'boolean',
        // ]);

        // $skillCategory->update($validated);

        // return redirect()->route('admin.skill-categories.index')
        // ->with('success', 'Skill category updated successfully.');
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skill_categories,name,' . $skillCategory->id,
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($validated['name'] !== $skillCategory->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        
        $skillCategory->update($validated);

        return redirect()
            ->route('admin.skill-categories.index')
            ->with('success', 'Skill category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, SkillCategory $skillCategory)
    {
        // Cek apakah kategori memiliki skills
        // if ($skillCategory->skills()->count() > 0) {
        //     return redirect()->route('admin.skill-categories.index')
        //     ->with('error', 'Cannot delete category that has skills. Move or delete the skills first.');
        // }

        // $skillCategory->delete();

        // return redirect()->route('admin.skill-categories.index')
        // ->with('success', 'Skill category deleted successfully.');
        // Check if category has skills
        if ($skillCategory->skills()->count() > 0) {
            return redirect()
                ->route('admin.skill-categories.index')
                ->with('error', 'Cannot delete category that has skills. Move or delete the skills first.');
        }

        $skillCategory->delete();

        return redirect()
            ->route('admin.skill-categories.index')
            ->with('success', 'Skill category deleted successfully.');
    }

    /**
     * Update display order via drag and drop
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:skill_categories,id',
            'items.*.display_order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            SkillCategory::where('id', $item['id'])->update(['display_order' => $item['display_order']]);
        }

        return response()->json(['message' => 'Order updated successfully.']);
    }

    /**
     * Search/Bulk action for categories
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        
        $categories = SkillCategory::where('name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->orderBy('display_order')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.skill-categories.index', compact('categories', 'search'));
    }

    /**
     * Toggle category status
     */
    public function toggleStatus(SkillCategory $skillCategory)
    {
        $skillCategory->update([
            'is_active' => !$skillCategory->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $skillCategory->is_active,
            'message' => 'Status updated successfully.'
        ]);
    }

    /**
     * Bulk actions (delete, activate, deactivate)
     */
    // public function bulkAction(Request $request)
    // {
    //     $action = $request->action;
    //     $ids = $request->ids;

    //     if (empty($ids)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No items selected.'
    //         ]);
    //     }

    //     switch ($action) {
    //         case 'activate':
    //             SkillCategory::whereIn('id', $ids)->update(['is_active' => true]);
    //             $message = 'Categories activated successfully.';
    //             break;
            
    //         case 'deactivate':
    //             SkillCategory::whereIn('id', $ids)->update(['is_active' => false]);
    //             $message = 'Categories deactivated successfully.';
    //             break;
            
    //         case 'delete':
    //             // Cek apakah ada kategori yang memiliki skills
    //             $categoriesWithSkills = SkillCategory::whereIn('id', $ids)
    //                 ->withCount('skills')
    //                 ->having('skills_count', '>', 0)
    //                 ->get();

    //             if ($categoriesWithSkills->count() > 0) {
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Cannot delete categories that have skills. Move or delete the skills first.'
    //                 ]);
    //             }

    //             SkillCategory::whereIn('id', $ids)->delete();
    //             $message = 'Categories deleted successfully.';
    //             break;
            
    //         default:
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Invalid action.'
    //             ]);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => $message
    //     ]);
    // }
}
