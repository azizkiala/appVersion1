<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\QuestionController;
use App\Http\Controllers\API\RegisterUtilisateurs;
use App\Http\Controllers\Auth\LoginController;


Route::post('register_utilisateur', [RegisterUtilisateurs::class, 'enregistrer']);
Route::post('login', [LoginController::class, 'login']);
Route::get('questions', [QuestionController::class, 'get_questions']);

//--------------------------------------------private--------------------------------------------
Route::middleware('auth:sanctum')->group( function () {
    Route::post('store_questions', [QuestionController::class, 'store_questions']);
});
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
