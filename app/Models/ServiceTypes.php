<?php

namespace App;

use App\Models\CarServices;
use Illuminate\Database\Eloquent\Model;

class ServiceTypes extends Model
{
    public function carServices() {
        return $this->belongsToMany(CarServices::class);
    }
}
