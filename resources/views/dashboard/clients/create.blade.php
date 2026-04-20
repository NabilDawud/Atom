<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Client</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Clients') }}
                </h2>
                <a href="{{ route('admin.clients.index') }}"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                    {{ __('Return Back') }}
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('admin.clients.store') }}" class="space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <x-input-label for="image" :value="__('Image')" />
                                <x-text-input id="image"
                                    class="block mt-1 border outline-indigo-500 w-full bg-white px-3 py-2"
                                    type="file" name="image" required accept="image/*" value="{{ old('image') }}" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
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
