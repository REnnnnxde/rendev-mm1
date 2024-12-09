<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Manage Testimonials') }}
            </h2>
            <a href="{{ route('admin.testimonials.create') }}" class="inline-block rounded-md bg-indigo-600 px-4 py-2 text-center font-medium text-white hover:bg-indigo-700 transition duration-200">
                Add Testimonial
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm rounded-lg">
            <ul role="list" class="divide-y divide-gray-200">
                @forelse ($testimonials as $testimonial)
                    <li class="flex justify-between items-center gap-x-6 py-5 px-4 hover:bg-gray-50">
                        <div class="flex items-center min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <h3 class="text-sm font-semibold text-gray-900">{{ $testimonial->user->name }}</h3>
                                <p class="text-sm text-gray-900">Testimonial: {{ $testimonial->message }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                               class="inline-block rounded-md bg-indigo-600 px-4 py-2 text-center font-medium text-white hover:bg-indigo-700 transition duration-200">
                                Edit
                            </a>
                            <button onclick="openModal('{{ $testimonial->message }}', '{{ route('admin.testimonials.destroy', $testimonial->id) }}')"
                                    class="inline-block rounded-md bg-red-500 px-4 py-2 text-center font-medium text-white hover:bg-red-700 transition duration-200">
                                Delete
                            </button>
                        </div>
                    </li>
                @empty
                    <p class="text-center text-gray-500 py-5">No testimonials found.</p>
                @endforelse
            </ul>
        </div>
    </div>

    <script>
        function openModal(message, deleteUrl) {
            if (confirm(`Are you sure you want to delete this testimonial: "${message}"?`)) {
                // Send DELETE request to the route
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        alert('Testimonial has been deleted');
                        location.reload(); // Refresh page to update list
                    } else {
                        alert('Failed to delete testimonial');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error deleting the testimonial.');
                });
            }
        }
    </script>
</x-app-layout>
