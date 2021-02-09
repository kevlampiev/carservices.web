<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
//        $services = Service::query()->where('user_id', '=', Auth::id())->get();
        $services = Service::query()
            ->with('types')
            ->paginate(3);
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
        $name = null;
        $service = new Service;
        if ($request->file('image')) {
            $path = \Storage::putFile('public/images', $request->file('image'));
            $name = \Storage::url($path);

        }
        $service->img_link = $name;
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
        $types = $service->types()
            ->select('types.id', 'name')
            ->get()
            ->toArray();
        $allTypes = Type::query()
            ->select('id', 'name')
            ->get()
            ->toArray();
        $length = count($allTypes);
        for ($i = 0; $i < $length; $i++) {
            $item = $allTypes[$i];
            foreach ($types as $type) {
                if ($type['name'] == $item['name']) {
                    unset($allTypes[$i]);
                    break;
                }
            }
        }
        return view('admin.serviceEdit', [
            'service' => $service,
            'types' => $types,
            'allTypes' => $allTypes

        ]);
    }

    public function update(Request $request, Service $service)
    {
//        dd($request->file('image'));
//        dd($service);
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
        if ($request->file('image')) {
//            $strArray = explode('/', $service->img_link);
//            Storage::delete($strArray[3]);
            $path = $request->file('image')->store('public/images');
//            dd($path);
//            $path = Storage::putFile('public/images', $request->file('image'));
            $name = Storage::url($path);
            dd($name);
            $service->img_link = $name;
        }

        $result = $service->fill($request->all())->update();

        if ($result) {
            return redirect()->route('admin.services.index');
        }
        return back();
    }

    public function destroy(Service $service)
    {
        try {
            $service->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Удаление сервиса невозможно, он связан с записями в других таблицах');
        }
        return back();
    }

    public function addType(Request $request, Service $service)
    {
        DB::table('services_types')->insert(
            [
                'service_id' => $service->id,
                'type_id' => $request->role
            ]
        );
        return back();
    }

    public function deleteType(Request $request, Service $service)
    {
        DB::table('services_types')->where(
            [
                ['service_id', $service->id],
                ['type_id', $request->type]
            ]
        )->delete();
        return back();
    }
}
