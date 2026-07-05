<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    protected $fillable = [
        'service_id',
        'sparepart_id',
        'quantity',
        'price',
        'subtotal'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class);
    }
}