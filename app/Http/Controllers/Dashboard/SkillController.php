<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

use function Flasher\Prime\flash;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = auth()->user()->skills()->latest('id')->paginate(10);
        return view('dashboard.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        auth()->user()->skills()->create($validated);
        flash()->success('Skill created successfully!');
        return redirect()->route('admin.skills.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        return view('dashboard.skills.show', compact('skill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        return view('dashboard.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        $skill->update($validated);
        flash()->success('Skill updated successfully!');
        return redirect()->route('admin.skills.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();
        flash()->success('Skill deleted successfully!');
        return redirect()->route('admin.skills.index');
    }

    public function trash()
    {
        $skills = auth()->user()->skills()->onlyTrashed()->latest('id')->paginate(10);
        return view('dashboard.skills.trash', compact('skills'));
    }

    public function restore(Skill $skill)
    {
        $skill->restore();
        flash()->success('Skill restored successfully!');
        return redirect()->route('admin.skills.trash');
    }

    public function forceDelete(Skill $skill)
    {
        $skill->forceDelete();
        flash()->success('Skill permanently deleted!');
        return redirect()->route('admin.skills.trash');
    }
}
