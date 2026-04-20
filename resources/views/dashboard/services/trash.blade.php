<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Services</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Services') }}
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
                        <div class="overflow-x-auto">
                            <table class="w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">

                                <thead class="bg-gray-900 text-white uppercase text-sm tracking-wider">
                                    <tr>
                                        <th class="py-3 px-6 text-left">ID</th>
                                        <th class="py-3 px-6 text-left">Image</th>
                                        <th class="py-3 px-6 text-left">Name</th>
                                        <th class="py-3 px-6 text-left">Actions</th>

                                    </tr>
                                </thead>

                                <tbody class="text-gray-700 text-sm divide-y divide-gray-200"">
                                    @forelse ($services as $service)
                                        <tr class="border-b hover:bg-gray-100 transition ">
                                            <td class="py-3 px-6">{{ $service->id }}</td>
                                            <td class="py-3 px-6">
                                                @if ($service->image)
                                                    <img src="{{ asset($service->image->path) }}"
                                                        alt="{{ $service->name }}"
                                                        class="w-16 h-16 object-cover rounded">
                                                @else
                                                    <div
                                                        class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16" />
                                                @endif
                                            </td>
                                            <td class="py-3 px-6">{{ $service->name }}</td>
                                            <td class="py-3 px-6">
                                                <a href="{{ route('admin.services.restore', $service->id) }}"
                                                    class="inline-flex bg-amber-400 hover:bg-amber-500 transition text-white font-bolds  py-2 px-4 rounded">
                                                    <i class="fas fa-undo"></i>
                                                </a>
                                                <form action="{{ route('admin.services.forceDelete', $service->id) }}"
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
                                            <td colspan="10" class="py-3 px-6 text-center">No services found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    {{ $services->links() }}

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
