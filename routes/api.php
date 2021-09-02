<?php

use App\Http\Controllers\Api\V1\ProductsController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return response([
        'message' => 'Bienvenidos a la Api de la Práctica N°2',
        'code' => 200,
        'status' => 'success',
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('v1/users',UserController::class);

Route::apiResource('v1/products',ProductsController::class);


Route::post('v1/upload64', function (Request $request) {
    $image = $request->imagen; // your base64 encoded
    $image = str_replace('data:image/jpeg;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageName = time() . '.' . 'png';
    File::put(public_path() . "//imgProducts//" . $imageName, base64_decode($image));
    $dir = asset("imgProducts/". $imageName);
    return response([
        'status' => 'success',
        'code' => 200,
        'data' => $dir
    ]);
});

