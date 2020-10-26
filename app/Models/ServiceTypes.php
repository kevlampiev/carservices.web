<?php

namespace App\Models;

use App\Models\Services;
use Illuminate\Database\Eloquent\Model;

class ServiceTypes extends Model
{
    protected $table = 'servicetypes';

    protected $fillable = ['name', 'slug', 'description'];

    public function carServices() {
        return $this->belongsToMany(Services::class);
    }
}
