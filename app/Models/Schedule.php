<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['work_day', 'work_time', 'service_id', 'service_type_id', 'order_id'];
    protected $hidden = ['created_at','updated_at'];

    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id')->first();
    }
}
