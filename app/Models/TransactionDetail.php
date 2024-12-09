<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    //
    protected $guarded = [
        'id',
    ]; // Menggunakan guarded untuk proteksi id saja

    public function productTransaction(){
        return $this->belongsTo(ProductTransaction::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
