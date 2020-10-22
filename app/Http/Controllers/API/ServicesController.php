<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CarServices;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index() {

        return response()->json(CarServices::all(), 200);
    }

    public function show(CarServices $carServices) {
        return response()->json(CarServices::query()->where('slug', $carServices), 200);
    }
}
