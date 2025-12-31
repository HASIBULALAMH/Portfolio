<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;


Route::prefix('projects')->group(function(){
    Route::get('/',[ProjectController::class,'index']);
    Route::get('/featured',[ProjectController::class,'featured']);
    Route::get('/{slug}',[ProjectController::class,'show']);
});
