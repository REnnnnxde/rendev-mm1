<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ Auth::user()->hasRole('owner') ? __('Product Orders') : __('Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm rounded-lg">
            <ul role="list" class="divide-y divide-gray-200">

                @forelse($product_transactions as $product_transaction)
                <li class="flex justify-between items-center gap-x-6 py-5 px-4 hover:bg-gray-50">
                    <div class="flex items-center min-w-0 gap-x-4">
                        <img class="h-12 w-12 rounded-full object-cover bg-gray-50"
                            src="https://via.placeholder.com/150" alt="User Profile Picture">
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold text-gray-900">{{ $product_transaction->user->name }}</p>
                            <p class="mt-1 truncate text-xs text-gray-500">Rp. {{ number_format($product_transaction->total_amount, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 mt-1 hidden md:flex">Order Date: {{ $product_transaction->created_at }}</p>
                        </div>
                    </div>
                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                        <p class="text-sm text-gray-900">Status</p>
                        <div class="mt-1 flex items-center gap-x-1.5">
                            @if($product_transaction->is_paid)
                            <div class="flex-none rounded-full bg-yellow-500/20 p-1">
                                <div class="h-1.5 w-1.5 rounded-full bg-green-500"></div>
                            </div>
                            <p class="text-xs text-gray-500">SUCCESS</p>
                            @else
                            <div class="flex-none rounded-full bg-yellow-500/20 p-1">
                                <div class="h-1.5 w-1.5 rounded-full bg-yellow-500"></div>
                            </div>
                            <p class="text-xs text-gray-500">PENDING</p>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('product_transactions.show', $product_transaction->id) }}"
                        class=" sm:inline-block rounded-md bg-blue-600 px-4 py-2 text-center font-medium text-white hover:bg-blue-700 transition duration-200">
                        View Detail
                    </a>
                </li>
                @empty
                <li class="flex justify-between items-center gap-x-6 py-5 px-4 hover:bg-gray-50">
                    <div class="flex items-center min-w-0 gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold text-gray-400">Belum tersedia transaksi</p>
                        </div>
                    </div>
                </li>
                @endforelse

            </ul>
        </div>
    </div>

</x-app-layout>