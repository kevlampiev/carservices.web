<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface TimeSlotRepositoryInterface
{
    public function checkService(Request $request);

    public function checkSchedule(Request $request);
}
