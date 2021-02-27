<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface OrderRepositoryInterface
{
    public function getAll();
    public function search(Request $request);
}
