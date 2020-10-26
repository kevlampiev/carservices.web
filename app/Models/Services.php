<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $fillable = ['name', 'slug', 'city', 'address', 'coordinates', 'description', 'img_link', 'user_id'];

    public function serviceTypes() {
        return $this->belongsToMany(ServiceTypes::class, 'services_servicetypes', 'service_id', 'service_type_id');
    }
}
