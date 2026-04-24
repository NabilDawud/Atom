<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Experiences</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Experiences') }}
                </h2>

                <a href="{{ route('admin.experiences.index') }}"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25 transition">
                    {{ __('Return Back') }}
                </a>

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
                                        <th class="py-3 px-6 text-left">Image</th>
                                        <th class="py-3 px-6 text-left">Job Title</th>
                                        <th class="py-3 px-6 text-left">Start Date</th>
                                        <th class="py-3 px-6 text-left">End Date</th>
                                        <th class="py-3 px-6 text-left">Actions</th>

                                    </tr>
                                </thead>

                                <tbody class="text-gray-700 text-sm divide-y divide-gray-200"">
                                    @forelse ($experiences as $experience)
                                        <tr class="border-b hover:bg-gray-100 transition ">
                                            <td class="py-3 px-6">{{ $experience->id }}</td>
                                            <td class="py-3 px-6">
                                                @if ($experience->image)
                                                    <img src="{{ asset($experience->image->path) }}"
                                                        alt="Experience Image"
                                                        class="w-16 h-16 object-cover rounded">
                                                @else
                                                    <div
                                                        class="bg-gray-200 border-2 border-dashed rounded-xl w-auto h-9 flex items-center justify-center">
                                                        <span class="text-gray-500 text-xs">No Image</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-3 px-6">
                                                {{ $experience->job_title }}
                                            </td>
                                            <td class="py-3 px-6">
                                                {{ $experience->start_date->format('M Y') }}
                                            </td>
                                            <td class="py-3 px-6">
                                                {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}
                                            </td>
                                            <td class="py-3 px-6">
                                                <a href="{{ route('admin.experiences.restore', $experience->id) }}"
                                                    class="inline-flex bg-amber-400 hover:bg-amber-500 transition text-white font-bolds  py-2 px-4 rounded">
                                                    <i class="fas fa-undo"></i>
                                                </a>
                                                <form
                                                    action="{{ route('admin.experiences.forceDelete', $experience->id) }}"
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
                                            <td colspan="10" class="py-3 px-6 text-center">No experiences found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    {{ $experiences->links() }}

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
