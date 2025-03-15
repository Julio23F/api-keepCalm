<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\ProjectController;
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

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Routes pour la gestion des entreprises
    // Route::post('/entreprises', [EntrepriseController::class, 'store']); // Création
    // Route::put('/entreprises/{id}', [EntrepriseController::class, 'update']); // Mise à jour
    // Route::delete('/entreprises/{id}', [EntrepriseController::class, 'destroy']); // Suppression
    
    Route::post('/entreprises', [EntrepriseController::class, 'store']); 
    Route::get('/entreprises', [EntrepriseController::class, 'index']); 
    Route::get('/entreprises/{id}', [EntrepriseController::class, 'show']);
    Route::put('/entreprises/{entreprise}', [EntrepriseController::class, 'update']);
    Route::delete('/entreprises/{entreprise}', [EntrepriseController::class, 'destroy']);


    Route::post('/plats', [PlatController::class, 'store']);
    Route::get('/plats', [PlatController::class, 'index']); 
    Route::get('/plats/{id}', [PlatController::class, 'show']);
    Route::put('/plats/{plat}', [PlatController::class, 'update']);
    Route::delete('/plats/{plat}', [PlatController::class, 'destroy']); 

    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
});
