<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return view('admin.categories.index');
        $categories = Category::all();
        return view('admin.categories.index', [
            'categories' => $categories
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
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
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Mulai transaksi
        DB::beginTransaction();
    
        try {
            // Store icon if present
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('category_icons', 'public');
                $validated['icon'] = $iconPath; // Simpan path ke validated
            }
    
            // Generate slug
            $validated['slug'] = Str::slug($validated['name']); // Generate slug dari nama
    
            // Buat kategori
            $newCategory = Category::create($validated); // Pastikan ini bekerja
    
            // Commit transaksi
            DB::commit();
    
            // Redirect dengan pesan sukses
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Memeriksa apakah data terisi dengan benar
        // dd($request); // Jika Anda ingin melihat lagi
    
        // Validasi data
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'icon' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Mulai transaksi
        DB::beginTransaction();
    
        try {
            // Store icon if present
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('category_icons', 'public');
                $validated['icon'] = $iconPath; // Simpan path ke validated
            }
    
            // Generate slug
            $validated['slug'] = Str::slug($validated['name']); // Generate slug dari nama
    
            // Buat kategori
            $category->update($validated); // Pastikan ini bekerja
    
            // Commit transaksi
            DB::commit();
    
            // Redirect dengan pesan sukses
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
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
    public function destroy(Category $category)
    {
        //
        try {
            // Hapus kategori
            $category->delete();
    
            // Redirect dengan pesan sukses
            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            // Throw validation exception dengan pesan kustom
            throw ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);
        }
    }
}
