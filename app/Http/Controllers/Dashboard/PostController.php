<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest('id')->with('categories', 'image')->paginate(10);
        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with('posts')->get();
        return view('dashboard.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'published_at' => 'required|date',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'image' => 'required|image|max:2048',
        ]);
        return DB::transaction(function () use ($request) {
            $post = Post::create($request->only('title', 'summary', 'published_at'));
            $post->categories()->attach($request->input('categories'));

            if ($request->hasFile('image')) {;
                $imagePath = $request->file('image')->store('uploads/posts', 'custom');
                $post->image()->create(['path' => $imagePath]);
            }
            flash()->success('Post created successfully.');
            return redirect()->route('admin.posts.index');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $categories = $post->categories()->with('posts')->latest('id')->paginate(10);
        $post->load(['categories', 'image', 'post_contents' => function ($query) {
            $query->orderBy('order', 'asc');
        }]);
        return view('dashboard.posts.show', compact('post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::with('posts')->get();
        return view('dashboard.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'published_at' => 'required|date',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);
        return DB::transaction(function () use ($request, $post) {
            $post->update($request->only('title', 'summary', 'published_at'));
            $post->categories()->sync($request->input('categories'));

            if ($request->hasFile('image')) {
                if ($post->image) {
                    File::delete(public_path($post->image->path));
                }
                $imagePath = $request->file('image')->store('uploads/posts', 'custom');
                $post->image()->updateOrCreate([], ['path' => $imagePath]);
            }

            flash()->success('Post updated successfully.');
            return redirect()->route('admin.posts.index');
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        flash()->success('Post deleted successfully.');
        return redirect()->route('admin.posts.index');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->latest('id')->with('categories', 'image')->paginate(10);
        return view('dashboard.posts.trash', compact('posts'));
    }

    public function restore(Post $post)
    {
        $post->restore();
        flash()->success('Post restored successfully.');
        return redirect()->route('admin.posts.index');
    }

    public function forceDelete(Post $post)
    {
        if ($post->image) {
            File::delete(public_path($post->image->path));
        }
        $post->forceDelete();
        flash()->success('Post permanently deleted successfully.');
        return redirect()->route('admin.posts.trash');
    }
}
