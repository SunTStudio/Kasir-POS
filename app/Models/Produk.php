<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $guarded = ['id'];
    //relasi
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'produk_id');
    }
    
}
