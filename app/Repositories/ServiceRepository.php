<?php

namespace App\Repositories;

use App\Models\Service;
use App\Models\Type;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Request;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function getAll()
    {
        return Service::query()
            ->with('types')
            ->paginate(3);
    }

    public function search(Request $request)
    {
        return Service::query()
            ->with('types')
            ->where('name', 'like', "%$request->search%")
            ->orWhere('city', 'like', "%$request->search%")
//            ->orWhere('types.name', 'like', $request->search)
            ->paginate(3)
            ->withPath("?" . $request->getQueryString());
    }

    public function getTypesOfService(Service $service)
    {
        return $service->types()
            ->select('types.id', 'name')
            ->get()
            ->toArray();
    }

    public function getAllTypes(Service $service)
    {
        $types = $this->getTypesOfService($service);
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
        return $allTypes;
    }
}
