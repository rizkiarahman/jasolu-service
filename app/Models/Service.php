<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'vehicle_id',
        'service_date',
        'complaint',
        'diagnosis',
        'service_cost',
        'sparepart_cost',
        'total_cost',
        'status'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function serviceDetails()
    {
        return $this->hasMany(ServiceDetail::class);
    }
}