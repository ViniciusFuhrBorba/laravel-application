<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/teste', function (Request $request) {

    // dd($request->headers->all());
    // dd($request->headers->get('Application'));

    $response = new Response(json_encode(['msg' => "Minha primeira API"]));
    $response->header('Content-Type', 'application/json');
    return $response;

});


//Products route
Route::namespace('Api')->group(function () {

    Route::prefix('products')->group(function () {

        $controller = ProductController::class;

        Route::get('/', [$controller, 'index']);
        Route::post('/', [$controller, 'save'])->middleware('auth.basic');
        Route::get('/{id}', [$controller, 'show']);
        Route::put('/', [$controller, 'update']);
        Route::patch('/', [$controller, 'update']);
        Route::delete('/{id}', [$controller, 'delete']);

    });

});

Route::apiResource('users', UserController::class);
