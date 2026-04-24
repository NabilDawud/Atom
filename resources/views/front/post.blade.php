@extends('front.master')

@section('title', 'Post | ' . env('APP_NAME'))
@section('navbar', 'bg-primary')

@section('content')

    <div>
        <div class="container py-6 md:py-10">
            <div class="mx-auto max-w-4xl">
                <div class="">
                    <h1 class="pt-5 font-body text-3xl font-semibold text-primary sm:text-4xl md:text-5xl xl:text-6xl">
                        {{ $post->title }}
                    </h1>
                    <div class="flex items-center pt-5 md:pt-10">
                        <div>
                            <img src="{{ asset($user->profile->image->path) }}"
                                class="h-20 w-20 rounded-full border-2 border-grey-70 shadow" alt="author image" />
                        </div>
                        <div class="pl-5">
                            <span class="block font-body text-xl font-bold text-grey-10">By {{ $user->name }}</span>
                            <span
                                class="block pt-1 font-body text-xl font-bold text-grey-30">{{ $post->published_at->format('F j, Y') }}</span>
                        </div>
                    </div>
                </div>
                <span class="hidden">{{ $count_title = 0 }}</span>
                <div id="content-parent" class="prose max-w-none pt-8">
                    @foreach ($post->post_contents as $content)
                        @if (@isset($content->title) && $content->title != null)
                            @if ($count_title == 0)
                                <h2 id="{{ Str::slug($content->title) }}">{{ $content->title }}</h2>
                            @elseif ($count_title == 1)
                                <h3 id="{{ Str::slug($content->title) }}">{{ $content->title }}</h3>
                            @else
                                <h4 id="{{ Str::slug($content->title) }}">{{ $content->title }}</h4>
                            @endif

                            <span class="hidden">{{ $count_title++ }}</span>
                        @endif

                        @if ($content->type == 'paragraph')
                            <p>{{ $content->body }}</p>
                        @elseif ($content->type == 'feature')
                            <li>{{ $content->body }}</li>
                        @else
                            <div class="language-plaintext highlighter-rouge">
                                <div class="highlight">
                                    <pre class="highlight"><code>{{ $content->body }}</code></pre>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="flex pt-10">
                    @foreach ($post->categories as $category)
                        <a href="/"
                            class="mr-2 rounded-xl bg-primary px-4 py-1 font-body font-bold text-white hover:bg-grey-20">{{ $category->name }}</a>
                    @endforeach

                </div>
                <div class="mt-10 flex justify-between border-t border-lila py-12">
                    @if ($prevPost)
                        <a href="{{ route('front.post', $prevPost) }}" class="flex items-center">
                            <i class="bx bx-left-arrow-alt text-2xl text-primary"></i>
                            <span class="block pl-2 font-body text-lg font-bold uppercase text-primary md:pl-5">Previous
                                Post</span>
                        </a>
                    @else
                        <button disabled class="flex items-center disabled:cursor-not-allowed">
                            <i class="bx bx-left-arrow-alt text-2xl text-primary"></i>
                            <span class="block pl-2 font-body text-lg font-bold uppercase text-primary md:pl-5">Previous
                                Post</span>
                        </button>
                    @endif
                    @if ($nextPost)
                        <a href="{{ route('front.post', $nextPost) }}" class="flex items-center">
                            <span class="block pr-2 font-body text-lg font-bold uppercase text-primary md:pr-5">Next
                                Post</span>
                            <i class="bx bx-right-arrow-alt text-2xl text-primary"></i>
                        </a>
                    @else
                        <button disabled class="flex items-center disabled:cursor-not-allowed">
                            <span class="block pr-2 font-body text-lg font-bold uppercase text-primary md:pr-5">Next
                                Post</span>
                            <i class="bx bx-right-arrow-alt text-2xl text-primary"></i>
                        </button>
                    @endif

                </div>
                <div
                    class="flex flex-col items-center border-t border-lila py-12 pt-12 md:flex-row md:items-start xl:pb-20">
                    <div class="w-3/4 sm:w-2/5 lg:w-1/4 xl:w-1/5">
                        <img src="{{ asset($user->profile->image->path) }}" class="rounded-full shadow"
                            alt="author image" />
                    </div>
                    <div class="ml-0 text-center md:ml-10 md:w-5/6 md:text-left">
                        <h3 class="pt-10 font-body text-2xl font-bold text-secondary md:pt-0">
                            {{ $user->name }}
                        </h3>
                        <p
                            class="pt-5 font-body text-lg leading-8 text-secondary sm:leading-9 md:text-xl md:leading-9 lg:leading-9 xl:leading-9">
                            {{ $user->profile->description }}

                        </p>
                        <div class="flex items-center justify-center pt-5 md:justify-start">
                            <a href="/">
                                <i class="bx bxl-facebook-square text-2xl text-primary hover:text-yellow"></i>
                            </a>
                            <a href="/" class="pl-4">
                                <i class="bx bxl-twitter text-2xl text-primary hover:text-yellow"></i>
                            </a>
                            <a href="/" class="pl-4">
                                <i class="bx bxl-dribbble text-2xl text-primary hover:text-yellow"></i>
                            </a>
                            <a href="/" class="pl-4">
                                <i class="bx bxl-linkedin text-2xl text-primary hover:text-yellow"></i>
                            </a>
                            <a href="/" class="pl-4">
                                <i class="bx bxl-instagram text-2xl text-primary hover:text-yellow"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const content = document.querySelector('#content-parent');
            let node = content.firstChild;

            while (node) {
                if (node.nodeName === 'LI') {
                    const ul = document.createElement('ul');

                    // نحفظ المرجع قبل ما يتغير
                    let next = node;

                    while (next && next.nodeName === 'LI') {
                        let current = next;
                        next = next.nextSibling;
                        ul.appendChild(current);
                    }

                    content.insertBefore(ul, next);
                    node = next;
                } else {
                    node = node.nextSibling;
                }
            }
        });
    </script>
@endsection
