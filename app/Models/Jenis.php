<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $guarded = ['id'];
    

    // relasi
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'jenis_id');
    }

}
