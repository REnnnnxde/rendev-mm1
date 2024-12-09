<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->orderBy('created_at', 'desc')->get();
        // dd($products);
        return view('admin.products.index', [
            'products' => $products
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        //
        $categories = Category::all();
        return view('admin.products.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Memeriksa apakah data terisi dengan benar
        // dd($request); // Jika Anda ingin melihat lagi
    
        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'about' => 'required|string',
            'category_id' => 'required|integer',
            'price' => 'required|integer',
           'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);
    
        // Mulai transaksi
        DB::beginTransaction();
    
        try {
            // Store photo if present
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('product_photos', 'public');
                $validated['photo'] = $photoPath; // Simpan path ke validated
            }
    
            // Generate slug
            $validated['slug'] = Str::slug($validated['name']); // Generate slug dari nama
    
            // Buat kategori
            $newProduct = Product::create($validated); // Pastikan ini bekerja
    
            // Commit transaksi
            DB::commit();
    
            // Redirect dengan pesan sukses
            return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
    
            // Throw validation exception dengan pesan kustom
            throw ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
         //
         $categories = Category::all();
         return view('admin.products.edit', [
             'categories' => $categories,
             'product' => $product
         ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //

        // Memeriksa apakah data terisi dengan benar
        // dd($request); // Jika Anda ingin melihat lagi
    
        // Validasi
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'about' => 'sometimes|string',
            'category_id' => 'sometimes|integer',
            'price' => 'sometimes|integer',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
    
        // Mulai transaksi
        DB::beginTransaction();
    
        try {
            // Store photo if present
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('product_photos', 'public');
                $validated['photo'] = $photoPath; // Simpan path ke validated
            }
    
            // Generate slug
            $validated['slug'] = Str::slug($validated['name']); // Generate slug dari nama
    
            // Buat kategori
            $product->update($validated); // Pastikan ini bekerja
    
            // Commit transaksi
            DB::commit();
    
            // Redirect dengan pesan sukses
            return redirect()->route('admin.products.index')->with('success', 'Product edited successfully');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
    
            // Throw validation exception dengan pesan kustom
            throw ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        //
        try {
            // Hapus kategori
            $product->delete();
    
            // Redirect dengan pesan sukses
            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            // Throw validation exception dengan pesan kustom
            throw ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);
        }
        
    }
}
