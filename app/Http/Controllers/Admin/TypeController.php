<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function index()
    {
        $types = Type::all();
        return response()->json($types);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $type = new Type();
        $request->validate([
            'name' => 'required|string|min:3',
            'slug' => 'required|string|min:3',
            'description' => 'required|string|min:10'
        ]);
        $type = $type->fill($request->all());
        if ($type->save()) {
            return response()->json(200);
        }
        return response()->json(400);
    }

    public function show(Type $type)
    {
        return response()->json($type);
    }

    public function edit(Type $type)
    {
        return response()->json($type);
    }


    public function update(Request $request, Type $type)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'slug' => 'required|string|min:3',
            'description' => 'required|string|min:10'
        ]);
        $type = $type->fill($request->all());
        if ($type->save()) {
            return response()->json(200);
        }
        return response()->json(400);
    }

    public function destroy(Type $type)
    {
        $result = $type->delete();
        if ($result) {
            return response()->json(200);
        }
        return response()->json(400);
    }
}
