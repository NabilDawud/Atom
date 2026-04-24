<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Details</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Contact Details') }}
                </h2>
                <a href="{{ route('admin.contacts.index') }}"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                    {{ __('Return Back') }}
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Name: {{ $contact->name ?? $contact->user->name }}</h3>
                        <p class="mb-2"><strong>Email:</strong> {{ $contact->email ?? $contact->user->email }}</p>
                        <p><strong>Message:</strong></p>
                        <p class="bg-gray-100 p-2 rounded">{{ $contact->message }}</p>
                    </div>
                </div>
              
            </div>
        </div>
    </x-app-layout>


</body>

</html>
