<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CarServices;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index() {
        $services = CarServices::query()->get();
        foreach ($services as $service) {
            return response()->json([
                'name' => $service->name,
                'slug' => $service->slug,
                'address' =>  $service->address,
                'description' => $service->description,
                'image' => $service->img_link
            ]);
        }

    }

    public function show(CarServices $carServices) {
        return response()->json([
            'name' => $carServices->name,
            'slug' => $carServices->slug,
            'address' =>  $carServices->address,
            'description' => $carServices->description,
            'image' => $carServices->img_link
        ]);
    }
}
