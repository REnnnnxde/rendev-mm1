<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
    
        // Menggunakan relasi yang sudah didefinisikan
        $ny_carts = $user->carts()->with('product')->get();

        return view('front.carts', [
            'ny_carts' => $ny_carts
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store($productId)
    // {
    //     //
    //     $user = Auth::user();

    //     $exist = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

    //     if ($existingCartItem) {
    //         return redirect()->route('cart.index');
    //     }

    //     DB::beginTransaction();
    //     try {
    //         $cart = Cart::updateOrCreate([
    //             'user_id' => $user->id,
    //             'product_id' => $productId,
    //         ]);
    //         $cart->save();
    //         DB::commit();

    //         return redirect()->route('cart.index');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         throw ValidationException::withMessages([
    //             'system_error' => ['System error! ' . $e->getMessage()],
    //         ]);
    //     }
    // }
    public function store($productId)
    {   
        // dd($productId);
        $user = Auth::user();

        // Cek apakah item sudah ada di keranjang
        $existingCartItem = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($existingCartItem) {
            return redirect()->route('carts.index');
        }

        DB::beginTransaction();

        try {
            $cart = Cart::updateOrCreate([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            $cart->save();

            DB::commit();
            return redirect()->route('carts.index');
            // DB::commit();
            // return redirect()->route('carts.index')->with('success', 'Item added to cart');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'system_error' => 'System error! ' . $e->getMessage(),
            ]);
        }
    }





    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
{
    try {
        // Hapus item dari keranjang
        $cart->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('carts.index')->with('success', 'Item deleted from cart successfully');
    } catch (\Exception $e) {
        // Log kesalahan untuk analisis lebih lanjut
        Log::error('Failed to delete cart item: ' . $e->getMessage());

        // Kembali ke halaman sebelumnya dengan pesan kesalahan
        return redirect()->back()->withErrors([
            'system_error' => 'System error! ' . $e->getMessage(),
        ]);
    }
}
    

}
