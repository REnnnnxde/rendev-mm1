<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTransaction extends Model
{
    //
    protected $guarded = [
        'id',
    ]; // Menggunakan guarded untuk proteksi id saja

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactionDetails(){
        return $this->hasMany(TransactionDetail::class);
    }
}
