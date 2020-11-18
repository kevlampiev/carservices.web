<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role = 'owner') {
            $services = Service::query()->where('user_id', Auth::id())->get();
            return response()->json($services);
        }
        return response()->json('Empty');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = new Service();
        $service->user_id = Auth::id();
        $service = $service->fill($request->all());
        $result = $service->save();
        if ($result) {
            return response()->json(200);
        }
        return response()->json(400);
    }

    /**
     * Display the specified resource.
     *
     * @param Service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $service = $service->fill($request->all());
        if ($service->save()) {
            return response()->json(200);
        }
        return response()->json(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $result = $service->delete();
        if ($result) {
            return response()->json(200);
        }
        return response()->json(400);
    }
}
