<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Details</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $post->title . ' ' . __('Details') }}

                </h2>
                <div>
                    <a href="{{ route('admin.post_contents.index') }}"
                        class="ms-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 active:bg-blue-900 disabled:opacity-25 transition">
                        {{ __('Return To Post Contents') }}
                    </a>
                    <a href="{{ route('admin.posts.index') }}"
                        class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                        {{ __('Return To Posts') }}
                    </a>
                </div>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 space-y-0.5">
                        <h3 class="text-lg font-semibold mb-4">{{ $post->title }} Post Categories</h3>
                        <p><strong>ID:</strong> {{ $post->id }}</p>
                        <p><strong>Title:</strong> {{ $post->title }}</p>
                        <p><strong>Summary:</strong> {{ $post->summary }}</p>
                        <p><strong>Published At:</strong> {{ $post->published_at->diffForHumans() }} | <strong> Exactly
                                At:</strong> {{ $post->published_at->format('Y-m-d') }}</p>
                        <p class="mt-1.5"><strong>Categories:</strong>
                            @forelse($categories as $key => $category)
                                <a href="{{ route('admin.categories.show', $category->id) }}"
                                    class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded-full mb-1">{{ $category->name }}</a>
                            @empty
                                <p>No categories found.</p>
                            @endforelse
                        </p>

                        <p class="mt-1.5"><strong>Post Contents:</strong>
                        <div class="rounded shadow p-4 bg-gray-50 prose">
                            @forelse($post->post_contents as $key => $content)
                                @if ($content->title)
                                    <h4 class="font-semibold my-2 text-lg">{{ $content->title }}</h4>
                                @endif

                                @if ($content->type == 'paragraph')
                                    <p class="text-stone-500">{{ $content->body }}</p>
                                @elseif ($content->type == 'feature')
                                    <li class="list-disc text-gray-400 ml-8 px-3">{{ $content->body }}</li>
                                @else
                                    <div class="language-plaintext highlighter-rouge">
                                        <div class="highlight">
                                            <pre class="highlight"><code>{{ $content->body }}</code></pre>
                                        </div>
                                    </div>
                                @endif

                            @empty
                                <p>No post contents found.</p>
                            @endforelse
                        </div>
                        </p>




                        <div>{{ $categories->links() }}</div>
                    </div>
                </div>

            </div>
        </div>
    </x-app-layout>

</body>

</html>
