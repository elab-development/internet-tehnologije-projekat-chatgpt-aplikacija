<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the API'
    ]);
});


//Route::prefix('api')->group(base_path('routes/api.php'));
