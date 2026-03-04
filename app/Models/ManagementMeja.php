<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagementMeja extends Model
{
    protected $guarded = ['id'];
    //relasi
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
