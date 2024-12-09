<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonial | My Furniture</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
    <!-- Topbar -->
    <section class="wrapper flex items-center justify-between gap-5">
        <div class="flex items-center gap-3">
            <div class="bg-white rounded-full p-[5px] flex justify-center items-center">
                <img src="{{ asset('assets/svgs/avatar.svg') }}" class="size-[50px] rounded-full" alt="avatar">
            </div>
            @if(session('message'))
            <div class="alert alert-warning p-3 mb-4 bg-yellow-100 text-yellow-800 rounded">
                {{ session('message') }}
            </div>
            @endif
            <div>
                <p class="text-base font-semibold capitalize text-primary">
                    @auth
                    {{ Auth::user()->name }}
                    @endauth
                    @guest
                    Guest
                    @endguest
                </p>
                <p class="text-sm">Customer</p>
            </div>
        </div>
        <div class="flex items-center gap-[10px]">
            <a href="{{ route('carts.index') }}" type="button" class="p-2 bg-white rounded-full">
                <img src="{{ asset('assets/svgs/ic-shopping-bag.svg') }}" class="size-5" alt="shopping bag">
            </a>
        </div>
    </section>

    <!-- Testimonial Form -->
    <section class="wrapper flex justify-center mt-20">
        <div class="w-full max-w-xl p-5 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center mb-6">Kirimkan Testimonial Anda</h2>

            <form action="{{ route('testimonials.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="message" class="block text-lg font-semibold">Testimonial Anda</label>
                    <textarea name="message" id="message" rows="4" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" placeholder="Tulis testimonial Anda di sini..." required>{{ old('message') }}</textarea>
                    @error('message')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md mt-4">Kirim Testimonial</button>
            </form>
        </div>
    </section>

    <!-- Floating Navigation -->
    <nav class="fixed z-50 bottom-[30px] bg-black rounded-[50px] pt-[18px] px-10 left-1/2 -translate-x-1/2 w-80">
        <div class="flex items-center justify-center gap-5">
            <a href="{{ route('front.index') }}" class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-grid.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary" alt="home">
                <p class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Home
                </p>
            </a>
            <a href="{{ route('front.location') }}" class="flex flex-col items-center justify-center gap-1 px-1 group is-active">
                <img src="{{ asset('assets/svgs/ic-location.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary" alt="location">
                <p class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Location
                </p>
            </a>
            <a href="{{ route('carts.index') }}" class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-note.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary" alt="orders">
                <p class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Orders
                </p>
            </a>
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary" alt="profile">
                <p class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Profile
                </p>
            </a>
        </div>
    </nav>

</body>

</html>
