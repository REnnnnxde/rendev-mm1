<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Manage Products') }}
            </h2>
            <a href="{{ route('admin.products.create') }}" 
               class="inline-block rounded-md bg-indigo-600 px-4 py-2 text-center font-medium text-white hover:bg-indigo-700 transition duration-200">
                Add Product
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm rounded-lg">
            <ul role="list" class="divide-y divide-gray-200">
                @forelse ($products as $product)
                <li class="flex justify-between items-center gap-x-6 py-5 px-4 hover:bg-gray-50">
                    <div class="flex items-center min-w-0 gap-x-4">
                        <img class="h-12 w-12 rounded-md object-cover bg-gray-50" 
                             src="{{ Storage::url($product->photo) }}" 
                             alt="{{ $product->name }}">
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold text-gray-900">{{ $product->name }}</p>
                            <p class="text-sm text-gray-700">Rp <span class="font-bold">{{ number_format($product->price, 0, ',', '.') }}</span></p>
                            <p class="text-xs text-gray-500 truncate">Category: {{ $product->category->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.products.edit', $product) }}" 
                           class="inline-block rounded-md bg-indigo-600 px-4 py-2 font-medium text-white hover:bg-indigo-700 transition duration-200">
                            Edit
                        </a>
                        <button onclick="openModal('{{ $product->name }}', '{{ route('admin.products.destroy', $product) }}')" 
                                class="inline-block rounded-md bg-red-500 px-4 py-2 font-medium text-white hover:bg-red-700 transition duration-200">
                            Delete
                        </button>
                    </div>
                </li>
                @empty
                <li class="py-5 px-4 text-center text-gray-500">
                    No products found.
                </li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-30 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
            <h3 class="text-lg font-semibold mb-4">Confirm Deletion</h3>
            <p id="modalMessage">Are you sure you want to delete this product?</p>
            <div class="flex justify-end mt-6">
                <button onclick="closeModal()" 
                        class="mr-2 inline-block rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-200">
                    Cancel
                </button>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-block rounded-md bg-red-500 px-4 py-2 text-white hover:bg-red-700 transition duration-200">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(productName, actionUrl) {
            document.getElementById('modalMessage').textContent = `Are you sure you want to delete "${productName}"?`;
            document.getElementById('deleteForm').action = actionUrl;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
