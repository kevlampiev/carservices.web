<?php

namespace App\Repositories\Interfaces;

use App\Models\Service;
use Illuminate\Http\Request;

interface ServiceRepositoryInterface
{
    public function getAll();

    public function search(Request $request);

    public function getAllTypes(Service $service);

    public function getTypesOfService(Service $service);
}
