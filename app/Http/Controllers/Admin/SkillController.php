<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::with('category')
            ->orderBy('display_order')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = SkillCategory::orderBy('name')->pluck('name', 'id');
        $maxOrder = Skill::max('display_order') + 1;

        return view('admin.skills.create', compact('categories', 'maxOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255|unique:skills',
        //     'category_id' => 'nullable|exists:skill_categories,id',
        //     'icon' => 'nullable|string',
        //     'color' => 'nullable|string|max:7',
        //     'level' => 'required|integer|min:0|max:100',
        //     'display_order' => 'nullable|integer|min:0',
        //     'is_featured' => 'nullable|boolean',
        //     'is_active' => 'nullable|boolean',
        //     'description' => 'nullable|string',
        // ]);

        // $validated['is_featured'] = $request->has('is_featured');
        // $validated['is_active'] = $request->has('is_active');
        
        // Skill::create($validated);

        // return redirect()
        //     ->route('admin.skills.index')
        //     ->with('success', 'Skill created successfully.');
        try {
            // Log request data untuk debugging
            Log::info('Skill store request:', $request->all());
            
            // Validasi akan diisi nanti
            
            // Sementara return response dulu
            return response()->json(['message' => 'Test'], 200);
            
        } catch (\Exception $e) {
            Log::error('Error in skill store: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        $categories = SkillCategory::orderBy('name')->pluck('name', 'id');
        
        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skills,name,' . $skill->id,
            'category_id' => 'nullable|exists:skill_categories,id',
            'icon' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'level' => 'required|integer|min:0|max:100',
            'display_order' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        
        $skill->update($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully.');
    }

    /**
     * Bulk update display order
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:skills,id',
            'items.*.display_order' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->items as $item) {
                Skill::where('id', $item['id'])->update([
                    'display_order' => $item['display_order']
                ]);
            }
        });

        return response()->json(['success' => true]);
    }

    /**
     * Toggle skill status
     */
    public function toggleStatus(Skill $skill)
    {
        $skill->update([
            'is_active' => !$skill->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $skill->is_active
        ]);
    }
}
