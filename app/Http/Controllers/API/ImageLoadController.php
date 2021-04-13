<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageLoadController extends Controller
{
    public function storeFile(Request $request):JsonResponse
    {
        $path = Storage::putFile('public/img/photos', $request->file('file'));
        return response()->json(['filename'=>basename($path)], 200);
    }
}
