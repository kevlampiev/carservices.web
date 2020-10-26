<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = ['name', 'slug', 'city', 'address', 'coordinates', 'description', 'img_link', 'user_id'];

    public function types() {
//        return $this->belongsToMany(Type::class, 'services_servicetypes', 'service_id', 'service_type_id');
        return $this->belongsToMany(Type::class,'services_types','service_id','type_id');
    }
}
