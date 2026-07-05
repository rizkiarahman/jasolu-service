<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'customer_id',
        'plate_number',
        'brand',
        'model',
        'year',
        'engine_number',
        'frame_number',
        'mileage'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
