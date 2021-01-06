<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'car_model', 'license_plate_number', 'description', 'order_status'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
