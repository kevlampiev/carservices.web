<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Type;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    public $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }
    public function index(Request $request)
    {
        $services = $request->has('search') ?
            $this->serviceRepository->search($request) :
            $this->serviceRepository->getAll();
        return view('admin.services', ['services' => $services]);
    }

    public function create()
    {
        return view('admin.serviceCreate');
    }

    public function store(ServiceRequest $request)
    {
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
        $types = $this->serviceRepository->getTypesOfService($service);
        $allTypes = $this->serviceRepository->getAllTypes($service);
        return view('admin.serviceEdit', [
            'service' => $service,
            'types' => $types,
            'allTypes' => $allTypes
        ]);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        if ($request->file('image')) {
//            $strArray = explode('/', $service->img_link);
//            Storage::delete($strArray[3]);
            $path = $request->file('image')->store('public/images');
            $name = Storage::url($path);
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
