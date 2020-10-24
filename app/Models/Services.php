<?php

namespace App\Models;

use App\ServiceTypes;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    public function serviceTypes() {
        return $this->belongsToMany(ServiceTypes::class, 'services_servicetypes', 'service_id', 'service_type_id');
    }
}
