<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Flasher\Prime\flash;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->withCount('posts')->paginate(10);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::latest('id')->get();
        return view('dashboard.categories.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'posts' => 'array',
            'posts.*' => 'exists:posts,id',
        ]);

        return   DB::transaction(function () use ($request) {
            $category = Category::create($request->only('name'));
            $category->posts()->attach($request->input('posts'));
            flash()->success('Category created successfully.');
            return redirect()->route('admin.categories.index');
        });
    }

    /**
     * show the specified resource.
     */

    public function show(Category $category)
    {
        // بدي اعرض الposts تعت كل category بس مش عارف هل اعملها من زر العين او من خلال الname تاعها ايش احسن

        $posts = $category->posts()->with('categories')->latest('id')->paginate(10);
        return view('dashboard.categories.show', compact('category', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $posts = Post::latest('id')->get();
        return view('dashboard.categories.edit', compact('category', 'posts'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'posts' => 'array',
            'posts.*' => 'exists:posts,id',
        ]);

        return   DB::transaction(function () use ($request, $category) {
            $category->update($request->only('name'));
            $category->posts()->sync($request->input('posts', []));
            flash()->success('Category updated successfully.');
            return redirect()->route('admin.categories.index');
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        flash()->success('Category deleted successfully.');
        return redirect()->route('admin.categories.index');
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->withCount('posts')->latest('id')->paginate(10);
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore(Category $category)
    {
        $category->restore();
        flash()->success('Category restored successfully.');
        return redirect()->route('admin.categories.index');
    }

    public function forceDelete(Category $category)
    {
        $category->forceDelete();
        flash()->success('Category permanently deleted successfully.');
        return redirect()->route('admin.categories.trash');
    }

    public function catPosts(Category $category)
    { // بدي اعرض الposts تعت كل category بس مش عارف هل اعملها من زر العين او من خلال الname تاعها ايش احسن

        $posts = $category->posts()->with('categories', 'image')->latest('id')->paginate(10);
        return view('dashboard.categories.category-posts', compact('category', 'posts'));
    }
}
