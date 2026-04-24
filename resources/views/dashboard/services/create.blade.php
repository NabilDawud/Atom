<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Service</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Services') }}
                </h2>
                <a href="{{ route('admin.services.index') }}"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                    {{ __('Return Back') }}
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('admin.services.store') }}" class="space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Service Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    required autofocus value="{{ old('name') }}" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="content" :value="__('Content')" />
                                <x-text-input id="content" class="block mt-1 w-full" type="text" name="content"
                                    required value="{{ old('content') }}" />
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="white_image" :value="__('White Image')" />
                                <x-text-input id="white_image"
                                    class="block mt-1 border outline-indigo-500 w-full bg-white px-3 py-2"
                                    type="file" name="white_image" accept="image/*" value="{{ old('white_image') }}" />
                                <x-input-error :messages="$errors->get('white_image')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="black_image" :value="__('Black Image')" />
                                <x-text-input id="black_image"
                                    class="block mt-1 border outline-indigo-500 w-full bg-white px-3 py-2"
                                    type="file" name="black_image" accept="image/*" value="{{ old('black_image') }}" />
                                <x-input-error :messages="$errors->get('black_image')" class="mt-2" />
                            </div>

                            <div class="flex items-center mt-4">
                                <x-primary-button>
                                    {{ __('Create') }}
                                </x-primary-button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>


</body>

</html>
