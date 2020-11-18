<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
//    protected $table = 'services';

    protected $fillable = ['name', 'slug', 'city', 'address', 'coordinates', 'description', 'img_link', 'user_id'];

    protected $hidden = ['coordinates', 'user_id', 'created_at', 'updated_at', 'pivot'];


    public function types() {
        return $this->belongsToMany(Type::class,'services_types','service_id','type_id');
    }

    public function schedules() {
        return $this->hasMany(Schedule::class, 'service_id');
    }
}
