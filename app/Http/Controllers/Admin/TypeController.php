<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return response()->json($types);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = new Type();
        $request->validate(
            [
            'name' => 'required|string|min:3',
            'slug' => 'required|string|min:3',
            'description' => 'required|string|min:10'
            ]
        );
        $type = $type->fill($request->all());
        if ($type->save()) {
            return response()->json(200);
        }
        return response()->json(400);
    }

    /**
     * Display the specified resource.
     *
     * @param  Type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return response()->json($type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return response()->json($type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $request->validate(
            [
            'name' => 'required|string|min:3',
            'slug' => 'required|string|min:3',
            'description' => 'required|string|min:10'
            ]
        );
        $type = $type->fill($request->all());
        if ($type->save()) {
            return response()->json(200);
        }
        return response()->json(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $result = $type->delete();
        if ($result) {
            return response()->json(200);
        }
        return response()->json(400);
    }
}
