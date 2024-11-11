<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ContactsController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::controller(ContactsController::class)->group(function () {
    Route::get('/contacts', 'index');
    Route::post('/contacts', 'create');
    Route::put('/contacts/{id}', 'edit');
    Route::get('/contacts/{id}', 'show');
    Route::delete('/contacts/{contact}', 'delete');
    Route::post('/contacts/filter', 'filterData');
});
