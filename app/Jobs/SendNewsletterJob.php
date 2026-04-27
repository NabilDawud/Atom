<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendNewsletterJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subscribers = Subscriber::where('is_active', true)->get();
        $posts = Post::latest()->take(10)->get();
        foreach ($subscribers as $subscriber) {
          
            Mail::to($subscriber->email)->send(new NewsletterMail($posts , $subscriber));
        }
    }
}
