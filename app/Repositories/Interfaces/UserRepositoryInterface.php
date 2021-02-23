<?php
namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getAll();
    public function search(Request $request);
}
