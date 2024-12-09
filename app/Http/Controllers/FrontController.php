<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\tag;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;
class FrontController extends Controller
{
    //
    public function index()
    {
      // Mengambil 6 produk acak beserta kategorinya
    $products = Product::with('category')->inRandomOrder()->take(6)->get();

        // Mengambil semua kategori
        $categories = Category::all();
        
        // Mengambil semua tag
        $tags = Tag::all();
        
        // Mengambil 3 testimonial terbaru
        $testimonials = Testimonial::with('user')->take(3)->get(); // Pastikan untuk memuat relasi user jika ada
    
        return view('front.index', [
            'products' => $products,
            'categories' => $categories,
            'testimonials' => $testimonials
        ]);
    }
    public function productList()
    {
        // Ambil semua produk dengan kategori terkait
        $products = Product::with('category')->orderBy('created_at', 'desc')->get();

        // Kirim data produk ke view depan
        return view('front.product', [
            'products' => $products
        ]);
    }

 
    public function location()
    {
        return view('front.location');
    }


    public function details(Product $product, tag $tags)
    {
    // dd($product);  
       $tag = Tag::all();

        // dd($tag);
        return view('front.details', [
            'product' => $product,
            'tags' => $tag
        ]);
        
    }

    ///TES
    public function carts()
{
    // Logika untuk menampilkan halaman keranjang jika sudah login
    return view('front.carts');
}



    public function search(Request $request)
{
    $products = Product::where('name', 'like', '%' . $request->search . '%')->get();
   $categories = Category::all();
    return view('front.search', [
        'products' => $products,
        'categories' => $categories

    ]);
}
public function show($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();
    return view('front.product_detail', compact('product'));
}

}
