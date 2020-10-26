<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index() {
//        $services = Service::query()
//            ->where('id', 1)
//            ->with('carServices')
//            ->get();
//        $type = $services->serviceTypes();
//        dd($type);
        return response()->json(Service::query()->with('types')->get(), 200);
    }

    public function show(Service $services) {
        return response()->json(Service::query()->where('slug', $services), 200);
    }
}
