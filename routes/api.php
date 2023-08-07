<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::get('games', [ApiController::class, 'api_games']);
Route::post('create', [ApiController::class, 'api_create']);
Route::post('update', [ApiController::class, 'api_update']);
Route::post('delete', [ApiController::class, 'api_delete']);
Route::get('search', [ApiController::class, 'api_search']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
