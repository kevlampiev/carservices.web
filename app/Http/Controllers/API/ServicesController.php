<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index() {
//        $services = Services::query()
//            ->where('id', 1)
//            ->with('carServices')
//            ->get();
//        $type = $services->serviceTypes();
//        dd($type);
        return response()->json(Services::all(), 200);
    }

    public function show(Services $services) {
        return response()->json(Services::query()->where('slug', $services), 200);
    }
}
