<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Service') }}
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
                        <h3 class="text-lg font-semibold mb-4">Service Details</h3>
                        <p><strong>ID:</strong> {{ $service->id }}</p>
                        <p><strong>Name:</strong> {{ $service->name }}</p>
                        <p><strong>content:</strong> {{ $service->content }}</p>
                        <div class="mt-4 flex items-center gap-2">
                            <strong>Image:</strong>
                            @if ($service->image)
                                <img src="{{ asset($service->image->path) }}" alt="{{ $service->name }}" class="w-24 h-24 object-cover rounded ">
                            @else
                                <span class="text-gray-500">No Image</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

</body>

</html>
