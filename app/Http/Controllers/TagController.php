<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('admin.categories.index');
        $tags = Tag::all();
        return view('admin.tag_products.index', [
            'tags' => $tags
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tag_products.create');
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
                $iconPath = $request->file('icon')->store('tag_icons', 'public');
                $validated['icon'] = $iconPath; // Simpan path ke validated
            }
    
            // Buat tag
            $newtag = Tag::create($validated); // Pastikan ini bekerja
    
            // Commit transaksi
            DB::commit();
    
            // // Redirect dengan pesan sukses
            // return redirect()->route('admin.tag_products.index')->with('success', 'Tag created successfully');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
    
            // Throw validation exception dengan pesan kustom
            throw ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);
        }
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        // return view('admin.tags.show', compact('tag')); // Show individual tag
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        // return view('admin.tags.edit', compact('tag')); // View to edit tag
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        // // Validate incoming request
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // // Update name
        // $tag->name = $request->name;

        // // Check if a new icon has been uploaded
        // if ($request->hasFile('icon')) {
        //     // Delete the old icon from storage
        //     Storage::delete('public/' . $tag->icon);

        //     // Store the new icon and update the tag
        //     $iconPath = $request->file('icon')->store('tags/icons', 'public');
        //     $tag->icon = $iconPath;
        // }

        // // Save the updated tag
        // $tag->save();

        // // Redirect with success message
        // return redirect()->route('admin.tags.index')->with('success', 'Tag successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        // // Delete the icon from storage
        // Storage::delete('public/' . $tag->icon);

        // // Delete the tag from the database
        // $tag->delete();

        // // Redirect with success message
        // return redirect()->route('admin.tags.index')->with('success', 'Tag successfully deleted.');
    }
}
