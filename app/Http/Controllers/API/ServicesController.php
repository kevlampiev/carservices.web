<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index() {
        return response()->json(Service::all(), 200);
    }

    public function show(Service $services) {
        return response()->json(Service::query()->where('slug', $services), 200);
    }

}
