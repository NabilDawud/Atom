<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Content</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Post Content') }}
                </h2>
                <div class="trashAndCreateButtons flex items-center">
                    <a href="{{ route('admin.post_contents.trash') }}"
                        class="ms-4 inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                        {{ __('View Trashed Post Content') }}
                    </a>
                    <a href="{{ route('admin.post_contents.create') }}"
                        class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                        {{ __('Add New Post Content') }}
                    </a>
                </div>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="overflow-x-auto">
                            <table class="w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">

                                <thead class="bg-gray-900 text-white uppercase text-sm tracking-wider">
                                    <tr>
                                        <th class="py-3 px-6 text-left">ID</th>
                                        <th class="py-3 px-6 text-left">Title</th>
                                        <th class="py-3 px-6 text-left">Type</th>
                                        <th class="py-3 px-6 text-left">Order</th>
                                        <th class="py-3 px-6 text-left">Post</th>
                                        <th class="py-3 px-6 text-left" width="220px">Actions</th>

                                    </tr>
                                </thead>

                                <tbody class="text-gray-700 text-sm divide-y divide-gray-200"">
                                    @forelse ($postContents as $postContent)
                                        <tr class="border-b hover:bg-gray-100 transition ">
                                            <td class="py-3 px-6">{{ $postContent->id }}</td>
                                            <td class="py-3 px-6">{{ $postContent->title }}</td>
                                            <td class="py-3 px-6">{{ $postContent->type }} </td>
                                            <td class="py-3 px-6">{{ $postContent->order }} </td>
                                            <td class="py-3 px-6"><a 
                                                    href="{{ route('admin.posts.show', $postContent->post_id) }}"
                                                    class="text-blue-500 hover:text-blue-700">{{ $postContent->post->title }}</a></td>
                                            </td>

                                            <td class="py-3 px-6">
                                                <a href="{{ route('admin.post_contents.show', $postContent->id) }}"
                                                    class="inline-flex bg-blue-500 hover:bg-blue-700 transition text-white font-bolds  py-2 px-4 rounded ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.post_contents.edit', $postContent->id) }}"
                                                    class="inline-flex bg-green-500 hover:bg-green-700 transition text-white font-bolds  py-2 px-4 rounded ">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.post_contents.destroy', $postContent->id) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="deletesweetalert(this)"
                                                        class="inline-flex bg-red-500 hover:bg-red-700 transition  text-white font-bold py-2 px-4 rounded">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="py-3 px-6 text-center">No posts found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    {{ $postContents->links() }}

                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        function deletesweetalert(button) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>
</body>

</html>
