<?php

namespace App;

use App\Models\Services;
use Illuminate\Database\Eloquent\Model;

class ServiceTypes extends Model
{
    protected $table = 'servicetypes';

    public function carServices() {
        return $this->belongsToMany(Services::class);
    }
}
