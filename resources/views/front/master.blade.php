<!DOCTYPE html>
<html lang="en" class="scroll-smooth ">

<head>
    <meta charset="utf-8" />

    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />

    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />

    <title>@yield('title', env('APP_NAME'))</title>

    <meta property="og:title" content="Homepage | Atom Template" />

    <meta property="og:locale" content="en_US" />

    <link rel="canonical" href="//" />

    <meta property="og:url" content="//" />

    <meta name="description"
        content="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." />

    <link rel="icon" type="image/png" href="{{ asset('Aassets/img/favicon.png') }}" />

    <meta name="theme-color" content="#5540af" />

    <meta property="og:site_name" content="Atom Template" />

    <meta property="og:image" content="{{ asset('Aassets/img/social.jpg') }}" />

    <meta name="twitter:card" content="summary_large_image" />

    <meta name="twitter:site" content="@tailwindmade" />

    <link crossorigin="crossorigin" href="https://fonts.gstatic.com" rel="preconnect" />

    <link as="style"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Raleway:wght@400;500;600;700&display=swap"
        rel="preload" />

    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Raleway:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />

    {{-- <link crossorigin="anonymous" href="{{ asset('Aassets/styles/main.min.css') }}" media="screen" rel="stylesheet" /> --}}

    <script defer src="https://unpkg.com/@alpine-collective/toolkit@1.0.0/dist/cdn.min.js"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('css')

</head>


<body :class="{ 'overflow-hidden max-h-screen': mobileMenu }" class="relative" x-data="{ mobileMenu: false }">

    <div id="main" class="relative">
        <div x-data="{
            triggerNavItem(id) {
                    $scroll(id)
                },
                triggerMobileNavItem(id) {
                    mobileMenu = false;
                    this.triggerNavItem(id)
                }
        }">
            <div class="w-full z-50 top-0 py-3 sm:py-5  @yield('navbar')
  ">
                <div class="container flex items-center justify-between">
                    <div>
                        <a href="/">
                            <img src="{{ asset('Aassets/img/logo.svg') }}" class="w-24 lg:w-48" alt="logo image" />
                        </a>
                    </div>
                    <div class="hidden lg:block">
                        <ul class="flex items-center">

                            <li class="group pl-6">

                                <a href="{{ route('front.index') }}#about"
                                    class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">About</a>

                                <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
                            </li>

                            <li class="group pl-6">

                                <a href="{{ route('front.index') }}#services"
                                    class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Services</a>

                                <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
                            </li>

                            <li class="group pl-6">

                                <a href="{{ route('front.index') }}#portfolio"
                                    class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Portfolio</a>

                                <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
                            </li>

                            <li class="group pl-6">

                                <a href="{{ route('front.index') }}#clients"
                                    class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Clients</a>

                                <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
                            </li>

                            <li class="group pl-6">

                                <a href="{{ route('front.index') }}#work"
                                    class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Work</a>

                                <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
                            </li>

                            <li class="group pl-6">

                                <a href="{{ route('front.index') }}#statistics"
                                    class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Statistics</a>

                                <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
                            </li>

                            <li class="group pl-6">

                                <a href="{{ route('front.index') }}#blog"
                                    class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Blog</a>

                                <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
                            </li>

                            <li class="group pl-6">

                                <a href="{{ route('front.index') }}#contact"
                                    class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Contact</a>

                                <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
                            </li>

                            @auth
                                <li class="group pl-6">
                                    <a href="{{ route('dashboard') }}"
                                        class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Dashboard</a>

                                    <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
                                </li>
                            @else
                                <li class="group pl-6">
                                    <a href="{{ route('login') }}"
                                        class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">login</a>

                                    <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
                                </li>
                            @endauth

                        </ul>
                    </div>
                    <div class="block lg:hidden">
                        <button @click="mobileMenu = true">
                            <i class="bx bx-menu text-4xl text-white"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="pointer-events-none fixed inset-0 z-70 min-h-screen bg-black/70 opacity-0 transition-opacity lg:hidden"
                :class="{ 'opacity-100 !pointer-events-auto': mobileMenu }" @click="mobileMenu = false">
                <div class="absolute right-0 min-h-screen w-2/3 bg-primary py-4 px-8 shadow md:w-1/3">
                    <button class="absolute top-0 right-0 mt-4 mr-4" @click="mobileMenu = false">
                        <img src="{{ asset('Aassets/img/icon-close.svg') }}" class="h-10 w-auto" alt="" />
                    </button>

                    <ul class="mt-8 flex flex-col">

                        <li class="py-2">

                            <a href="{{ route('front.index') }}#about"
                                class="cursor-pointer block  pt-0.5 font-header font-semibold uppercase text-white">About</a>

                        </li>

                        <li class="py-2">

                            <a href="{{ route('front.index') }}#services"
                                class="cursor-pointer block  pt-0.5 font-header font-semibold uppercase text-white">Services</a>

                        </li>

                        <li class="py-2">

                            <a href="{{ route('front.index') }}#portfolio"
                                class="cursor-pointer block  pt-0.5 font-header font-semibold uppercase text-white">Portfolio</a>

                        </li>

                        <li class="py-2">

                            <a href="{{ route('front.index') }}#clients"
                                class="cursor-pointer block  pt-0.5 font-header font-semibold uppercase text-white">Clients</a>

                        </li>

                        <li class="py-2">

                            <a href="{{ route('front.index') }}#work"
                                class="cursor-pointer block  pt-0.5 font-header font-semibold uppercase text-white">Work</a>

                        </li>

                        <li class="py-2">

                            <a href="{{ route('front.index') }}#statistics"
                                class="cursor-pointer block  pt-0.5 font-header font-semibold uppercase text-white">Statistics</a>

                        </li>

                        <li class="py-2">

                            <a href="{{ route('front.index') }}#blog"
                                class="cursor-pointer block  pt-0.5 font-header font-semibold uppercase text-white">Blog</a>

                        </li>

                        <li class="py-2">
                            <a href="{{ route('front.index') }}#contact"
                                class="cursor-pointer block  pt-0.5 font-header font-semibold uppercase text-white">Contact</a>
                        </li>
                        @auth
                            <li class="py-2">
                                <a href="{{ route('dashboard') }}"
                                    class="cursor-pointer block  pt-0.5 font-header font-semibold uppercase text-white">Dashboard</a>
                            </li>
                        @else
                            <li class="py-2">
                                <a href="{{ route('login') }}"
                                    class="cursor-pointer block  pt-0.5 font-header font-semibold uppercase text-white">Login</a>
                            </li>
                        @endauth

                    </ul>
                </div>
            </div>


            @yield('content')

            <div class="bg-primary">
                <div class="container flex flex-col justify-between py-6 sm:flex-row">
                    <p class="text-center font-body text-white md:text-left">
                        © Copyright 2022. • Distributed by <a href="https://themewagon.com"
                            target="_blank">ThemeWagon</a> • All right reserved, ATOM.
                    </p>
                    <div class="flex items-center justify-center pt-5 sm:justify-start sm:pt-0">
                        <a href="/">
                            <i class="bx bxl-facebook-square text-2xl text-white hover:text-yellow"></i>
                        </a>
                        <a href="/" class="pl-4">
                            <i class="bx bxl-twitter text-2xl text-white hover:text-yellow"></i>
                        </a>
                        <a href="/" class="pl-4">
                            <i class="bx bxl-dribbble text-2xl text-white hover:text-yellow"></i>
                        </a>
                        <a href="/" class="pl-4">
                            <i class="bx bxl-linkedin text-2xl text-white hover:text-yellow"></i>
                        </a>
                        <a href="/" class="pl-4">
                            <i class="bx bxl-instagram text-2xl text-white hover:text-yellow"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <script src="{{ asset('Aassets/js/main.js') }}"></script>
        @yield('js')


</body>

</html>
