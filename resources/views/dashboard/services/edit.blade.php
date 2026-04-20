<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Service</title>
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
                        <form method="POST" action="{{ route('admin.services.update', $service->id) }}"
                            enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <div>
                                <x-input-label for="name" :value="__('Service Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name', $service->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="content" :value="__('Content')" />
                                <x-text-input id="content" class="block mt-1 w-full" type="text" name="content"
                                    :value="old('content', $service->content)" required />
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Image')" />
                                <x-text-input id="image"
                                    class="mt-1 border outline-indigo-500 w-full bg-white px-3 py-2" type="file"
                                    name="image" :value="old('image', $service->image->path)" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            @isset($service->image->path)
                                <div class="-mt-2">
                                    <img src="{{ asset($service->image->path) }}" alt="{{ $service->name }}"
                                        class="w-24 h-24 object-cover rounded ">
                                </div>
                            @endisset

                            <div class="flex items-center mt-4">
                                <x-primary-button>
                                    {{ __('Update Service') }}
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
