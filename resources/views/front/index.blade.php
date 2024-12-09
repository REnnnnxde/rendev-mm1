<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page | TOKO MM JB</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>

    <style>
        .fixed-size {
            width: 100%;
            height: 160px;
            object-fit: cover;
            object-position: center;
        }

        .product-card {
            position: relative;
            overflow: hidden;
            /* Menjaga gambar tetap dalam batas card */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .product-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 2px solid transparent;
            /* Awalnya transparan */
            border-radius: 8px;
            /* Sesuaikan dengan border-radius produk */
            transition: border-color 0.3s ease-in-out, transform 0.3s ease-in-out;
            /* Menambahkan transformasi untuk garis */
            pointer-events: none;
            /* Agar tidak mengganggu interaksi dengan elemen lain */
        }

        .product-card:hover::before {
            border-color: #FFD700;
            /* Warna kuning pada hover */
            transform: scale(1.05);
            /* Membesarkan garis kuning saat hover */
        }

        .product-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px) scale(1.05);
            /* Efek zoom pada card dan gambar */
        }

        .image-container {
            transition: transform 0.3s ease-in-out;
        }

        .image-container:hover img {
            transform: scale(1.05);
            /* Membesarkan gambar saat hover */
        }

        .add-to-cart {
            transition: background-color 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        .add-to-cart:hover {
            background-color: #004aad;
            transform: scale(1.05);
            /* Perbesar sedikit tombol saat hover */
        }

        /* Most Purchased - Card */
        .product-card {
            position: relative;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .product-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px) scale(1.05);
            /* Efek zoom pada card */
        }

        /* Gambar */
        .product-card img {
            transition: transform 0.3s ease-in-out;
        }

        .product-card:hover img {
            transform: scale(1.1);
            /* Gambar akan memperbesar sedikit */
        }

        /* Garis pemisah */
        .product-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 2px solid transparent;
            border-radius: 8px;
            transition: border-color 0.3s ease-in-out, transform 0.3s ease-in-out;
            pointer-events: none;
        }

        .product-card:hover::before {
            border-color: #FFD700;
            /* Warna kuning pada hover */
            transform: scale(1.05);
            /* Membesarkan garis kuning */
        }

        .testimonial-container {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }

        .author-info {
            text-align: right;
            font-style: italic;
        }

        .author-info strong {
            font-style: normal;
        }

        .testimonial-image {
            display: block;
            margin: 20px auto;
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .quote {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            /* Warna hitam tipis */
            text-align: center;
            font-style: italic;
            /* Membuat teks miring */
        }

    </style>
</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <!-- Topbar -->
    <section class="flex items-center justify-between gap-5 wrapper">
        <div class="flex items-center gap-3">
            <div class="bg-white rounded-full p-[5px] flex justify-center items-center">
                <img src="{{ asset('assets/images/avatar_1.png') }}"
                    class="size-[50px] rounded-full" alt="">
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
                <img src="{{ asset('assets/svgs/ic-shopping-bag.svg') }}" class="size-5" alt="">
            </a>
        </div>
    </section>
    <!-- Floating navigation -->
    <nav class="fixed z-50 bottom-[30px] bg-black rounded-[50px] pt-[18px] px-10 left-1/2 -translate-x-1/2 w-80">
        <div class="flex items-center justify-center gap-5 flex-nowrap">
            <a href="{{ route('front.index') }}"
                class="flex flex-col items-center justify-center gap-1 px-1 group is-active">
                <img src="{{ asset('assets/svgs/ic-grid.svg') }}"
                    class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Home
                </p>
            </a>
            <a href="{{ route('front.location') }}"
                class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-location.svg') }}"
                    class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Location
                </p>
            </a>
            <a href="{{ route('carts.index') }}"
                class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-note.svg') }}"
                    class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Orders
                </p>
            </a>

            <a href="{{ route('dashboard') }}"
                class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-profile.svg') }}"
                    class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Profile
                </p>
            </a>
        </div>
    </nav>
    <!-- Header -->
    <section class="wrapper flex flex-col gap-2.5 items-center justify-center">
        <p class="text-4xl font-extrabold text-center">
            Temukan Product <br>
            Terbaik Anda
        </p>
        <!-- <form action="{{ route('front.search') }}" method="GET" id="searchForm" class="w-full flex items-center">
            <button type="submit" class="ml-2 py-3.5 px-6 rounded-[50px] font-semibold text-white bg-primary hover:bg-primary-dark transition duration-200">
                Search
            </button>
        </form> -->
    </section>
    <!-- Your last order -->
    <section class="wrapper">
        <div class="flex justify-between gap-5 items-center py-3.5 px-6 rounded-2xl relative bg-left bg-no-repeat bg-cover bg-[url('{{ asset('assets/svgs/pipeline.svg') }}')]"
            style="background-color: #FFD700;">
            <!-- Teks Ajak Pengguna -->
            <div class="flex flex-col gap-2">
                <p class="text-base font-weak text-black ">
                    Lagi Rame Nih! <br>
                    Ayok, cari produk yang kamu suka!
                </p>
            </div>



            <!-- Tombol Pencarian -->
            <form action="{{ route('front.search') }}" method="GET" id="searchForm"
                class="w-full flex items-center mt-2 sm:mt-0">
                <!-- Gambar -->
                <!-- <img src="{{ asset('assets/images/1.png') }}" class="w-[70px] h-[70px] object-cover" alt="Product Image"><br> -->

                <button type="submit"
                    class="ml-auto py-2 px-5 rounded-[50px] font-semibold text-white bg-primary hover:bg-primary-dark transition duration-200">
                    Cari Produk
                </button>

            </form>
        </div>
    </section>
    <!-- List Categories -->
    <section class="wrapper !px-0 flex flex-col gap-2.5">
        <p class="px-4 text-lg font-bold">
            Categories
        </p>
        <div id="categoriesSlider" class="relative">
            <!-- Diabetes -->
            @forelse($categories as $category)
                <div class="inline-flex gap-2.5 items-center py-3 px-3.5 relative bg-white rounded-xl mr-4">
                    <img src="{{ Storage::url($category->icon) }}" class="size-10" alt="">
                    <a href="{{ route('front.search', $category->slug) }}"
                        class="text-base font-semibold truncate stretched-link">
                        {{ $category->name }}
                    </a>
                </div>
            @empty
                <p>Belum Ada kategori tersedia.</p>
            @endforelse

        </div>
    </section>
    <!-- List Products -->
    <section class="wrapper !px-0 flex flex-col gap-2.5">
        <div class="flex flex-col items-center">
            <div class="w-full p-4 mt-4 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold">Latest Products</h3>
                    <a href="{{ route('front.product') }}" class="text-blue-500 font-bold">See All</a>
                </div><br>
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @forelse($products as $product)
                        <div
                            class="product-card bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl">
                            <div class="image-container relative overflow-hidden">
                                <img src="{{ Storage::url($product->photo) }}" alt="Product Image"
                                    class="w-full h-40 object-cover object-center transition-transform duration-300 ease-in-out transform hover:scale-110 fixed-size">
                            </div>
                            <div class="p-4">
                                <a href="{{ route('front.product.details', $product->slug) }}"
                                    class="text-lg font-bold text-gray-800 hover:text-blue-500 transition-colors duration-300">{{ $product->name }}</a>
                                <h5 class="text-gray-600">
                                    - {{ $product->category->name }}
                                </h5>
                                <p class="text-gray-600">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <div class="mt-2">

                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Belum Ada produk tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <!-- wrapper -->
    <section class="wrapper">
        <div style="background-color: #FFD700;"
            class="py-3.5 px-5 rounded-2xl relative bg-right-bottom bg-no-repeat bg-auto">
            <img src="{{ asset('assets/svgs/cloud.svg') }}" class="-ml-1.5 mb-1.5" alt="">
            <div class="flex flex-col gap-4 mb-[23px]">
                <p class="text-base font-bold">
                    Produk berkualitas <br>
                    untuk melengkapi kebutuhan Anda
                </p>
                <a href="{{ route('front.product') }}"
                    class="rounded-full bg-white text-primary flex w-max gap-2.5 px-6 py-2 justify-center items-center text-base font-bold">
                    Lihat semua produk
                </a>
            </div>
        </div>
    </section>
    <!-- Most Purchased -->
    <section class="wrapper flex flex-col gap-2.5 pb-20">
        <p class="text-base font-bold">
            Most Purchased
        </p>
        <div class="flex flex-col gap-4">
            @foreach($products->take(6) as $product)

                <div class="product-card py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center relative">
                    <img src="{{ Storage::url($product->photo) }}"
                        class="w-full max-w-[70px] max-h-[70px] object-contain" alt="">

                    <!-- Garis pemisah antara gambar dan informasi produk -->
                    <div
                        class="flex flex-wrap items-center justify-between w-full gap-1 border-l-2 border-gray-300 pl-4">
                        <div class="flex flex-col gap-1 w-full">
                            <a href="{{ route('front.product.details', $product->slug) }}"
                                class="text-base font-semibold w-full text-right truncate stretched-link block">
                                {{ $product->name }}
                            </a>
                            <p class="text-sm text-grey text-right">
                                Rp
                                {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="wrapper flex flex-col gap-2.5 pb-20">
        <div id="FAQ" class="bg-[#F6F7FA] w-full py-20 px-[10px] mt-20 mb-10">
            <div class="container max-w-[1000px] mx-auto">
                <div class="flex flex-col lg:flex-row gap-[50px] sm:gap-[70px] items-center">
                    <!-- Bagian Title dan Button "Contact Us" -->
                    <div class="flex flex-col gap-[30px]">
                        <h2 class="font-bold text-4xl leading-[45px] text-center text-gray-800">Frequently Asked
                            Questions</h2><br>

                    </div>
                    <!-- FAQ Accordion -->
                    <div class="flex flex-col gap-[30px] sm:w-[603px] shrink-0">

                        <!-- Accordion Item 1 -->
                        <div
                            class="accordion-item p-5 rounded-2xl bg-white w-full shadow-lg hover:shadow-2xl transition-shadow">
                            <button
                                class="accordion-button flex justify-between gap-2 items-center w-full text-left transition-all duration-300">
                                <span class="font-semibold text-lg text-gray-800">Bagaimana cara pembayaran di My
                                    Furniture?</span>
                                <div class="arrow w-6 h-6 flex shrink-0 transform transition-all duration-1000">
                                    <span class="text-xl font-bold transform transition-all duration-1000">+</span>
                                    <!-- Teks "+" sebagai simbol -->
                                </div>
                            </button>
                            <div
                                class="accordion-content hidden mt-4 text-gray-600 text-sm leading-[30px] max-h-0 overflow-hidden transition-all duration-700 ease-in-out">
                                <br>
                                <p>Kami menerima berbagai metode pembayaran, termasuk transfer bank, kartu kredit, dan
                                    e-wallet seperti OVO dan GoPay. Semua transaksi dilakukan dengan aman melalui sistem
                                    pembayaran yang terjamin.</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="flex flex-col gap-[30px] sm:w-[603px] shrink-0">

                        <!-- Accordion Item 2 -->
                        <div
                            class="accordion-item p-5 rounded-2xl bg-white w-full shadow-lg hover:shadow-2xl transition-shadow">
                            <button
                                class="accordion-button flex justify-between gap-2 items-center w-full text-left transition-all duration-300">
                                <span class="font-semibold text-lg text-gray-800">Bagaimana cara pembayaran di My
                                    Furniture?</span>
                                <div class="arrow w-6 h-6 flex shrink-0 transform transition-all duration-1000">
                                    <span class="text-xl font-bold transform transition-all duration-1000">+</span>
                                    <!-- Teks "+" sebagai simbol -->
                                </div>
                            </button>
                            <div
                                class="accordion-content hidden mt-4 text-gray-600 text-sm leading-[30px] max-h-0 overflow-hidden transition-all duration-700 ease-in-out">
                                <br>
                                <p>Kami menerima berbagai metode pembayaran, termasuk transfer bank, kartu kredit, dan
                                    e-wallet seperti OVO dan GoPay. Semua transaksi dilakukan dengan aman melalui sistem
                                    pembayaran yang terjamin.</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="flex flex-col gap-[30px] sm:w-[603px] shrink-0">

                        <!-- Accordion Item 3 -->
                        <div
                            class="accordion-item p-5 rounded-2xl bg-white w-full shadow-lg hover:shadow-2xl transition-shadow">
                            <button
                                class="accordion-button flex justify-between gap-2 items-center w-full text-left transition-all duration-300">
                                <span class="font-semibold text-lg text-gray-800">Bagaimana cara pembayaran di My
                                    Furniture?</span>
                                <div class="arrow w-6 h-6 flex shrink-0 transform transition-all duration-1000">
                                    <span class="text-xl font-bold transform transition-all duration-1000">+</span>
                                    <!-- Teks "+" sebagai simbol -->
                                </div>
                            </button>
                            <div
                                class="accordion-content hidden mt-4 text-gray-600 text-sm leading-[30px] max-h-0 overflow-hidden transition-all duration-700 ease-in-out">
                                <br>
                                <p>Kami menerima berbagai metode pembayaran, termasuk transfer bank, kartu kredit, dan
                                    e-wallet seperti OVO dan GoPay. Semua transaksi dilakukan dengan aman melalui sistem
                                    pembayaran yang terjamin.</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="flex flex-col gap-[30px] sm:w-[603px] shrink-0">

                        <!-- Accordion Item 4 -->
                        <div
                            class="accordion-item p-5 rounded-2xl bg-white w-full shadow-lg hover:shadow-2xl transition-shadow">
                            <button
                                class="accordion-button flex justify-between gap-2 items-center w-full text-left transition-all duration-300">
                                <span class="font-semibold text-lg text-gray-800">Bagaimana cara pembayaran di My
                                    Furniture?</span>
                                <div class="arrow w-6 h-6 flex shrink-0 transform transition-all duration-1000">
                                    <span class="text-xl font-bold transform transition-all duration-1000">+</span>
                                    <!-- Teks "+" sebagai simbol -->
                                </div>
                            </button>
                            <div
                                class="accordion-content hidden mt-4 text-gray-600 text-sm leading-[30px] max-h-0 overflow-hidden transition-all duration-700 ease-in-out">
                                <br>
                                <p>Kami menerima berbagai metode pembayaran, termasuk transfer bank, kartu kredit, dan
                                    e-wallet seperti OVO dan GoPay. Semua transaksi dilakukan dengan aman melalui sistem
                                    pembayaran yang terjamin.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="wrapper flex flex-col gap-2.5 pb-20 mb-32">
        <div class="container">
            <div class="flex flex-col gap-[30px]">
                <h2 class="font-bold text-4xl leading-[45px] text-center text-gray-800">
                    Apa Kata Mereka, Tentang Toko Kami ?
                </h2><br>
            </div>
            <div class="quote" id="testimonial-message"
                style="font-size: 16px; font-weight: semibold; color: #333; text-align: center; font-style: italic;">
                &ldquo;&rdquo;
            </div>

            <div class="author" id="testimonial-user">
                <div class="author-info">
                    <strong></strong><br>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer (Optional) -->
    <section class="wrapper">
        <p class="text-center text-sm text-grey py-5">
            &copy; 2024 My Furniture. All Rights Reserved.
        </p>
    </section>

    <!-- Menambahkan jarak tambahan dengan <br> -->
    <br>
    <br>
    <br>
    <br>

    <!-- JavaScript -->
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://unpkg.com/flickity-fade@1/flickity-fade.js"></script>
    <script src="js/carousel.js"></script>
    <script src="js/accordion.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="js/modal-video.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="{{ asset('scripts/sliderConfig.js') }}" type="module"></script>

    <!-- Jika tidak ada testimonial -->
    @if($testimonials->isEmpty())
        <p class="text-white text-center mt-4">Belum Ada Testimoni Tersedia.</p>
    @endif

    <script>
    const testimonials = {!! json_encode($testimonials) !!}; // Data testimonial dari server

    function showRandomTestimonial() {
        if (testimonials.length === 0) return;

        const randomIndex = Math.floor(Math.random() * testimonials.length);
        const testimonial = testimonials[randomIndex];

        // Update testimonial message dan nama user
        document.getElementById('testimonial-message').innerText = `"${testimonial.message}"`;
        document.getElementById('testimonial-user').innerHTML = `
            <strong>- ${testimonial.user.name}</strong><br>
        `;
    }

    // Tampilkan testimonial pertama saat halaman dimuat
    showRandomTestimonial();

    // Ubah testimonial setiap 4 detik
    setInterval(showRandomTestimonial, 4000);
</script>



    <!-- JavaScript untuk Accordion dengan Animasi -->
    <script>
        // Menambahkan fungsionalitas accordion dengan animasi
        const accordionButtons = document.querySelectorAll('.accordion-button');

        accordionButtons.forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const arrow = button.querySelector('.arrow');

                // Toggle content visibility
                content.classList.toggle('hidden');
                content.style.maxHeight = content.classList.contains('hidden') ? '0' :
                    `${content.scrollHeight}px`;

                // Rotate arrow symbol (Change "+" to "-" when open, "+" when closed)
                if (content.classList.contains('hidden')) {
                    arrow.innerHTML = "+"; // When closed
                } else {
                    arrow.innerHTML = "-"; // When open
                }
            });
        });

    </script>


</body>

</html>
