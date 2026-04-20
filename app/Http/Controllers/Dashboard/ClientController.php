<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = auth()->user()->clients()->latest('id')->paginate(10);
        $clients->load('image');
        return view('dashboard.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        return   DB::transaction(function () use ($request) {
            $client = auth()->user()->clients()->create([
                'user_id' => auth()->id(),
            ]);

            if ($request->hasFile('image')) {
                $imageName = $request->file('image')->store('uploads/clients', 'custom');
                $client->image()->create([
                    'path' => $imageName,
                ]);
            }
            flash()->success('Client created successfully!');
            return redirect()->route('admin.clients.index');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client->load('image');
        return view('dashboard.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $client->load('image');
        return view('dashboard.clients.edit', compact('client'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        return   DB::transaction(function () use ($request, $client) {
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($client->image) {
                    File::delete($client->image->path);
                }

                $imageName = $request->file('image')->store('uploads/clients', 'custom');
                $client->image()->updateOrCreate([], [
                    'path' => $imageName,
                ]);
            }
            flash()->success('Client updated successfully!');
            return redirect()->route('admin.clients.index');
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {


        $client->delete();
        flash()->success('Client deleted successfully!');
        return redirect()->route('admin.clients.index');
    }

    public function trash()
    {
        $clients = auth()->user()->clients()->onlyTrashed()->latest('id')->paginate(10);
        $clients->load('image');
        return view('dashboard.clients.trash', compact('clients'));
    }

    public function restore(Client $client)
    {
        $client->restore();
        flash()->success('Client restored successfully!');
        return redirect()->route('admin.clients.trash');
    }

    public function forceDelete(Client $client)
    {
        // Delete associated image if exists
        if ($client->image) {
            File::delete($client->image->path);
        }

        $client->forceDelete();
        flash()->success('Client permanently deleted!');
        return redirect()->route('admin.clients.trash');
    }
}
