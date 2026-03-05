<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $guarded = ['id'];
    //relasi
    public function penjualans()
    {
        return $this->hasMany(ItemPenjualan::class, 'penjualan_id');
    }
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function meja()
    {
        return $this->belongsTo(ManagementMeja::class, 'meja_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'penjualan_id');
    }
    public function akses_meja()
    {
        return $this->belongsTo(AksesMeja::class, 'akses_meja_id');
    }
}
