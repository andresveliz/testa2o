<?php

use Illuminate\Http\Request;

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

Route::post('padelLeague', function (App\Custom\Exercises $exercises, Request $request) {
    return $exercises->problem_one($request);
});

Route::post('queensAttack', function (App\Custom\Exercises $exercises, Request $request){
    return $exercises->queensAttack($request);
});

Route::post('stringValue', function (App\Custom\Exercises $exercises, Request $request){
    return $exercises->stringValue($request);
});