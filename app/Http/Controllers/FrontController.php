<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Slug;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use function Flasher\Prime\flash;

class FrontController extends Controller
{
    public function index()
    {
        $posts = Post::latest('id')->take(3)->with('image')->get();
        $user = auth()->user() ?? User::first();
        return view('front.index', compact('posts', 'user'));
    }
    public function contact(Request $request)
    {
        $validatedData =   $request->validate([
            'name' => [
                Rule::requiredIf(!auth()->check()),
                'string',
                'max:255'
            ],
            'email' => auth()->check() ?  'nullable' : 'required|email|max:255',
            'message' => 'required|string',
        ]);

        return DB::transaction(function () use ($validatedData) {

            Mail::to('admin@mydomain.com')->send(new ContactMail($validatedData));

            if (auth()->check()) {
                auth()->user()->contacts()->create([
                    'message' => $validatedData['message'],
                ]);
            } else {
                Contact::create($validatedData);
            }

            // طريقة تانية بس الي فوق افضل 
            //  Contact::create([
            //     'user_id' => auth()->id() ?? null,
            //     'name' => auth()->check() ? null : $validatedData['name'],
            //     'email' => auth()->check() ? null : $validatedData['email'],
            //     'message' => $validatedData['message'],
            // ]);

            flash()->success('Your message has been sent successfully!');
            return redirect()->route('front.index');
        });
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            $oldSlug = Slug::where('slug', $slug)->first();
            if ($oldSlug) {
                return redirect()->route('front.post', $oldSlug->sluggable, 301);
            }
            abort(404);
        }

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

    public function subscribe(Request $request)
    {
        $request->validate([
            'subscriber_email' => 'required|email',
        ]);

        $subscriber = Subscriber::where('email', $request->subscriber_email)->first();

        if ($subscriber) {
            if (!$subscriber->is_active) {
                $subscriber->update([
                    'is_active' => true,
                    'unsubscribe_token' => Str::random(40),
                ]);
                flash()->success('You have been re-subscribed successfully!');
            } else {
                flash()->info('You are already subscribed!');
            }
        } else {
            Subscriber::create([
                'email' => $request->subscriber_email,
                'is_active' => true,
                'unsubscribe_token' => Str::random(40),
            ]);

            flash()->success('You have been subscribed successfully!');
        }

        return redirect()->back();
    }

    public function unsubscribe($token)
    {
        $subscriber = Subscriber::where('unsubscribe_token', $token)->firstOrFail();

        if (!$subscriber->is_active) {
            flash()->success('You have already unsubscribed!');
        } else {
            $subscriber->update([
                'is_active' => false
            ]);
            flash()->success('You have been unsubscribed successfully!');
        }
        return view('front.unsubscribed', compact('subscriber'));
    }
}
