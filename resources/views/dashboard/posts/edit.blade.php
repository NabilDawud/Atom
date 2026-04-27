<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple {
            border-radius: 0.75rem;
            border: 1px solid #d1d5db;
            padding: 7px 4px 7px 7px;
            min-height: 42px;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #6366f1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }

        .select2-container .select2-search--inline .select2-search__field {
            height: 26px !important;
            margin: 0 !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            height: 100% !important;
        }

        .select2-selection__choice {
            background-color: #6366f1 !important;
            border: none !important;
            color: white !important;
            border-radius: 9999px !important;
            padding: 2px 8px 2px 20px !important;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Categorys') }}
                </h2>
                <a href="{{ route('admin.posts.index') }}"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                    {{ __('Return Back') }}
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('admin.posts.update', $post) }}"
                            enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                    :value="old('title', $post->title)" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="summary" :value="__('Summary')" />
                                <textarea id="summary" name="summary"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    rows="4">{{ old('summary', $post->summary) }}</textarea>
                                <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="published_at" :value="__('Published At')" />
                                <x-text-input id="published_at" class="block mt-1 w-full" type="date"
                                    name="published_at" :value="old('published_at', $post->published_at?->format('Y-m-d'))" />
                                <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Image')" />
                                <x-text-input id="image"
                                    class="block mt-1 border outline-indigo-500 w-full bg-white px-3 py-2"
                                    type="file" name="image" :value="old('image', $post->image)" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            @isset($post->image->path)
                                <div class="-mt-2">
                                    <img src="{{ asset($post->image->path) }}" alt="{{ $post->name }}"
                                        class="w-24 h-24 object-cover rounded ">
                                </div>
                            @endisset

                            <div class="mt-4">
                                <x-input-label for="posts" :value="__('Posts')" />

                                <select name="categories[]" id="posts" multiple class="w-full">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ isset($post) && $post->categories->contains($category->id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <x-input-error :messages="$errors->get('posts')" class="mt-2" />
                            </div>

                            <div class="flex items-center mt-4">
                                <x-primary-button>
                                    {{ __('Update') }}
                                </x-primary-button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#posts').select2({
                placeholder: "Select posts",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
</body>

</html>
