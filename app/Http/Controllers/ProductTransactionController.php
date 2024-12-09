<?php

namespace App\Http\Controllers;

use App\Models\ProductTransaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProductTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     $user = Auth::user();

    //     if ($user->hasRole('buyer')) {
    //         $product_transactions = $user->product_transactions()->orderBy('id', 'desc')->get();
    //     } else {
    //         $product_transactions = ProductTransaction::orderBy('id', 'desc')->get();
    //     }


    //     return view('admin.product_transactions.index', [
    //         'product_transactions' => $product_transactions
    //     ]);

    // }

    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        if ($user->hasRole('buyer')) {
            // Jika pengguna adalah buyer, ambil transaksi miliknya dengan informasi pengguna terkait
            $product_transactions = $user->product_transactions()->with('user')->orderBy('id', 'desc')->get();
        } else {
            // Jika pengguna bukan buyer (misalnya owner), ambil semua transaksi dengan informasi pengguna terkait
            $product_transactions = ProductTransaction::with('user')->orderBy('id', 'desc')->get();
        }

        // Kirimkan data transaksi ke view
        // dd($product_transactions);
        return view('admin.product_transactions.index', [
            'product_transactions' => $product_transactions
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
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'proof'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'notes' => 'required|string|max:65535',
            'post_code' => 'required|integer',
            'phone_number' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $subtotalCents = 0;
            $deliveryFeeCents = 1000 * 100;

            $cartItems = $user->carts;

            foreach ($cartItems as $item) {
                $subtotalCents += $item->product->price * 100;
            }

            $taxCents = 11 * $subtotalCents / 100;
            $insuranceCents = 23 * $subtotalCents / 100;
            $grandTotalCents = $subtotalCents + $taxCents + $insuranceCents + $deliveryFeeCents;

            $grandTotal = $grandTotalCents / 100;

            $validated['user_id'] = $user->id;
            $validated['total_amount'] = $grandTotal;
            $validated['is_paid'] = false;

            if($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('payment_proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $newtransaction = ProductTransaction::create($validated);

            foreach ($cartItems as $item) {
               TransactionDetail::create([
                    'product_transaction_id' => $newtransaction->id,
                    'product_id' => $item->product_id,
                    'price' => $item->product->price,
                ]);

                $item->delete();
            }

            DB::commit();
            return redirect()->route('product_transactions.index')->with('success', 'Transaction created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductTransaction $productTransaction)
    {
        //
        $productTransaction = ProductTransaction::with('transactionDetails.product')->find($productTransaction->id);
        // dd($productTransaction);
        return view('admin.product_transactions.details',
            [
                'productTransaction' => $productTransaction
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTransaction $productTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTransaction $productTransaction)
    {
        //
        // dd($productTransaction);

        $productTransaction->update([
            'is_paid' => true,
        ]);
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTransaction $productTransaction)
    {
        //
    }
}
