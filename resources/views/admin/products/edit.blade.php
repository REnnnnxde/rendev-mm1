<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                    {{ $error }}
                </div>
                @endforeach
                @endif

                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $product->name) }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Price -->
                    <div class="mt-4">
                        <x-input-label for="Price" :value="__('Price')" />
                        <x-text-input id="Price" class="block mt-1 w-full" type="number" name="price" :value="old('price', $product->price)" required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!---- Description -->
                    <div class="mt-4">
                        <div class="col-span-full">
                            <label for="about" class="block text-sm/6 font-medium text-gray-900">About</label>
                            <div class="mt-2">
                                <textarea id="about" name="about" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">{{ old('about', $product->about) }}</textarea>
                            </div>

                        </div>

                        <!-- Category -->
                        <div class="mt-4">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <div class="relative">
                                <select name="category_id" id="category_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="{{ $product->category->id }}" disabled selected>{{ $product->category->name }}</option>
                                    @forelse ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                    <option value="" disabled>No categories available</option>
                                    @endforelse
                                </select>
                                <span class="absolute right-3 top-3 text-gray-500 pointer-events-none">
                                    <!-- Anda bisa menambahkan ikon panah di sini -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    </svg>
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <!-- Name -->
                            <div>
                                <x-input-label for="Photo" :value="__('Photo')" />
                                <img src="{{ Storage::url($product->photo) }}" alt="" class="w-20 h-20">
                                <x-text-input id="Photo" class="block mt-1 w-full" type="file" name="photo" autofocus autocomplete="Photo" />
                                <x-input-error :messages="$errors->get('Photo')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">


                            <x-primary-button class="ms-4">
                                {{ __(' Update Product') }}
                            </x-primary-button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>