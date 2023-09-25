<?php

use App\Http\Controllers\PlantSpeciesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PlantsController;
use App\Http\Controllers\UsersController;
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

Route::post('login', [UsersController::class, 'login']);
Route::post('logout', [UsersController::class, 'logout']);
Route::post('refresh', [UsersController::class, 'refresh']);
Route::get('current-user', [UsersController::class, 'me']);

Route::resource('users', UsersController::class)->except('create', 'edit');
Route::resource('plants', PlantsController::class)->except('index', 'create', 'edit');
Route::resource('species', PlantSpeciesController::class)->except('create', 'edit', 'store');
Route::post('plants/search', [PlantsController::class, 'search']);
Route::resource('tips', TipsController::class)->only('store', 'update', 'destroy');
Route::get('roles', RolesController::class);
