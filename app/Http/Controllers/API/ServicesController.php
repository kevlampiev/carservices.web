<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index() {
        return response()->json(Service::query()->with('types')->get(), 200);
    }

    public function show(Service $services) {
        return response()->json(Service::query()->where('slug', $services), 200);
    }

}
