<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/workers', [ApiController::class, 'getWorkers']);
Route::get('/machines', [ApiController::class, 'getMachines']);
Route::post('/assign-machine', [ApiController::class, 'assignMachine']);
Route::post('/unassign-machine', [ApiController::class, 'unassignMachine']);
Route::get('/worker/{id}', [ApiController::class, 'getWorkerInfo']);
Route::get('/machine/{id}', [ApiController::class, 'getMachineInfo']);
Route::get('/worker/{id}/history', [ApiController::class, 'getWorkerHistory']);
Route::get('/machine/{id}/history', [ApiController::class, 'getMachineHistory']);
