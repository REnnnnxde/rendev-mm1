<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Location | My Furniture</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        /* Responsive iframe styling */
        .map-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding-top: 56.25%; /* Aspect ratio 16:9 */
            max-width: 800px; /* Maksimum lebar untuk tampilan desktop */
            margin: auto; /* Untuk memastikan div terpusat */
        }
        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
</head>

<body>
    <!-- Topbar -->
    <section class="wrapper flex items-center justify-between gap-5">
        <div class="flex items-center gap-3">
            <div class="bg-white rounded-full p-[5px] flex justify-center items-center">
                <img src="{{ asset('assets/svgs/avatar.svg') }}" class="size-[50px] rounded-full" alt="">
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
                <img src="{{ asset('assets/svgs/ic-shopping-bag.svg') }}" class="size-5" alt="">
            </a>
        </div>
    </section>

    <!-- Floating navigation -->
    <nav class="fixed z-50 bottom-[30px] bg-black rounded-[50px] pt-[18px] px-10 left-1/2 -translate-x-1/2 w-80">
        <div class="flex items-center justify-center gap-5">
            <a href="{{ route('front.index') }}" class="flex flex-col items-center justify-center gap-1 px-1 group ">
                <img src="{{ asset('assets/svgs/ic-grid.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Home
                </p>
            </a>
            <a href="{{ route('front.location') }}" class="flex flex-col items-center justify-center gap-1 px-1 group is-active">
                <img src="{{ asset('assets/svgs/ic-location.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Location
                </p>
            </a>
            <a href="{{ route('carts.index') }}" class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-note.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Orders
                </p>
            </a>
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Profile
                </p>
            </a>
        </div>
    </nav>

    <!-- Header -->
    <section class="wrapper flex flex-col items-center justify-center gap-5 py-5">
        <h1 class="text-4xl font-extrabold text-center">Lokasi Toko Kami</h1>
        <p class="text-base text-center text-grey">Temukan kami di lokasi berikut, atau hubungi kami untuk informasi lebih lanjut.</p>
    </section>

    <!-- Maps -->
    <section class="wrapper">
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.752253560788!2d109.87739607458657!3d1.3245334986629107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31fb43e18c31dd1f%3A0x3a6a2b7c4b17fa81!2sToko%20MM!5e0!3m2!1sid!2sid!4v1730945678156!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- Informasi Alamat -->
    <section class="wrapper flex flex-col items-center gap-2.5 mt-5">
        <h2 class="text-2xl font-semibold">Alamat Toko</h2>
        <p class="text-center text-base text-grey">Jl. Contoh No.123, Jakarta, Indonesia</p>
        <p class="text-center text-sm text-grey">Telepon: +62 123-4567-890</p>
    </section>
      


</body>

</html>
