<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products | My Furniture</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <style>
        .products-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
            padding: 0 10px;
        }

        .product-card {
            width: calc(50% - 10px);
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-card .details {
            padding: 15px;
            text-align: center;
        }

        .product-card .name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-card .price {
            font-size: 14px;
            color: #f79c42;
            margin-bottom: 10px;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #f79c42;
            color: white;
            font-weight: bold;
            border-radius: 25px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #e68a28;
        }

        /* Pencarian */
        .search-container {
            margin: 20px 0;
            text-align: center;
        }

        .search-input {
            width: 80%;
            padding: 12px;
            border-radius: 30px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .product-card {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Topbar -->
    <section class="flex items-center justify-between gap-5 wrapper">
        <div class="flex items-center gap-3">
            <div class="bg-white rounded-full p-[5px] flex justify-center items-center">
                <img src="{{ asset('assets/svgs/avatar.svg') }}" class="size-[50px] rounded-full" alt="">
            </div>
            @if(session('message'))
            <div class="alert alert-warning p-3 mb-4 bg-yellow-100 text-yellow-800 rounded">
                {{ session('message') }}
            </div>
            @endif
            <div class="">
                <p class="text-base font-semibold capitalize text-primary">
                    @auth
                    {{ Auth::user()->name }}
                    @endauth
                    @guest
                    Guest
                    @endguest
                </p>
                <p class="text-sm">
                    Customer
                </p>
            </div>
        </div>
        <div class="flex items-center gap-[10px]">
            <a href="{{ route('carts.index') }}" type="button" class="p-2 bg-white rounded-full">
                <img src="{{asset('assets/svgs/ic-shopping-bag.svg')}}" class="size-5" alt="">
            </a>
        </div>
    </section>

    <!-- Header -->
    <section class="wrapper flex flex-col gap-2.5 items-center justify-center">
        <p class="text-4xl font-extrabold text-center">
            Temukan Product <br>
            Terbaik Anda
        </p>
    </section>

    <!-- Search Section -->
    <section class="search-container">
        <input type="text" id="search-input" class="search-input" placeholder="Cari produk...">
    </section>

    <!-- All Products -->
    <section class="wrapper !px-0 flex flex-col gap-2.5 pb-40">
        <p class="px-4 text-base font-bold">
            All Products
        </p>
        <div id="products-wrapper" class="products-wrapper">
            @forelse($products as $product)
            <div class="product-card" data-name="{{ $product->name }}">
                <img src="{{ Storage::url($product->photo) }}" alt="{{ $product->name }}">
                <div class="details">
                    <a href="{{ route('front.product.details', $product->slug) }}" class="name">
                        {{ $product->name }}
                    </a>
                    <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('front.product.details', $product->slug) }}" class="button">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <p>Belum Ada Produk Tersedia.</p>
            @endforelse
        </div>
    </section>
    <!-- Footer (Optional) -->
    <section class="wrapper">
        <p class="text-center text-sm text-grey py-5">
            &copy; 2024 My Furniture. All Rights Reserved.
        </p>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="{{ asset('scripts/sliderConfig.js') }}" type="module"></script>
    <script>
        // JavaScript untuk fitur pencarian
        document.getElementById('search-input').addEventListener('keyup', function() {
            var query = this.value.toLowerCase();
            var products = document.querySelectorAll('.product-card');
            products.forEach(function(product) {
                var productName = product.getAttribute('data-name').toLowerCase();
                if (productName.includes(query)) {
                    product.style.display = 'block'; // Menampilkan produk
                } else {
                    product.style.display = 'none'; // Menyembunyikan produk
                }
            });
        });
    </script>

</body>

</html>
