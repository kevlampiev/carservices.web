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

//    public function getByCity(Request $request) {
//        $city = $request->city;
//        $services = Service::query()
//            ->where('city', $city)
//            ->get();
//        return response()->json($services);
//    }

    public function cityList() {
        return response()->json(Service::query()->select('city')->get());
    }

    public function typeList() {
        return response()->json(Type::query()->select('name')->get());
    }
}
