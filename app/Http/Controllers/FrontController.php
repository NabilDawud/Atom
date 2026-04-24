<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $posts = Post::latest('id')->take(3)->with('image')->get();
        $user = auth()->user() ?? User::first();
        return view('front.index', compact('posts', 'user'));
    }

    public function post(Post $post)
    {
        $relations = [
            'categories',
            'image',
            'post_contents' => function ($query) {
                $query->orderBy('order', 'asc');
            }
        ];

        $user = auth()->user() ?? User::first();
        $post->load($relations);
        $nextPost = Post::where('id', '>', $post->id)->orderBy('id')->first();
        $prevPost = Post::latest('id')->where('id', '<', $post->id)->first();
        return view('front.post', compact('post', 'user', 'nextPost', 'prevPost'));
    }
}
