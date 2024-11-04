<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;


Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/mainform', [UserController::class, 'showMainForm'])->name('mainform')->middleware('auth');


Route::post('/chat', [ChatController::class, 'generateResponse'])->name('chat');
Route::patch('/chat/edit/{id}', [ChatController::class, 'editConversation'])->name('chat.edit')->middleware('auth');
Route::delete('/chat/delete/{id}', [ChatController::class, 'deleteConversation'])->name('chat.delete')->middleware('auth');
Route::get('/mainform', [ChatController::class, 'showPreviousConversations'])->name('previous.conversations')->middleware('auth');



Route::get('/', function () {
    return view('home');
});
