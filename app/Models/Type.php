<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name', 'slug', 'description'];
    protected $hidden = ['pivot'];

    public function services() {
        return $this->belongsToMany(Service::class, 'services_types', 'type_id', 'service_id');
    }
}
