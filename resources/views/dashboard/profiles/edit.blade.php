         <form action="{{ route('admin.profiles.storeAndUpdate') }}" method="POST" enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="mt-4">
                 <x-input-label for="mobile" :value="__('Mobile')" />
                 <x-text-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile', auth()->user()->mobile)"
                     autofocus autocomplete="mobile" />
                 <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
             </div>

             <div class="mt-4">
                 <x-input-label for="image" :value="__('Image')" />
                 <x-text-input id="image" class="block mt-1 border outline-indigo-500 w-full bg-white px-3 py-2"
                     type="file" name="image" :value="old('image', auth()->user()->image)" autofocus />
                 <x-input-error :messages="$errors->get('image')" class="mt-2" />
             </div>
             @isset(auth()->user()->profile->image->path)
                 <div class="my-4">
                     <img src="{{ asset(auth()->user()->profile->image->path) }}" alt="Profile Image"
                         class="w-32 h-32 object-cover object-top rounded">
                 </div>
             @endisset
             <div class="mt-4">
                 <x-input-label for="job" :value="__('Job')" />
                 <x-text-input id="job" class="block mt-1 w-full" type="text" name="job" :value="old('job', auth()->user()->profile->job ?? '')"
                     autofocus />
                 <x-input-error :messages="$errors->get('job')" class="mt-2" />
             </div>
             <div class="my-4">
                 <label for="User_Description" class="block font-medium text-sm text-gray-700">Description</label>
                 <textarea id="User_Description" rows="7" name="description" required
                     class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ auth()->user()->profile->description ?? '' }}</textarea>
             </div>
             <button
                 class="text-white bg-gray-800 cursor-pointer box-border border border-transparent hover:bg-gray-950 transition focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded text-sm px-4 py-2 focus:outline-none">Submit</button>
         </form>
