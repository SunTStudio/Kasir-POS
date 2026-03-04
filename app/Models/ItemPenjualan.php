<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPenjualan extends Model
{
    protected $guarded = ['id'];
    //relasi
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}
