<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Skill</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Skills') }}
                </h2>
                <a href="{{ route('admin.skills.index') }}"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                    {{ __('Return Back') }}
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('admin.skills.store') }}" class="space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Skill Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="percentage" :value="__('Percentage')" />
                                <x-text-input id="percentage" class="block mt-1 w-full" type="number" name="percentage"
                                    required />
                                <x-input-error :messages="$errors->get('percentage')" class="mt-2" />
                            </div>

                            <div class="flex items-center mt-4">
                                <x-primary-button >
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
