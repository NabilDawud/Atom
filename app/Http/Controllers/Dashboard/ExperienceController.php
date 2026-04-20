<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use function Flasher\Prime\flash;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = auth()->user()->experiences()->with('image')->latest('id')->paginate(10);
        return view('dashboard.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        return   DB::transaction(function () use ($request) {
            $experience = auth()->user()->experiences()->create([
                'job_title' => $request->job_title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/experiences', 'custom');
                $experience->image()->create([
                    'path' => $imagePath,
                ]);
            }

            flash()->success('Experience created successfully!');
            return redirect()->route('admin.experiences.index');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        return view('dashboard.experiences.show', compact('experience'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        return view('dashboard.experiences.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        return   DB::transaction(function () use ($request, $experience) {
            $experience->update([
                'job_title' => $request->job_title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
            ]);

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($experience->image) {
                    File::delete($experience->image->path);
                }
                $imagePath = $request->file('image')->store('uploads/experiences', 'custom');
                $experience->image()->updateOrCreate([], [
                    'path' => $imagePath,
                ]);
            }
            flash()->success('Experience updated successfully!');
            return redirect()->route('admin.experiences.index');
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        // Delete the experience
        $experience->delete();

        flash()->success('Experience deleted successfully!');
        return redirect()->route('admin.experiences.index');
    }

    public function trash()
    {
        $experiences = auth()->user()->experiences()->onlyTrashed()->with('image')->latest('id')->paginate(10);
        return view('dashboard.experiences.trash', compact('experiences'));
    }

    public function restore(Experience $experience)
    {
        $experience->restore();

        flash()->success('Experience restored successfully!');
        return redirect()->route('admin.experiences.trash');
    }

    public function forceDelete(Experience $experience)
    {
        // Delete the experience permanently
        $experience->forceDelete();

        flash()->success('Experience permanently deleted!');
        return redirect()->route('admin.experiences.trash');
    }
}
