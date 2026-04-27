@extends('front.master')

@section('title', 'Unsubscribed')
@section('navbar', 'bg-primary')

@section('css')
    <style>
        #main>div {
            min-height: 100vh;
            display: grid;
            align-content: space-between;
            background-color: #f3f4f6;
        }
    </style>
@endsection
@section('content')
    <div class="flex items-center justify-center bg-gray-100">

        <div class="bg-white shadow-lg rounded-2xl p-8 text-center max-w-md w-full">

            <div class="text-green-500 text-5xl mb-4">
                ✓
            </div>

            <h1 class="text-2xl font-bold mb-2">
                You are unsubscribed
            </h1>

            <p class="text-gray-600 mb-6">
                {{ $subscriber?->email ?? 'Your email' }} has been removed from our mailing list.
            </p>

            <a href="{{ route('front.index') }}"
                class="inline-block px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                Back to Home
            </a>

        </div>

    </div>

@endsection
