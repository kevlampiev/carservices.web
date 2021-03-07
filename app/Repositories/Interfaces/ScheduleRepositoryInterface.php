<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface ScheduleRepositoryInterface
{
    public function getAll();

    public function search(Request $request);
}
