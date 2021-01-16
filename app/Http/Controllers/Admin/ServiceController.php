<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
//        $services = Service::query()->where('user_id', '=', Auth::id())->get();
        $services = Service::query()
            ->with('types')
            ->get();
//        dd($services);
        return view('admin.services', ['services' => $services]);
    }

    public function create()
    {
        return view('admin.serviceCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'city' => 'required|string|min:3',
            'address' => 'required|string|min:3',
            'description' => 'required|string|min:3|max:100',
            'site' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'telegram' => 'required|string',
            'skype' => 'required|string'
        ]);
        $service = new Service;
        $result = $service->fill($request->all())->save();
        if ($result) {
            return redirect()->route('admin.services.index');
        }
        return back();
    }

    public function show($id)
    {
        //
    }


    public function edit(Service $service)
    {
        $types = $service->types()->select('name')->get()->toArray();
//        dd($types);
        $allTypes = Type::query()->select('name')->get()->toArray();
//        dd($allTypes);
        return view('admin.serviceEdit', [
            'service' => $service,
            'types' => $types,
            'allTypes' => $allTypes
        ]);
    }


    public function update(Request $request, Service $service)
    {
//        dd($request);
        $request->validate([
            'name' => 'required|string|min:3',
            'city' => 'required|string|min:3',
            'address' => 'required|string|min:3',
            'description' => 'required|string|min:3|max:100',
            'site' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'telegram' => 'required|string',
            'skype' => 'required|string'
        ]);
        $result = $service->fill($request->all())->save();
        if ($result) {
            return redirect()->route('admin.services.index');
        }
        return back();
    }

    public function destroy(Service $service)
    {
        $service->delete();
    }
}
