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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas de la API para OpenRouter
Route::prefix('openrouter')->group(function () {
    Route::post('/chat', [ApiController::class, 'chat'])->name('api.openrouter.chat');
    Route::post('/completion', [ApiController::class, 'completion'])->name('api.openrouter.completion');
    Route::post('/stream', [ApiController::class, 'streamChat'])->name('api.openrouter.stream');
});

// Rutas para el chat del aula virtual
Route::prefix('chat')->group(function () {
    Route::post('/send', [ApiController::class, 'sendMessage'])->name('api.chat.send');
    Route::get('/history/{user_id}', [ApiController::class, 'getChatHistory'])->name('api.chat.history');
    Route::delete('/clear/{user_id}', [ApiController::class, 'clearChatHistory'])->name('api.chat.clear');
});
