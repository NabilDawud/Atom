<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category</title>
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
                <a href="{{ route('admin.categories.index') }}"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                    {{ __('Return Back') }}
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}"
                            enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name', $category->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="posts" :value="__('Posts')" />

                                <select name="posts[]" id="posts" multiple class="w-full">
                                    @foreach ($posts as $post)
                                        <option value="{{ $post->id }}"
                                            {{ isset($category) && $category->posts->contains($post->id) ? 'selected' : '' }}>
                                            {{ $post->title }}
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
