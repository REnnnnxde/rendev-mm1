<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Order Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-lg p-6">
            <!-- Order Info -->
            <div class="mb-6">
                <div class="flex items-center gap-x-6 mb-4">
                    <img class="h-14 w-14 rounded-full object-cover bg-gray-100"
                        src="{{ asset('assets/images/avatar_1.png') }}" alt="User Profile Picture">
                    <div class="flex-auto">
                        <p class="text-sm font-semibold text-gray-900">{{ $productTransaction->user->name }}</p>
                        <p class="mt-1 truncate text-xs text-gray-500">Rp. {{ number_format($productTransaction->total_amount, 0, ',', '.') }}</p>

                    </div>
                    <div class="text-center">
                        <p class="text-xs text-gray-500 mt-1">Order Date: {{ $productTransaction->created_at->format('d-m-Y') }}</p>

                    </div>
                </div>
            </div>
            <hr class="my-4">

            <!-- Product and Payment Proof Section -->
            <div class="grid grid-cols-1 gap-6">
                <!-- Product List (Left Column) -->
                <div class="col-span-2">
                    <p class="text-xl font-semibold text-gray-900 mb-4">List of Products</p>

                    <!-- Produk 1 -->
                    <div class="space-y-4 p-6">
                        @forelse ($productTransaction->transactionDetails as $detail)
                        <div class="flex items-center gap-4 md:gap-6">
                            <a href="#" class="h-14 w-14 shrink-0">
                                <img class="h-full w-full dark:hidden" src="{{ Storage::url($detail->product->photo) }}" alt="Product Image 1" />
                            </a>
                            <a href="#" class="min-w-0 flex-1 font-medium text-gray-900 hover:underline dark:text-white text-sm md:text-base">{{ $detail->product->name }}</a>
                        </div>
                        <div class="flex items-center justify-between gap-2 md:gap-4">
                            <p class="text-xs md:text-sm font-normal text-gray-500 dark:text-gray-400">
                                <span class="font-medium text-gray-900 dark:text-white">Kategori: </span>{{ $detail->product->category->name }}
                            </p>
                            <div class="flex items-center justify-end gap-2 md:gap-4">
                                <p class="text-sm md:text-xl font-bold leading-tight text-gray-900 dark:text-white">Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-center text-gray-500">Tidak ada detail transaksi.</p>
                        @endforelse
                    </div>


                    <p class="text-xl font-semibold text-gray-900 mt-8 mb-4">Detail of Payment</p>
                    <ul role="list" class="divide-y divide-gray-200 bg-gray-50 rounded-lg shadow-inner p-4">
                        <li class="py-5">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="flex items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                                    <span class="material-icons text-gray-700 mr-2 font-bold">Address:</span>
                                    <p class="text-sm font-bold text-gray-500">{{ $productTransaction->address }}</p>
                                </div>
                                <div class="flex items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                                    <span class="material-icons text-gray-700 mr-2 font-bold">City:</span>
                                    <p class="text-sm font-bold text-gray-500">{{ $productTransaction->city }}</p>
                                </div>
                                <div class="flex items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                                    <span class="material-icons text-gray-700 mr-2 font-bold">Post Code:</span>
                                    <p class="text-sm font-bold text-gray-500">{{$productTransaction->post_code}}</p>
                                </div>
                                <div class="flex items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                                    <span class="material-icons text-gray-700 mr-2 font-bold">Phone Number:</span>
                                    <p class="text-sm font-bold text-gray-500">{{$productTransaction->phone_number}}</p>
                                </div>
                                <div class="bg-gray-100 p-4 rounded-lg shadow-sm w-full">
                                    <div class="flex items-start flex-col">
                                        <span class="material-icons text-gray-700 mr-2 font-bold">note</span>
                                        <p class="text-sm font-bold text-gray-500 w-full">{{ $productTransaction->notes }}</p>
                                    </div>
                                </div>
                            </div>

                        </li>

                    </ul>
                    <hr class="my-6 border-gray-300">

                    <div class="flex justify-center">
                        @role('owner')
                        @if($productTransaction->is_paid)
                        <button onclick="contactbuyer()" class="font-bold py-3 px-6 rounded-full text-white bg-green-500 hover:bg-blue-600 transition duration-200 ease-in-out shadow-md">
                            Contact {{ $productTransaction->user->name }}
                        </button>


                        @else
                        <form action="{{ route('product_transactions.update', $productTransaction) }}" method="POST" class="mr-2">
                            @csrf
                            @method('PUT')
                            <button class="font-bold py-3 px-6 rounded-full text-white bg-green-500 hover:bg-green-600 transition duration-200 ease-in-out shadow-md" type="submit">
                                Approve Orders
                            </button>
                        </form>
                        @endif
                        @endrole

                        @role('buyer')
                        <button onclick="contactAdmin()" class="font-bold py-3 px-6 rounded-full text-white bg-blue-500 hover:bg-blue-600 transition duration-200 ease-in-out shadow-md">
                            Contact Admin
                        </button>
                        @endrole
                    </div>

                </div>
                <!-- Payment Proof (Right Column) -->
                <div class="flex flex-col items-center">
                    <p class="text-xl font-semibold text-gray-900 mb-4">Payment Proof</p>
                    <img src="{{ Storage::url($productTransaction->proof) }}" class="h-72 w-72 rounded-md object-cover shadow-md" alt="Payment Proof">
                    <hr class="my-5 w-full border-gray-300">
                    <div class="mt-6 grow sm:mt-8 lg:mt-0">
                        <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Status Pembayaran</h3>
                            <ol class="relative ms-3 border-l border-gray-200 dark:border-gray-700">
                                <li class="mb-10 ms-6">
                                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                                        </svg>
                                    </span>
                                    <h4 class="mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Tanggal Pembelian: {{ $productTransaction->created_at }}</h4>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Menunggu konfirmasi pembayaran</p>
                                    <hr class="border-gray-300 mt-2"> <!-- Garis di bawah logo -->
                                </li>

                                <li class="mb-10 ms-6">
                                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 ring-8 ring-white dark:bg-primary-900 dark:ring-gray-800">
                                        <svg class="h-4 w-4 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
                                        </svg>
                                    </span>
                                    <h4 class="mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Pembayaran Diterima</h4>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Menunggu pemrosesan</p>
                                    <hr class="border-gray-300 mt-2"> <!-- Garis di bawah logo -->
                                </li>

                                <li class="ms-6 text-primary-700 dark:text-primary-500">
                                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 ring-8 ring-white dark:bg-primary-900 dark:ring-gray-800">
                                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                        </svg>
                                    </span>
                                    <div>
                                        <h4 class="mb-1 font-semibold text-lg">{{ $productTransaction->updated_at }}</h4>
                                        <p class="text-sm font-medium hover:underline">Status Pembayaran</p>
                                        <div class="flex items-center mt-1">
                                            @if($productTransaction->is_paid)
                                            <div class="flex-none rounded-full bg-green-200 p-1 mr-2">
                                                <div class="h-1.5 w-1.5 rounded-full bg-green-500"></div>
                                            </div>
                                            <p class="text-xs text-gray-500">SUCCESS</p>
                                            @else
                                            <div class="flex-none rounded-full bg-yellow-500/20 p-1 mr-2">
                                                <div class="h-1.5 w-1.5 rounded-full bg-yellow-500"></div>
                                            </div>
                                            <p class="text-xs text-gray-500">PENDING</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ol>

                            <hr class="my-5 w-full border-gray-300"> <!-- Garis horizontal di sini -->

                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Pengiriman Barang</h3>
                            <ol class="relative ms-3 border-l border-gray-200 dark:border-gray-700">
                                <li class="mb-10 ms-6">
                                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 ring-8 ring-white dark:bg-primary-900 dark:ring-gray-800">
                                        <svg class="h-4 w-4 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 4h3a2 2 0 0 1 2 2v3m-2-5l-7 7m7 0l-7 7m6-7h3a2 2 0 0 1 2 2v3" />
                                        </svg>
                                    </span>
                                    <h4 class="mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Pengiriman Barang</h4>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Barang sedang dalam perjalanan</p>
                                </li>
                            </ol>
                            <a href="{{ route('front.index') }}" class="font-bold py-3 px-6 rounded-full text-white bg-gray-500 hover:bg-gray-600 transition duration-200 ease-in-out shadow-md">Kembali</a>
                            <a href="#" class="mt-4 flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Detail Pesanan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function contactAdmin() {
        const adminNumber = '6282190466407'; // Ganti dengan nomor WhatsApp admin Anda
        const message = 'Halo, saya ingin bertanya tentang...'; // Pesan awal yang bisa diisi
        const url = `https://wa.me/${adminNumber}?text=${encodeURIComponent(message)}`;
        window.open(url, '_blank'); // Membuka link di tab baru
    }
    // Fungsi untuk menghubungi Customer
    function contactbuyer() {
        const buyerNumber = '{{ $productTransaction->phone_number }}'; // Mengambil nomor telepon dari data transaksi
        const message = 'Halo, saya ingin bertanya tentang...'; // Pesan awal yang bisa diisi
        const url = `https://wa.me/${buyerNumber}?text=${encodeURIComponent(message)}`;
        window.open(url, '_blank'); // Membuka link di tab baru
    }
</script>