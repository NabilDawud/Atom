<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Laravel\Mcp\Server;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $services = auth()->user()->services()->latest('id')->paginate(10);
        $services->load('image');
        return view('dashboard.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        return   DB::transaction(function () use ($request) {
            $service = auth()->user()->services()->create([
                'name' => $request->name,
                'content' => $request->content,
            ]);
            // Service::create([
            //     'name' => $request->name,
            //     'content' => $request->content,
            //     'user_id' => auth()->id(), هان لازم اكتبه
            // ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/services', 'custom');
                $service->image()->create(['path' => $imagePath]);
            }
            flash()->success('Service created successfully!');
            return redirect()->route('admin.services.index');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('dashboard.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        return   DB::transaction(function () use ($request, $service, $validated) {
            $service->update([
                'name' => $validated['name'],
                'content' => $validated['content'],
            ]);
            if ($request->hasFile('image')) {

                if ($service->image) {
                    File::delete($service->image->path);
                    $imagePath = $request->file('image')->store('uploads/services', 'custom');
                    $service->image->update(['path' => $imagePath]);
                } else {
                    $imagePath = $request->file('image')->store('uploads/services', 'custom');
                    $service->image()->create(['path' => $imagePath]);
                }
            }
            flash()->success('Service updated successfully!');
            return redirect()->route('admin.services.index');
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        flash()->success('Service deleted successfully!');
        return redirect()->route('admin.services.index');
    }

    public function trash()
    {
        $services = auth()->user()->services()->onlyTrashed()->with('image')->latest('id')->paginate(10);
        return view('dashboard.services.trash', compact('services'));
    }

    public function restore(Service $service)
    {
        $service->restore();
        flash()->success('Service restored successfully!');
        return redirect()->route('admin.services.trash');
    }

    public function forceDelete(Service $service)
    {
        if ($service->image) {
            File::delete($service->image->path);
        }

        $service->forceDelete();
        flash()->success('Service permanently deleted!');
        return redirect()->route('admin.services.trash');
    }
}
