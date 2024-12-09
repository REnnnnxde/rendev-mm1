<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class TestimonialController extends Controller
{
    // Menampilkan form testimonial
    public function create()
    {
        return view('admin.testimonials.create');
    }

    // Menyimpan testimonial
    public function store(Request $request)
    {

        // Validasi input dari form
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengirim testimonial.');
        }

        // Menyimpan testimonial dengan data yang dikirim
        Testimonial::create([
            'user_id' => Auth::id(), // Menyimpan ID pengguna yang login
            'message' => $validated['message'],
        ]);

        return redirect()->back()->with('success', 'Testimonial Anda telah berhasil dikirim!');
    }


    // Menampilkan testimonial yang sudah dikirim oleh pengguna
    public function index()
    {
        $user = Auth::user();
        $testimonials = Testimonial::where('user_id', $user->id)->get();

    return view('admin.testimonials.index', [
        'testimonials' => $testimonials
    ]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        
        // Validasi data
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Update testimonial dengan data yang telah tervalidasi
            $testimonial->update($validated);

            // Commit transaksi
            DB::commit();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Throw validation exception dengan pesan kustom
            throw ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);
        }
    }



    public function destroy(Testimonial $testimonial)
    {
        try {
            $testimonial->delete();
            return response()->json(['success' => 'Testimonial deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete testimonial', 'message' => $e->getMessage()], 500);
        }
    }


    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', [
            'testimonial' => $testimonial
        ]);
    }
}
