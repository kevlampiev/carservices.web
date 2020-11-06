<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
//    protected $table = 'types';

    protected $fillable = ['name', 'slug', 'description'];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'services_types', 'type_id', 'service_id');
    }
}
