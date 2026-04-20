<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post Content</title>

</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Posts Content') }}
                </h2>
                <a href="{{ route('admin.post_contents.index') }}"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                    {{ __('Return Back') }}
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 border border-red-200 rounded-lg">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $message)
                                        <li class="text-sm text-red-800 font-medium">
                                            {{ $message }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.post_contents.update', $postContent->id) }}"
                            class="space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="post_id" :value="__('Post')" />
                                <select name="post_id" id="post_id"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach ($posts as $pt)
                                        <option value="{{ old('post_id', $pt->id) }}"
                                            {{ $post->id == $pt->id ? 'selected' : '' }}>
                                            {{ $pt->title }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('post_id')" class="mt-2" />
                            </div>


                            <div id="contents-wrapper">
                                @foreach ($post->post_contents as $index => $content)
                                    <div class="mb-4 border p-4 rounded-md bg-gray-50 shadow-sm border-gray-300">
                                        <input type="hidden" name="contents[{{ $index }}][id]"
                                            value="{{ $content->id }}" />
                                        <div class="mt-1.5">
                                            <x-input-label for="contents[{{ $index }}][title]"
                                                :value="__('Title')" />
                                            <x-text-input id="contents[{{ $index }}][title]"
                                                class="block mt-1 w-full" type="text"
                                                name="contents[{{ $index }}][title]"
                                                value="{{ old('contents.' . $index . '.title', $content->title) }}" />
                                            <x-input-error :messages="$errors->get('contents.' . $index . '.title')" class="mt-2" />
                                        </div>
                                        <div>
                                            <x-input-label for="contents[{{ $index }}][type]"
                                                :value="__('Content Type')" />
                                            <select name="contents[{{ $index }}][type]"
                                                id="contents[{{ $index }}][type]"
                                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                <option value="paragraph"
                                                    {{ $content->type == 'paragraph' ? 'selected' : '' }}>Paragraph
                                                </option>
                                                <option value="feature"
                                                    {{ $content->type == 'feature' ? 'selected' : '' }}>Feature
                                                </option>
                                                <option value="code"
                                                    {{ $content->type == 'code' ? 'selected' : '' }}>Code</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('contents.' . $index . '.type')" class="mt-2" />
                                        </div>

                                        <div class="mt-1.5">
                                            <x-input-label for="contents[{{ $index }}][body]"
                                                :value="__('Content Body')" />
                                            <textarea name="contents[{{ $index }}][body]" id="contents[{{ $index }}][body]"
                                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                rows="4">{{ old('contents.' . $index . '.body', $content->body) }}</textarea>
                                            <x-input-error :messages="$errors->get('contents.' . $index . '.body')" class="mt-2" />
                                        </div>

                                        <div class="mt-2">
                                            <button type="button"
                                                class="px-3 py-1 bg-red-500 text-white rounded-md remove-content">Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-content"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md">+ Add Content</button>



                            <div class="flex items-center mt-4">
                                <x-primary-button>
                                    {{ __('Update') }}
                                </x-primary-button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-content')) {
                e.target.closest('.mb-4').remove();
            }
        });

        document.querySelector('select[name=post_id]').addEventListener('change', function() {
            if (this.value != {{ $post->id }}) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this! And If you click on update button it will change the contents of this contents to the selected post.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Change it!"
                }).then((result) => {
                    if (!result.isConfirmed) {
                        this.value = {{ $post->id }};
                    }
                });


            }
        });

        let counter = {{ $post->post_contents->count() }};
        document.querySelector('#add-content').addEventListener('click', function() {
            let index = counter++;
            console.log(index);

            const wrapper = document.querySelector('#contents-wrapper');

            const contentBlock = document.createElement('div');
            contentBlock.classList.add('mb-4', 'border', 'p-4', 'rounded-md', 'bg-gray-50', 'shadow-sm',
                'border-gray-300');

            contentBlock.innerHTML = `                
                  <div class="mt-1.5">
                    <x-input-label for="contents[${index}][title]" :value="__('Title')" />
                    <x-text-input id="contents[${index}][title]" class="block mt-1 w-full" type="text" name="contents[${index}][title]"  autofocus value="{{ old('contents.${index}.title') }}" />
                    <x-input-error :messages="$errors->get('contents.${index}.title')" class="mt-2" />
                </div>
            
                <div>
                    <x-input-label for="contents[${index}][type]" :value="__('Content Type')" />
                    <select name="contents[${index}][type]" id="contents[${index}][type]" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="paragraph">Paragraph</option>
                        <option value="feature">Feature</option>
                        <option value="code">Code</option>
                    </select>
                    <x-input-error :messages="$errors->get('contents.${index}.type')" class="mt-2" />
                </div>

                <div class="mt-1.5">
                    <x-input-label for="contents[${index}][body]" :value="__('Content Body')" />
                    <textarea name="contents[${index}][body]" id="contents[${index}][body]" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4"></textarea>
                    <x-input-error :messages="$errors->get('contents.${index}.body')" class="mt-2" />
                </div>
               
              
                
            `;

            wrapper.insertAdjacentElement('beforeend', contentBlock);
            index++;
        });
    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const postSelect = document.getElementById('post_id');
            const orderInput = document.getElementById('order');

            postSelect.addEventListener('change', function() {
                const postId = this.value;

                if (postId) {
                    fetch(`/admin/posts/${postId}/contents/max-order`)
                        .then(response => response.json())
                        .then(data => {
                            orderInput.value = data.max_order + 1;
                        })
                        .catch(error => {
                            console.error('Error fetching max order:', error);
                            orderInput.value = 0;
                        });
                } else {
                    orderInput.value = 0;
                }
            });
        });
    </script> --}}
</body>

</html>
