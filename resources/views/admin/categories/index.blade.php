<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Manage Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}" class="inline-block rounded-md bg-indigo-600 px-4 py-2 text-center font-medium text-white hover:bg-indigo-700 transition duration-200">
                Add Category
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm rounded-lg">
            <ul role="list" class="divide-y divide-gray-200">
                @forelse ($categories as $category)
                <li class="flex justify-between items-center gap-x-6 py-5 px-4 hover:bg-gray-50">
                    <div class="flex items-center min-w-0 gap-x-4">
                        <img class="h-12 w-12 rounded object-cover bg-gray-50" src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}">
                        <div class="min-w-0 flex-auto">
                            <h3 class="text-sm font-semibold text-gray-900">{{ $category->name }}</h3>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="inline-block rounded-md bg-indigo-600 px-4 py-2 text-center font-medium text-white hover:bg-indigo-700 transition duration-200">
                            Edit
                        </a>
                        <button onclick="openModal('{{ $category->name }}', '{{ route('admin.categories.destroy', $category) }}')"
                            class="inline-block rounded-md bg-red-500 px-4 py-2 text-center font-medium text-white hover:bg-red-700 transition duration-200">
                            Delete
                        </button>
                    </div>
                </li>
                @empty
                <p class="text-center text-gray-500 py-5">No categories found.</p>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-30 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
            <h3 class="text-lg font-semibold mb-4">Confirm Deletion</h3>
            <p id="modalMessage">Are you sure you want to delete this category?</p>
            <div class="flex justify-end mt-6">
                <button onclick="closeModal()" class="mr-2 inline-block rounded-md border border-gray-300 px-4 py-2 text-center font-medium text-gray-700 hover:bg-gray-100 transition duration-200">Cancel</button>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-block rounded-md bg-red-500 px-4 py-2 text-center font-medium text-white hover:bg-red-700 transition duration-200">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(categoryName, actionUrl) {
            document.getElementById('modalMessage').textContent = `Anda yakin ingin menghapus category "${categoryName}"?`;
            document.getElementById('deleteForm').action = actionUrl;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-app-layout>