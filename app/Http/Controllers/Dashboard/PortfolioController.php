<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use function Flasher\Prime\flash;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = auth()->user()->portfolios()->latest('id')->paginate(10);
        $portfolios->load('image');
        return view('dashboard.portfolios.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.portfolios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
        ]);
        return   DB::transaction(function () use ($request) {
            $portfolio = auth()->user()->portfolios()->create([
                'link' => $request->link,
            ]);

            if ($request->hasFile('image')) {
                $imageName = $request->file('image')->store('uploads/portfolios', 'custom');
                $portfolio->image()->create([
                    'path' => $imageName,
                ]);
            }
            flash()->success('Portfolio created successfully!');
            return redirect()->route('admin.portfolios.index');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        return view('dashboard.portfolios.show', compact('portfolio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio)
    {
        return view('dashboard.portfolios.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'link' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
        ]);

        return   DB::transaction(function () use ($request, $portfolio) {
            $portfolio->update([
                'link' => $request->link,
            ]);

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($portfolio->image) {
                    File::delete($portfolio->image->path);
                }

                $imageName = $request->file('image')->store('uploads/portfolios', 'custom');
                $portfolio->image()->updateOrCreate([], [
                    'path' => $imageName,
                ]);
            }
            flash()->success('Portfolio updated successfully!');
            return redirect()->route('admin.portfolios.index');


            //
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        flash()->success('Portfolio deleted successfully!');
        return redirect()->route('admin.portfolios.index');
    }

    public function trash()
    {
        $portfolios = auth()->user()->portfolios()->onlyTrashed()->with('image')->latest('id')->paginate(10);
        return view('dashboard.portfolios.trash', compact('portfolios'));
    }

    public function restore(Portfolio $portfolio)
    {
        $portfolio->restore();
        flash()->success('Portfolio restored successfully!');
        return redirect()->route('admin.portfolios.trash');
    }

    public function forceDelete(Portfolio $portfolio)
    {
        if ($portfolio->image) {
            File::delete($portfolio->image->path);
        }
        $portfolio->forceDelete();
        flash()->success('Portfolio permanently deleted!');
        return redirect()->route('admin.portfolios.trash');
    }
}
