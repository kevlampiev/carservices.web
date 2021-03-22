<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OwnerServiceRequest;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OwnerServicesService;
use Illuminate\Support\Facades\DB;

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
        $service->fill([
            $service->name = $request->commonInfo['name'],
            $service->city = $request->commonInfo['city'],
            $service->address = $request->commonInfo['address'],
            $service->description = $request->commonInfo['description'],
            $service->user_id = Auth::id(),
            $service->phone = $request->commonInfo['phone'],
            $service->email = $request->commonInfo['email'],
            $service->site = $request->commonInfo['site'],
            $service->telegram = $request->commonInfo['telegram'],
            $service->skype = $request->commonInfo['skype'],
        ]);
        dd($service);
        if ($service->save()) {
            return response()->json(['message' => 'New service has been added'], 200);
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
        $service = Service::query()->find($request->commonInfo['id']);
        $types = $service
            ->find($request->commonInfo['id'])
            ->types()
            ->get()
            ->toArray();
        $typeNames = array_column($types, 'name');
        $requestTypeName = array_column($request->types, 'name');
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
        $newTypeNames = array_diff($requestTypeName, $typeNames);
        if (!empty($newTypeNames)) {
            foreach ($newTypeNames as $name) {
                $newType = Type::query()->where('name', $name)->first();
                DB::table('services_types')->insert([
                    'service_id' => $request->commonInfo['id'],
                    'type_id' => $newType->id
                ]);
            }
        }
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
