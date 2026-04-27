<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Setting</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Settings') }}
                </h2>
                <a href="{{ redirect()->back()->getTargetUrl() }}"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                    {{ __('Return Back') }}
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('admin.settings') }}" class="space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <x-input-label for="logo" :value="__('Logo')" />
                                <x-text-input id="logo"
                                    class="block mt-1 w-full border outline-indigo-500 bg-white px-3 py-2"
                                    type="file" name="logo" value="{{ old('logo', $settings['logo'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            </div>
                            @isset($settings['logo'])
                                <div>
                                    <img src="{{ asset($settings['logo']) }}" alt="Current Logo"
                                        class="h-12 w-auto object-cover rounded bg-primary p-1">
                                </div>
                            @endisset
                            <div>
                                <x-input-label for="facebook" :value="__('Facebook URL')" />
                                <x-text-input id="facebook" class="block mt-1 w-full" type="text" name="facebook"
                                    value="{{ old('facebook', $settings['facebook'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="twitter" :value="__('Twitter URL')" />
                                <x-text-input id="twitter" class="block mt-1 w-full" type="text" name="twitter"
                                    value="{{ old('twitter', $settings['twitter'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="github" :value="__('GitHub URL')" />
                                <x-text-input id="github" class="block mt-1 w-full" type="text" name="github"
                                    value="{{ old('github', $settings['github'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('github')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="dribbble" :value="__('Dribbble URL')" />
                                <x-text-input id="dribbble" class="block mt-1 w-full" type="text" name="dribbble"
                                    value="{{ old('dribbble', $settings['dribbble'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('dribbble')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="linkedin" :value="__('LinkedIn URL')" />
                                <x-text-input id="linkedin" class="block mt-1 w-full" type="text" name="linkedin"
                                    value="{{ old('linkedin', $settings['linkedin'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="instagram" :value="__('Instagram URL')" />
                                <x-text-input id="instagram" class="block mt-1 w-full" type="text" name="instagram"
                                    value="{{ old('instagram', $settings['instagram'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="about_title" :value="__('About Title')" />
                                <x-text-input id="about_title" class="block mt-1 w-full" type="text"
                                    name="about_title"
                                    value="{{ old('about_title', $settings['about_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('about_title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="service_title" :value="__('Service Title')" />
                                <x-text-input id="service_title" class="block mt-1 w-full" type="text"
                                    name="service_title"
                                    value="{{ old('service_title', $settings['service_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('service_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="service_sub_title" :value="__('Service Sub Title')" />
                                <x-text-input id="service_sub_title" class="block mt-1 w-full" type="text"
                                    name="service_sub_title"
                                    value="{{ old('service_sub_title', $settings['service_sub_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('service_sub_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="portfolio_title" :value="__('Portfolio Title')" />
                                <x-text-input id="portfolio_title" class="block mt-1 w-full" type="text"
                                    name="portfolio_title"
                                    value="{{ old('portfolio_title', $settings['portfolio_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('portfolio_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="portfolio_sub_title" :value="__('Portfolio Sub Title')" />
                                <x-text-input id="portfolio_sub_title" class="block mt-1 w-full" type="text"
                                    name="portfolio_sub_title"
                                    value="{{ old('portfolio_sub_title', $settings['portfolio_sub_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('portfolio_sub_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="client_title" :value="__('Client Title')" />
                                <x-text-input id="client_title" class="block mt-1 w-full" type="text"
                                    name="client_title"
                                    value="{{ old('client_title', $settings['client_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('client_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="experience_title" :value="__('Experience Title')" />
                                <x-text-input id="experience_title" class="block mt-1 w-full" type="text"
                                    name="experience_title"
                                    value="{{ old('experience_title', $settings['experience_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('experience_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="experience_sub_title" :value="__('Experience Sub Title')" />
                                <x-text-input id="experience_sub_title" class="block mt-1 w-full" type="text"
                                    name="experience_sub_title"
                                    value="{{ old('experience_sub_title', $settings['experience_sub_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('experience_sub_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="post_title" :value="__('Post Title')" />
                                <x-text-input id="post_title" class="block mt-1 w-full" type="text"
                                    name="post_title"
                                    value="{{ old('post_title', $settings['post_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('post_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="post_sub_title" :value="__('Post Sub Title')" />
                                <x-text-input id="post_sub_title" class="block mt-1 w-full" type="text"
                                    name="post_sub_title"
                                    value="{{ old('post_sub_title', $settings['post_sub_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('post    _sub_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="contact_title" :value="__('Contact Title')" />
                                <x-text-input id="contact_title" class="block mt-1 w-full" type="text"
                                    name="contact_title"
                                    value="{{ old('contact_title', $settings['contact_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('contact_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="contact_sub_title" :value="__('Contact Sub Title')" />
                                <x-text-input id="contact_sub_title" class="block mt-1 w-full" type="text"
                                    name="contact_sub_title"
                                    value="{{ old('contact_sub_title', $settings['contact_sub_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('contact_sub_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="contact_description" :value="__('Contact Description')" />
                                <x-text-input id="contact_description" class="block mt-1 w-full" type="text"
                                    name="contact_description"
                                    value="{{ old('contact_description', $settings['contact_description'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('contact_description')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="location" :value="__('Location')" />
                                <x-text-input id="location" class="block mt-1 w-full" type="text"
                                    name="location" value="{{ old('location', $settings['location'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="keep" :value="__('Before First Up to Date Title (not bold)')" />
                                <x-text-input id="keep" class="block mt-1 w-full" type="text" name="keep"
                                    value="{{ old('keep', $settings['keep'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('keep')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="first_up_to_date_title" :value="__('First Up to Date Title (bold)')" />
                                <x-text-input id="first_up_to_date_title" class="block mt-1 w-full" type="text"
                                    name="first_up_to_date_title"
                                    value="{{ old('first_up_to_date_title', $settings['first_up_to_date_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('first_up_to_date_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="second_up_to_date_title" :value="__('Second Up to Date Title')" />
                                <x-text-input id="second_up_to_date_title" class="block mt-1 w-full" type="text"
                                    name="second_up_to_date_title"
                                    value="{{ old('second_up_to_date_title', $settings['second_up_to_date_title'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('second_up_to_date_title')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="copyright" :value="__('Copyright')" />
                                <x-text-input id="copyright" class="block mt-1 w-full" type="text"
                                    name="copyright" value="{{ old('copyright', $settings['copyright'] ?? '') }}" />
                                <x-input-error :messages="$errors->get('copyright')" class="mt-2" />
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
