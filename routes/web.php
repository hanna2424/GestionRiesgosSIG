<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\ZonaRiesgoController;

Route::get('/', [LoginController::class, 'index']);
Route::get('/menu', [GestionController::class, 'index']);

Route::get('/listado', [GestionController::class, 'listado']);

Route::get('/logout', [LoginController::class, 'logout']);


Route::resource('login', LoginController::class);
Route::resource('gestion', GestionController::class);
Route::resource('riesgos', ZonaRiesgoController::class);