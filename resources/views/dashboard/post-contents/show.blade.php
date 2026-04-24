<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Content</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Post Content') }}

                </h2>
                <a href="{{ route('admin.post_contents.index') }}"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                    {{ __('Return Back') }}
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 space-y-0.5">
                        <h3 class="text-lg font-semibold mb-4">{{ $postContent->post->title }} Post</h3>
                        <p class="mb-3"><strong>Image:</strong>
                            @if ($postContent->post->image)
                                <img src="{{ asset($postContent->post->image->path) }}"
                                    alt="{{ $postContent->post->title }}" class="w-24 h-24 object-cover rounded mt-0.5">
                            @else
                                <span class="text-gray-500">No Image</span>
                            @endif
                        </p>
                        <p><strong>Post Published At:</strong> {{ $postContent->post->published_at->diffForHumans() }}
                        </p>
                        <p><strong>ID:</strong> {{ $postContent->id }}</p>
                        <p><strong>Type:</strong> {{ $postContent->type }}</p>
                        <p><strong>Title:</strong> {{ $postContent->title }}</p>
                        <p><strong>Body:</strong> {{ $postContent->body }}</p>
                        <p><strong>Order:</strong> {{ $postContent->order }}</p>
                    </div>
                </div>





            </div>
        </div>

        </div>
        </div>
    </x-app-layout>

</body>

</html>
