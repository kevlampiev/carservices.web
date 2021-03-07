<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OwnerServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OwnerServicesService;

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
        return response()->json(OwnerServicesService::getOwnerServices($user));
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
    public function update(Request $request)
    {
//        dd($request->types);
        $service = Service::query()->find($request->commonInfo['id']);
        $types = $service
            ->find($request->commonInfo['id'])
            ->types()
            ->get()
            ->toArray();
//        dd($types);
//        foreach ($request->types as $item) {
//            $list = [];
//            $id = array_search($item['name'], $types);
//            $list[] = $id;
//        }
//        dd($list);
        $service->fill([
            $service->name = $request->commonInfo['name'],
            $service->city = $request->commonInfo['city'],
            $service->address = $request->commonInfo['address'],
            $service->description = $request->commonInfo['description'],
            $service->phone = $request->commonInfo['phone'],
            $service->email = $request->commonInfo['email'],
            $service->site = $request->commonInfo['site'],
            $service->telegram = $request->commonInfo['telegram'],
            $service->site = $request->commonInfo['site'],
        ]);
        if ($service->save()) {
            return response()->json(['message' => 'Service info has been updated'],200);
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
