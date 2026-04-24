<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postContents = PostContent::with('post')->latest('id')->paginate(10);
        return view('dashboard.post-contents.index', compact('postContents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::get();
        return view('dashboard.post-contents.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'contents' => 'required|array',
            'contents.*.type' => 'required|string|in:paragraph,feature,code',
            'contents.*.body' => 'nullable|string',
            'contents.*.title' => 'nullable|string|max:255',
        ]);

        // dd($request->all());
        return DB::transaction(function () use ($request) {

            $maxOrder = PostContent::where('post_id', $request->post_id)->max('order');
            $startingOrder = is_null($maxOrder) ? 0 : $maxOrder + 1;

            foreach ($request->contents as $index => $content) {

                PostContent::create([
                    'post_id' => $request->post_id,
                    'type' => $content['type'],
                    'title' => $content['title'] ?? null,
                    'body' => $content['body'] ?? null,
                    'order' => $startingOrder + $index,
                ]);
            }

            flash()->success('Post content created successfully.');
            return redirect()->route('admin.post_contents.index');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(PostContent $postContent)
    {
        $postContent->load('post');
        return view('dashboard.post-contents.show', compact('postContent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostContent $postContent)
    {
        $posts = Post::get();
        $post = $postContent->post->load(['post_contents' => function ($query) {
            $query->orderBy('order');
        }]);
        return view('dashboard.post-contents.edit', compact('postContent', 'posts', 'post'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostContent $postContent)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'contents' => 'required|array',
            'contents.*.id' => 'nullable|exists:post_contents,id',
            'contents.*.type' => 'required|string|in:paragraph,feature,code',
            'contents.*.body' => 'nullable|string',
            'contents.*.title' => 'nullable|string|max:255',

        ]);
        return DB::transaction(function () use ($request) {
            $existingContents = PostContent::where('post_id', $request->post_id)->pluck('id')->flip();

            $idsToKeep = collect($request->contents)->pluck('id')->filter()->toArray();
            if (!empty($idsToKeep)) {
                PostContent::where('post_id', $request->post_id)->whereNotIn('id', $idsToKeep)->delete();
            } else {
                PostContent::where('post_id', $request->post_id)->delete();
            }

            foreach ($request->contents as $index => $content) {

                if (!empty($content['id']) &&  !isset($existingContents[$content['id']])) {
                    PostContent::Create([
                        'post_id' => $request->post_id,
                        'type' => $content['type'],
                        'title' => $content['title'] ?? null,
                        'body' => $content['body'] ?? null,
                        'order' => $index,
                    ]);
                    continue;
                }
                // الي فوق زي الي تحت بس اسرع

                // if (isset($content['id'])) {

                //     $existingContent = PostContent::where('id', $content['id'])->where('post_id', $request->post_id)->first();
                //     if (!$existingContent) {
                //         PostContent::updateOrCreate([
                //             'post_id' => $request->post_id,
                //             'type' => $content['type'],
                //             'title' => $content['title'] ?? null,
                //             'body' => $content['body'] ?? null,
                //             'order' => $index,
                //         ]);
                //         continue;
                //     }
                // }


                PostContent::updateOrCreate(
                    ['id' => $content['id'] ?? null],
                    [
                        'post_id' => $request->post_id,
                        'type' => $content['type'],
                        'title' => $content['title'] ?? null,
                        'body' => $content['body'] ?? null,
                        'order' => $index,
                    ]
                );
            }

            flash()->success('Post content updated successfully.');
            return redirect()->route('admin.post_contents.index');
        });
    }
    // public function update(Request $request, PostContent $postContent)
    // {
    //     $request->validate([
    //         'post_id' => 'required|exists:posts,id',
    //         'contents' => 'required|array',
    //         'contents.*.id' => 'nullable|exists:post_contents,id',
    //         'contents.*.type' => 'required|string|in:paragraph,feature,code',
    //         'contents.*.body' => 'nullable|string',
    //         'contents.*.title' => 'nullable|string|max:255',

    //     ]);
    //     return DB::transaction(function () use ($request, $postContent) {

    //         $idsToKeep = collect($request->contents)->pluck('id')->filter()->toArray();
    //         PostContent::where('post_id', $request->post_id)->whereNotIn('id', $idsToKeep)->delete();

    //         // هذا الكود لو انا بضيف في النهاية مش حسب السحب والاضافة (ترتيب المستخدم)
    //         $maxOrder = PostContent::where('post_id', $request->post_id)->max('order');
    //         $newOrder = is_null($maxOrder) ? 0 : $maxOrder + 1;

    //         // dd($request->all());
    //         foreach ($request->contents as $content) {
    //             if (isset($content['id'])) {

    //                 $existingContent = PostContent::where('id', $content['id'])->where('post_id', $request->post_id)->first();
    //                 if ($existingContent) {

    //                     $existingContent->update([
    //                         'type' => $content['type'],
    //                         'title' => $content['title'] ?? null,
    //                         'body' => $content['body'] ?? null,

    //                     ]);
    //                 } else {
    //                     PostContent::create([
    //                         'post_id' => $request->post_id,
    //                         'type' => $content['type'],
    //                         'title' => $content['title'] ?? null,
    //                         'body' => $content['body'] ?? null,
    //                         'order' => $newOrder,
    //                     ]);
    //                     $newOrder++;
    //                 }
    //             } else {

    //                 PostContent::create([
    //                     'post_id' => $request->post_id,
    //                     'type' => $content['type'],
    //                     'title' => $content['title'] ?? null,
    //                     'body' => $content['body'] ?? null,
    //                     'order' => $newOrder,
    //                 ]);
    //                 $newOrder++;
    //             }
    //         }

    //         flash()->success('Post content updated successfully.');
    //         return redirect()->route('admin.post_contents.index');
    //     });
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostContent $postContent)
    {
        $postContent->delete();
        flash()->success('Post content deleted successfully.');
        return redirect()->route('admin.post_contents.index');
    }

    public function trash()
    {
        $postContents = PostContent::onlyTrashed()->latest('id')->with('post')->paginate(10);
        return view('dashboard.post-contents.trash', compact('postContents'));
    }

    public function restore(PostContent $postContent)
    {

        $postContent->restore();
        $postContents = PostContent::where('post_id', $postContent->post_id)->orderBy('order')->get();
        foreach ($postContents as $index => $content) {
            $content->update(['order' => $index]);
        }
        flash()->success('Post content restored successfully.');
        return redirect()->route('admin.post_contents.index');
    }

    public function forceDelete(PostContent $postContent)
    {
        $postContent->forceDelete();
        flash()->success('Post content permanently deleted successfully.');
        return redirect()->route('admin.post_contents.trash');
    }
}
