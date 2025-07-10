<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\ZonaRiesgoController;
use App\Http\Controllers\ZonaSeguraController;
use App\Http\Controllers\PuntoEncuentroController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\Reporte2Controller;
use App\Http\Controllers\Reporte3Controller;

// Login
Route::get('/', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout']);

// Menu princopal
Route::get('/menu', [GestionController::class, 'index']);

// Ingreso a metodos de los controladores
Route::resource('login', LoginController::class);
Route::resource('registro', RegistroController::class);
Route::resource('gestion', GestionController::class);
Route::resource('riesgo', ZonaRiesgoController::class);
Route::resource('encuentro', PuntoEncuentroController::class);
Route::resource('seguro', ZonaSeguraController::class);

// Ingreso a metodos de los controladores reportes
Route::resource('rriesgo', ReporteController::class);
Route::resource('rseguro', Reporte2Controller::class);
Route::resource('rencuentro', Reporte3Controller::class);

// Rutas personalizadas
Route::get('/listado', [ZonaRiesgoController::class, 'listado']);
Route::get('/listado1', [PuntoEncuentroController::class, 'listado']);
Route::get('/listado2', [ZonaSeguraController::class, 'listado']);

// Mapas
Route::get('/mapariesgos', [ZonaRiesgoController::class, 'mapa']);
Route::get('/mapaencuentros', [PuntoEncuentroController::class, 'mapa']);
Route::get('/mapaseguro', [ZonaSeguraController::class, 'mapa']);