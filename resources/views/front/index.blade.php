@extends('front.master')

@section('title', 'Homepage | ' . env('APP_NAME'))

@section('navbar', 'absolute')


@section('content')
    <div>
        <div class="relative bg-cover bg-center bg-no-repeat py-8"
            style="background-image: url({{ asset('Aassets//img/bg-hero.jpg') }})">
            <div
                class="absolute inset-0 z-20 bg-gradient-to-r from-hero-gradient-from to-hero-gradient-to bg-cover bg-center bg-no-repeat">
            </div>

            <div class="container relative z-30 pt-20 pb-12 sm:pt-56 sm:pb-48 lg:pt-64 lg:pb-48">
                <div class="flex flex-col items-center justify-center lg:flex-row">
                    <div class="rounded-full border-8 border-primary shadow-xl">
                        <img src="{{ asset($user->profile->image->path) }}" class="h-48 rounded-full sm:h-56" alt="author" />
                    </div>
                    <div class="pt-8 sm:pt-10 lg:pl-8 lg:pt-0">
                        <h1 class="text-center font-header text-4xl text-white sm:text-left sm:text-5xl md:text-6xl">
                            Hello I'm {{ $user->name }}!
                        </h1>
                        <div class="flex flex-col justify-center pt-3 sm:flex-row sm:pt-5 lg:justify-start">
                            <div class="flex items-center justify-center pl-0 sm:justify-start md:pl-1">
                                <p class="font-body text-lg uppercase text-white">Let's connect</p>
                                <div class="hidden sm:block">
                                    <i class="bx bx-chevron-right text-3xl text-yellow"></i>
                                </div>
                            </div>
                            <div class="flex items-center justify-center pt-5 pl-2 sm:justify-start sm:pt-0">
                                @isset($settings['facebook'])
                                    <a href="{{ $settings['facebook'] }}" target="_blank">
                                        <i class="bx bxl-facebook-square text-2xl text-white hover:text-yellow"></i>
                                    </a>
                                @endisset
                                @isset($settings['twitter'])
                                    <a href="{{ $settings['twitter'] }}" target="_blank" class="pl-4">
                                        <i class="bx bxl-twitter text-2xl text-white hover:text-yellow"></i>
                                    </a>
                                @endisset
                                @isset($settings['github'])
                                    <a href="{{ $settings['github'] }}" target="_blank" class="pl-4">
                                        <i class="bx bxl-github text-2xl text-white hover:text-yellow"></i>
                                    </a>
                                @endisset
                                @isset($settings['dribbble'])
                                    <a href="{{ $settings['dribbble'] }}" target="_blank" class="pl-4">
                                        <i class="bx bxl-dribbble text-2xl text-white hover:text-yellow"></i>
                                    </a>
                                @endisset
                                @isset($settings['linkedin'])
                                    <a href="{{ $settings['linkedin'] }}" target="_blank" class="pl-4">
                                        <i class="bx bxl-linkedin text-2xl text-white hover:text-yellow"></i>
                                    </a>
                                @endisset
                                @isset($settings['instagram'])
                                    <a href="{{ $settings['instagram'] }}" target="_blank" class="pl-4">
                                        <i class="bx bxl-instagram text-2xl text-white hover:text-yellow"></i>
                                    </a>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-grey-50" id="about">
            <div class="container flex flex-col items-center py-16 md:py-20 lg:flex-row">
                <div class="w-full text-center sm:w-3/4 lg:w-3/5 lg:text-left">
                    <h2 class="font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
                        {{ $settings['about_title'] ?? 'About Me' }}
                    </h2>
                    <h4 class="pt-6 font-header text-xl font-medium text-black sm:text-2xl lg:text-3xl">
                        I'm {{ $user->name }}, a {{ $user->profile->job }}
                    </h4>
                    <p class="pt-6 font-body leading-relaxed text-grey-20">
                        {{ $user->profile->description }}
                    </p>
                    <div class="flex flex-col justify-center pt-6 sm:flex-row lg:justify-start">
                        <div class="flex items-center justify-center sm:justify-start">
                            <p class="font-body text-lg font-semibold uppercase text-grey-20">
                                Connect with me
                            </p>
                            <div class="hidden sm:block">
                                <i class="bx bx-chevron-right text-2xl text-primary"></i>
                            </div>
                        </div>
                        <div class="flex items-center justify-center pt-5 pl-2 sm:justify-start sm:pt-0">
                            @isset($settings['facebook'])
                                <a href="{{ $settings['facebook'] }}" target="_blank">
                                    <i class="bx bxl-facebook-square text-2xl text-primary hover:text-yellow"></i>
                                </a>
                            @endisset
                            @isset($settings['twitter'])
                                <a href="{{ $settings['twitter'] }}" target="_blank" class="pl-4">
                                    <i class="bx bxl-twitter text-2xl text-primary hover:text-yellow"></i>
                                </a>
                            @endisset
                            @isset($settings['github'])
                                <a href="{{ $settings['github'] }}" target="_blank" class="pl-4">
                                    <i class="bx bxl-github text-2xl text-primary hover:text-yellow"></i>
                                </a>
                            @endisset
                            @isset($settings['dribbble'])
                                <a href="{{ $settings['dribbble'] }}" target="_blank" class="pl-4">
                                    <i class="bx bxl-dribbble text-2xl text-primary hover:text-yellow"></i>
                                </a>
                            @endisset
                            @isset($settings['linkedin'])
                                <a href="{{ $settings['linkedin'] }}" target="_blank" class="pl-4">
                                    <i class="bx bxl-linkedin text-2xl text-primary hover:text-yellow"></i>
                                </a>
                            @endisset
                            @isset($settings['instagram'])
                                <a href="{{ $settings['instagram'] }}" target="_blank" class="pl-4">
                                    <i class="bx bxl-instagram text-2xl text-primary hover:text-yellow"></i>
                                </a>
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="w-full pl-0 pt-10 space-y-6 sm:w-3/4 lg:w-2/5 lg:pl-12 lg:pt-0">
                    @foreach ($user->skills as $skill)
                        <div>
                            <div class="flex items-end justify-between">
                                <h4 class="font-body font-semibold uppercase text-black">
                                    {{ $skill->name }}
                                </h4>
                                <h3 class="font-body text-3xl font-bold text-primary">{{ $skill->percentage }}%</h3>
                            </div>
                            <div class="mt-2 h-3 w-full rounded-full bg-lila">
                                <div class="h-3 rounded-full bg-primary" style="width: {{ $skill->percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container py-16 md:py-20" id="services">
            <h2 class="text-center font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
                {{ $settings['service_title'] ?? 'My Services' }}
            </h2>
            <h3 class="pt-6 text-center font-header text-xl font-medium text-black sm:text-2xl lg:text-3xl">
                {{ $settings['service_sub_title'] ?? 'These are the services  offer' }}
            </h3>

            <div class="grid grid-cols-1 gap-6 pt-10 sm:grid-cols-2 md:gap-10 md:pt-12 lg:grid-cols-3">
                @foreach ($user->services->take(6) as $service)
                    <div class="group rounded px-8 py-12 shadow hover:bg-primary">
                        <div class="mx-auto h-24 w-24 text-center xl:h-28 xl:w-28">
                            <div class="hidden group-hover:block">
                                <img src="{{ asset($service->white_image->path) }}" alt="development icon" />
                            </div>
                            <div class="block group-hover:hidden">
                                <img src="{{ asset($service->black_image->path) }}" alt="development icon" />
                            </div>
                        </div>
                        <div class="text-center">
                            <h3
                                class="pt-8 text-lg font-semibold uppercase text-primary group-hover:text-yellow lg:text-xl">
                                {{ $service->name }}
                            </h3>
                            <p class="text-grey pt-4 text-sm group-hover:text-white md:text-base">
                                {{ $service->content }}
                            </p>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>

        <div class="container py-16 md:py-20" id="portfolio">
            <h2 class="text-center font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
                {{ $settings['portfolio_title'] ?? 'My Portfolio' }}
            </h2>
            <h3 class="pt-6 text-center font-header text-xl font-medium text-black sm:text-2xl lg:text-3xl">
                {{ $settings['portfolio_sub_title'] ?? "Here's what I have done with the past" }}
            </h3>

            <div class="mx-auto grid w-full grid-cols-1 gap-8 pt-12 sm:w-3/4 md:gap-10 lg:w-full lg:grid-cols-2">
                @foreach ($user->portfolios->take(4) as $portfolio)
                    <a href="{{ $portfolio->link }}" target="_blank"
                        onclick ="{{ !$portfolio->link ? 'event.preventDefault();' : '' }}"
                        class="mx-auto transform transition-all hover:scale-105 md:mx-0 {{ !$portfolio->link ? 'cursor-default' : '' }}">
                        <img src="{{ asset($portfolio->image->path) }}" class="w-full shadow" alt="portfolio image" />
                    </a>
                @endforeach

            </div>
        </div>

        <div class="bg-grey-50" id="clients">
            <div class="container py-16 md:py-20">
                <div class="mx-auto w-full sm:w-3/4 lg:w-full">
                    <h2
                        class="text-center font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
                        {{ $settings['clients_title'] ?? 'My latest clients' }}
                    </h2>
                    <div class="flex flex-wrap items-center justify-center pt-4 sm:pt-4">
                        @foreach ($user->clients->take(5) as $client)
                            <span class="m-8 block">
                                <img src="{{ asset($client->image->path) }}" alt="client logo"
                                    class="mx-auto block h-12 w-auto" />
                            </span>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <div class="container py-16 md:py-20" id="work">
            <h2 class="text-center font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
                {{ $settings['experience_title'] ?? 'My Work Experience' }}
            </h2>
            <h3 class="pt-6 text-center font-header text-xl font-medium text-black sm:text-2xl lg:text-3xl">
                {{ $settings['experience_sub_title'] ?? "Here's what I did before freelancing" }}
            </h3>

            <div class="relative mx-auto mt-12 flex w-full flex-col lg:w-2/3">
                <span class="left-2/5 absolute inset-y-0 ml-10 hidden w-0.5 bg-grey-40 md:block"></span>

                @foreach ($user->experiences->take(3) as $experience)
                    <div class="mt-8 flex flex-col text-center md:flex-row md:text-left">
                        <div class="md:w-2/5">
                            <div class="flex justify-center md:justify-start">
                                <span class="shrink-0">
                                    <img src="{{ asset($experience->image->path) }}" class="h-auto w-32"
                                        alt="company logo" />
                                </span>
                                <div class="relative ml-3 hidden w-full md:block">
                                    <span
                                        class="absolute inset-x-0 top-1/2 h-0.5 -translate-y-1/2 transform bg-grey-70"></span>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-3/5">
                            <div class="relative flex md:pl-18">
                                <span
                                    class="absolute left-8 top-1 hidden h-4 w-4 rounded-full border-2 border-grey-40 bg-white md:block"></span>

                                <div class="mt-1 flex">
                                    <i class="bx bxs-right-arrow hidden text-primary md:block"></i>
                                    <div class="md:-mt-1 md:pl-8">
                                        <span
                                            class="block font-body font-bold text-grey-40">{{ $experience->start_date->format('M Y') }}
                                            -
                                            {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}</span>
                                        <span
                                            class="block pt-2 font-header text-xl font-bold uppercase text-primary">{{ $experience->job_title }}</span>
                                        <div class="pt-2">
                                            <span class="block font-body text-black">{{ $experience->description }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>

        <div class="bg-cover bg-top bg-no-repeat pb-16 md:py-16 lg:py-24"
            style="background-image: url({{ asset('Aassets/img/experience-figure.png') }})" id="statistics">
            <div class="container">
                <div class="mx-auto w-5/6 bg-white py-16 shadow md:w-11/12 lg:py-20 xl:py-24 2xl:w-full">
                    <div class="grid grid-cols-2 gap-5 md:gap-8 xl:grid-cols-4 xl:gap-5">

                        @foreach ($user->statistics->take(4) as $statistic)
                            <div class="flex flex-col items-center justify-center text-center md:flex-row md:text-left">
                                <div>
                                    <img src="{{ asset($statistic->image->path) }}" class="mx-auto h-12 w-auto md:h-20"
                                        alt="icon award" />
                                </div>
                                <div class="pt-5 md:pl-5 md:pt-0">
                                    <h1 class="font-body text-2xl font-bold text-primary md:text-4xl">
                                        {{ $statistic->value }}
                                    </h1>
                                    <h4 class="text-grey-dark font-header text-base font-medium leading-loose md:text-xl">
                                        {{ $statistic->name }}
                                    </h4>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>

        <div class="bg-grey-50" id="blog">
            <div class="container py-16 md:py-20">
                <h2 class="text-center font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
                    {{ $settings['post_title'] ?? 'I Also Like to Write' }}
                </h2>
                <h4 class="pt-6 text-center font-header text-xl font-medium text-black sm:text-2xl lg:text-3xl">
                    {{ $settings['post_sub_title'] ?? 'Check out my latest posts!' }}
                </h4>
                <div class="mx-auto grid w-full grid-cols-1 gap-6 pt-12 sm:w-3/4 lg:w-full lg:grid-cols-3 xl:gap-10">
                    @foreach ($posts as $post)
                        <a href="{{ route('front.post', $post) }}" class="shadow bg-white">
                            <div style="background-image: url({{ asset($post->image->path) }})"
                                class="group relative h-72 bg-cover bg-center bg-no-repeat sm:h-84 lg:h-64 xl:h-72">
                                <span
                                    class="absolute inset-0 block bg-gradient-to-b from-blog-gradient-from to-blog-gradient-to bg-cover bg-center bg-no-repeat opacity-10 transition-opacity group-hover:opacity-50"></span>
                                <span
                                    class="absolute right-0 bottom-0 mr-4 mb-4 block rounded-full border-2 border-white px-6 py-2 text-center font-body text-sm font-bold uppercase text-white md:text-base">Read
                                    More</span>
                            </div>
                            <div class="bg-white py-6 px-5 xl:py-8">
                                <span class="block font-body text-lg font-semibold text-black">{{ $post->title }}</span>
                                <span class="block pt-2 font-body text-grey-20">{{ $post->summary }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container py-16 md:py-20" id="contact">
            <h2 class="text-center font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
                {{ $settings['contact_title'] ?? "Here's a contact form" }}
            </h2>
            <h4 class="pt-6 text-center font-header text-xl font-medium text-black sm:text-2xl lg:text-3xl">
                {{ $settings['contact_sub_title'] ?? 'Have Any Questions?' }}
            </h4>
            <div class="mx-auto w-full pt-5 text-center sm:w-2/3 lg:pt-6">
                <p class="font-body text-grey-10">
                    {{ $settings['contact_description'] ?? "Feel free to contact me if you have any questions or inquiries. I'm always open to discussing new projects, creative ideas, or opportunities to be part of your visions." }}
                </p>
            </div>
            <form action="{{ route('front.contact') }}" method="POST" class="mx-auto w-full pt-10 sm:w-3/4">
                @csrf
                <div class="flex flex-col md:flex-row">
                    <div class="mr-3 md:w-1/2 lg:mr-5">
                        <input
                            class="w-full rounded border-grey-50 px-4 py-3 font-body text-black  @error('name') is-invalid  border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Name" type="text" id="name" name="name"
                            value="{{ old('name') }}" />

                        @error('name')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-6 md:mt-0  md:ml-3 md:w-1/2 lg:ml-5 ">
                        <input
                            class="w-full rounded border-grey-50 px-4 py-3 font-body text-black @error('email') is-invalid border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Email" type="text" id="email" name="email"
                            value="{{ old('email') }}" />
                        @error('email')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <textarea
                    class="mt-6 w-full rounded border-grey-50 px-4 py-3 font-body text-black md:mt-8 @error('message') is-invalid border-red-500 focus:ring-red-500 @enderror"
                    placeholder="Message" id="message" name="message" cols="30" rows="10">{{ old('message') }}</textarea>
                @error('message')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
                <button
                    class="mt-6 flex items-center justify-center rounded bg-primary px-8 py-3 font-header text-lg font-bold uppercase text-white hover:bg-grey-20">
                    Send
                    <i class="bx bx-chevron-right relative -right-2 text-3xl"></i>
                </button>
            </form>
            <div class="flex flex-col pt-16 lg:flex-row">
                <div class="w-full border-l-2 border-t-2 border-r-2 border-b-2 border-grey-60 px-6 py-6 sm:py-8 lg:w-1/3">
                    <div class="flex items-center">
                        <i class="bx bx-phone text-2xl text-grey-40"></i>
                        <p class="pl-2 font-body font-bold uppercase text-grey-40 lg:text-lg">
                            My Phone
                        </p>
                    </div>
                    <p class="pt-2 text-left font-body font-bold text-primary lg:text-lg">
                        {{ $user->mobile }}
                    </p>
                </div>
                <div
                    class="w-full border-l-2 border-t-0 border-r-2 border-b-2 border-grey-60 px-6 py-6 sm:py-8 lg:w-1/3 lg:border-l-0 lg:border-t-2">
                    <div class="flex items-center">
                        <i class="bx bx-envelope text-2xl text-grey-40"></i>
                        <p class="pl-2 font-body font-bold uppercase text-grey-40 lg:text-lg">
                            My Email
                        </p>
                    </div>
                    <p class="pt-2 text-left font-body font-bold text-primary lg:text-lg">
                        {{ $user->email }}
                    </p>
                </div>
                <div
                    class="w-full border-l-2 border-t-0 border-r-2 border-b-2 border-grey-60 px-6 py-6 sm:py-8 lg:w-1/3 lg:border-l-0 lg:border-t-2">
                    <div class="flex items-center">
                        <i class="bx bx-map text-2xl text-grey-40"></i>
                        <p class="pl-2 font-body font-bold uppercase text-grey-40 lg:text-lg">
                            My Address
                        </p>
                    </div>
                    <p class="pt-2 text-left font-body font-bold text-primary lg:text-lg">
                        {{ $settings['location'] ?? '123 New York D Block 1100, 2011 USA' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="h-72 bg-cover bg-center bg-no-repeat sm:h-64 md:h-72 lg:h-96"
            style="background-image: url({{ asset('Aassets/img/map.png') }})"></div>

        <div class="relative bg-primary bg-cover bg-center bg-no-repeat py-16 bg-blend-multiply lg:py-24"
            style="background-image: url({{ asset('Aassets/img/bg-cta.jpg') }})">
            <div class="container relative z-30">
                <h3
                    class="text-center font-header text-3xl uppercase leading-tight tracking-wide text-white sm:text-4xl lg:text-5xl">
                    {{ $settings['keep'] ?? 'Keep' }} <span
                        class="font-bold">{{ $settings['first_up_to_date_title'] ?? '-to-date' }}</span> <br />
                    {{ $settings['second_up_to_date_title'] ?? "with what I'm up to" }}
                </h3>
                <form method="POST" action="{{ route('front.subscribe') }}"
                    class="mt-6 flex flex-col justify-center sm:items-start sm:flex-row">
                    @csrf
                    <div class="w-full sm:w-2/5 lg:w-1/3">
                        <input class="w-full rounded px-4 py-3 font-body text-black  sm:py-4  @error('subscriber_email') is-invalid-subscribe-email border-red-500 focus:ring-red-500 @enderror"
                            type="text" id="subscriber_email" name="subscriber_email"
                            placeholder="Give me your Email" />
                        @error('subscriber_email')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <button
                        class="mt-2 rounded bg-yellow px-8 py-3 font-body text-base font-bold uppercase text-primary transition-colors hover:bg-primary hover:text-white focus:border-transparent focus:outline-none focus:ring focus:ring-yellow sm:ml-2 sm:mt-0 sm:py-4 md:text-lg">
                        Join the club
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const errorInput = document.querySelector('.is-invalid');

            if (errorInput) {
                errorInput.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                errorInput.focus();
            }
            const subscriberEmailInput = document.querySelector('.is-invalid-subscribe-email');
            if (subscriberEmailInput) {
                subscriberEmailInput.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                subscriberEmailInput.focus();
            }
        });
    </script>
@endsection
