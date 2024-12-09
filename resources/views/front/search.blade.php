<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results | Parma</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9fafb;
            color: #374151;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Topbar Styling */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Card Styling */
        .product-item {
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            border-radius: 8px;
            background-color: #ffffff;
            padding: 15px;
            display: flex;
            align-items: center;
        }

        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        /* Image Styling */
        .product-item img {
            border-radius: 8px;
            width: 70px;
            height: 70px;
            object-fit: cover;
            margin-right: 15px;
        }

        /* Product Information Styling */
        .product-info {
            flex-grow: 1;
        }

        /* Link Styling */
        .product-link {
            color: #1f2937;
            transition: color 0.2s;
            text-decoration: none;
            font-weight: bold;
        }

        .product-link:hover {
            color: #3b82f6;
        }

        /* Price Styling */
        .product-price {
            color: #059669;
            font-weight: 600;
            margin-top: 5px;
        }

        /* Search Input Styling */
        .search-input {
            width: 100%;
            padding: 10px 40px;
            border-radius: 50px;
            border: 1px solid #e5e7eb;
            font-size: 16px;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            border-color: #3b82f6;
        }

        /* Category and Results Styling */
        .category-container {
            display: flex;
            overflow-x: auto;
            /* Enable horizontal scrolling */
            padding: 10px 0;
            gap: 10px;
            scrollbar-width: thin;
            scrollbar-color: #d1d5db #f9fafb;
        }

        /* Custom scrollbar styling for WebKit browsers */
        .category-container::-webkit-scrollbar {
            height: 8px;
            /* Set scrollbar height */
        }

        .category-container::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            /* Thumb color */
            border-radius: 4px;
        }

        .category-container::-webkit-scrollbar-track {
            background-color: #f9fafb;
            /* Track color */
        }

        .category-item {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            min-width: 120px;
            /* Minimum width for category items */
            flex-shrink: 0;
            /* Prevent shrinking */
        }

        .category-item:hover {
            transform: scale(1.02);
        }

        .category-item img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        /* Responsive Design */
        @media (max-width : 768px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-input {
                margin-top: 10px;
            }
        }

        #selected-category {
            font-weight: bold;
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 10px;
        }
    </style>


</head>

<body>
    <!-- Topbar -->
    <section class="topbar">
        <a href="{{ route('front.index') }}" class="p-2 bg-white rounded-full">
            <img src="{{ asset('/assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="">
        </a>
        <p class="text-lg font-semibold">Search Products</p>
            <!-- <button type="button" class="p-2 bg-white rounded-full">
                <img src="{{ asset('/assets/svgs/ic-triple-dots.svg') }}" class="size-5" alt="">
            </button> -->
    </section>

    <!-- Form Search -->
    <section class="wrapper">
        <form action="{{ route('front.search') }}" method="GET" id="searchForm" class="w-full flex items-center">
            <input type="text" name="search" id="searchProduct" class="search-input" placeholder="Search by product name" value="{{ request()->search }}">
        </form>
    </section>

    <!-- List Categories -->
    <section class="wrapper gap-2.5">
        <p class="px-4 text-lg font-bold">Categories</p>
        <div class="category-container flex gap-4 overflow-x-auto whitespace-nowrap px-4">
            <!-- Tambahkan elemen HTML untuk menampilkan teks kategori yang dipilih -->
            <div class="category-item flex flex-col items-center" data-category-id="all">
                <img src="{{ asset('/assets/images/all.png') }}" alt="All Categories" class="w-16 h-16 object-cover"> <!-- Gambar placeholder -->
                <a href="" class="text-base font-semibold truncate">All</a>
            </div>

            @foreach ($categories as $category)
            <div class="category-item flex flex-col items-center" data-category-id="{{ $category->id }}">
                <img src="{{ Storage::url($category->icon) }}" alt="" class="w-16 h-16 object-cover">
                <a href="" class="text-base font-semibold truncate">{{ $category->name }}</a>
            </div>
            @endforeach
        </div>
    </section>


    <!-- Search Results -->
    <section class="wrapper flex flex-col gap-2.5">
        <p class="text-base font-bold" id="selected-category">Results</p>
        <div id="products-wrapper" class="flex flex-col gap-4">
            @foreach ($products as $product)
            <div class="product-item" data-product-id="{{ $product->id }}" data-product-category="{{ $product->category_id }}">
                <img src="{{ Storage::url($product->photo) }}" alt="">
                <div class="product-info">
                    <a href="{{ route('front.product.details', $product->slug) }}" class="product-link">{{ $product->name }}</a>
                    <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-base font-semibold">{{ $product->category->name }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // Tambahkan variabel untuk menyimpan state kategori yang dipilih
        var selectedCategory = sessionStorage.getItem('selectedCategory');
        // Tambahkan event listener pada setiap kategori

        document.querySelectorAll('.category-item').forEach(function(category) {
            category.addEventListener('click', function() {
                var categoryId = category.dataset.categoryId;
                if (categoryId === 'all') {
                    // Jika pilihan "All" dipilih, maka tampilkan semua produk
                    var products = document.querySelectorAll('.product-item');
                    products.forEach(function(product) {
                        product.style.display = 'flex';
                    });
                } else {
                    // Jika pilihan kategori lainnya dipilih, maka filter produk berdasarkan kategori
                    var products = document.querySelectorAll('.product-item');
                    products.forEach(function(product) {
                        var productId = product.dataset.productId;
                        var productCategory = product.dataset.productCategory;

                        if (productCategory == categoryId) {
                            product.style.display = 'flex';
                        } else {
                            product.style.display = 'none';
                        }
                    });
                }
            });
        });


        document.getElementById('searchProduct').addEventListener('keyup', function() {
            var query = this.value.toLowerCase();
            var products = document.querySelectorAll('.product-item');

            // Filter produk berdasarkan query dan kategori yang dipilih
            products.forEach(function(product) {
                var productName = product.querySelector('.product-link').innerText.toLowerCase();
                var productCategory = product.dataset.productCategory;

                if (selectedCategory !== null && productCategory != selectedCategory) {
                    product.style.display = 'none';
                } else if (productName.includes(query)) {
                    product.style.display = 'flex';
                } else {
                    product.style.display = 'none';
                }
            });
        });

        // Tambahkan kondisi untuk menampilkan produk yang sesuai dengan kategori yang dipilih setelah halaman di-refresh
        window.onload = function() {
            if (selectedCategory !== null) {
                var products = document.querySelectorAll('.product-item');
                products.forEach(function(product) {
                    var productCategory = product.dataset.productCategory;

                    if (productCategory == selectedCategory) {
                        product.style.display = 'flex';
                    } else {
                        product.style.display = 'none';
                    }
                });
            }
        };
    </script>
</body>

</html>