<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use function Flasher\Prime\flash;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statistics = auth()->user()->statistics()->latest('id')->paginate(10);
        return view('dashboard.statistics.index', compact('statistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.statistics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'image' => 'required|max:2048',
        ]);

        return   DB::transaction(function () use ($request) {
            $statistic = auth()->user()->statistics()->create([
                'name' => $request->name,
                'value' => $request->value,
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/statistics', 'custom');
                $statistic->image()->create([
                    'path' => $imagePath,
                ]);
            }

            flash()->success('Statistic created successfully!');
            return redirect()->route('admin.statistics.index');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Statistic $statistic)
    {
        return view('dashboard.statistics.show', compact('statistic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Statistic $statistic)
    {
        return view('dashboard.statistics.edit', compact('statistic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Statistic $statistic)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'image' => 'nullable|max:2048',
        ]);

        return   DB::transaction(function () use ($request, $statistic) {
            $statistic->update([
                'name' => $request->name,
                'value' => $request->value,
            ]);

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($statistic->image) {
                    File::delete($statistic->image->path);
                }

                $imagePath = $request->file('image')->store('uploads/statistics', 'custom');
                $statistic->image()->updateOrCreate([], [
                    'path' => $imagePath,
                ]);
            }

            flash()->success('Statistic updated successfully!');
            return redirect()->route('admin.statistics.index');


            //
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statistic $statistic)
    {
        // Delete the statistic
        $statistic->delete();

        flash()->success('Statistic deleted successfully!');
        return redirect()->route('admin.statistics.index');
    }

    public function trash()
    {
        $statistics = auth()->user()->statistics()->onlyTrashed()->latest('id')->paginate(10);
        return view('dashboard.statistics.trash', compact('statistics'));
    }

    public function restore(Statistic $statistic)
    {
        $statistic->restore();

        flash()->success('Statistic restored successfully!');
        return redirect()->route('admin.statistics.index');
    }

    public function forceDelete(Statistic $statistic)
    {
        // Delete the statistic permanently
        if ($statistic->image) {
            File::delete($statistic->image->path);
        }
        $statistic->forceDelete();

        flash()->success('Statistic permanently deleted!');
        return redirect()->route('admin.statistics.trash');
    }
}
