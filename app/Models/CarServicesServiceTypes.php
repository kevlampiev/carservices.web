<?php

namespace App\Models;

use App\ServiceTypes;
use Illuminate\Database\Eloquent\Model;

class CarServicesServiceTypes extends Model
{
//    protected $table = 'car_services';

    public function serviceType() {
        return $this->belongsToMany(ServiceTypes::class, 'services_lists', 'car_services_id', 'service_type_id');
    }
}
