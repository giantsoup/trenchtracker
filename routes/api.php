<?php

use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\KeywordController;
use App\Http\Controllers\Api\RuleController;
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

// Rules API endpoints
Route::prefix('rules')->group(function () {
    Route::get('/', [RuleController::class, 'index'])->name('api.rules.index');
    Route::get('/search', [RuleController::class, 'search'])->name('api.rules.search');
    Route::get('/{slug}', [RuleController::class, 'show'])->name('api.rules.show');
});

// Keywords API endpoints
Route::prefix('keywords')->group(function () {
    Route::get('/', [KeywordController::class, 'index'])->name('api.keywords.index');
    Route::get('/{name}', [KeywordController::class, 'show'])->name('api.keywords.show');
});

// Equipment API endpoints
Route::prefix('equipment')->group(function () {
    Route::get('/', [EquipmentController::class, 'index'])->name('api.equipment.index');
    Route::get('/{id}', [EquipmentController::class, 'show'])->name('api.equipment.show')->where('id', '[0-9]+');
});
