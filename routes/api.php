
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;



Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/chat', [ChatController::class, 'generateResponse'])->middleware('auth:sanctum');
Route::put('/chat/edit/{id}', [ChatController::class, 'editConversation'])->middleware('auth:sanctum');
Route::delete('/chat/delete/{id}', [ChatController::class, 'deleteConversation'])->middleware('auth:sanctum');
Route::get('/chat/previous', [ChatController::class, 'showPreviousConversations'])->middleware('auth:sanctum');