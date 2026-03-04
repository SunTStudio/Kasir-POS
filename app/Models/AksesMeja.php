<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AksesMeja extends Model
{
    protected $guarded = ['id'];
    //relasi
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }
    public function meja()
    {
        return $this->belongsTo(ManagementMeja::class, 'meja_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
