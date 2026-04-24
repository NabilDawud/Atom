<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Experience</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Experiences') }}
                </h2>
                <a href="{{ route('admin.experiences.index') }}"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                    {{ __('Return Back') }}
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('admin.experiences.update', $experience->id) }}"
                            enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="job_title" :value="__('Job Title')" />
                                <x-text-input id="job_title" class="block mt-1 w-full" type="text" name="job_title"
                                    :value="old('job_title', $experience->job_title)" required autofocus />
                                <x-input-error :messages="$errors->get('job_title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" class="block mt-1 w-full" type="text"
                                    name="description" :value="old('description', $experience->description)" required autofocus />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                                    :value="old('start_date', $experience->start_date)" required autofocus />
                                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date"
                                    :value="old('end_date', $experience->end_date)" />
                                <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Image')" />
                                <x-text-input id="image"
                                    class="mt-1 border outline-indigo-500 w-full bg-white px-3 py-2" type="file"
                                    name="image" :value="old('image', $experience->image->path ?? '')" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            @isset($experience->image->path)
                                <div class="-mt-2">
                                    <img src="{{ asset($experience->image->path) }}" alt="{{ $experience->name }}"
                                        class="w-auto h-18 object-cover rounded ">
                                </div>
                            @endisset

                            <div class="flex items-center mt-8">
                                <x-primary-button>
                                    {{ __('Update Experience') }}
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
