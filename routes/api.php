<?php

use App\Http\Controllers\ConversationsController;
use App\Http\Controllers\MessagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('conversations', [ConversationsController::class, 'index']);
    Route::get('conversations/{conversation}', [ConversationsController::class, 'show']);
    Route::post('conversations/{conversation}/participants', [ConversationsController::class, 'addParicipant']);
    Route::delete('conversations/{conversation}/participants', [ConversationsController::class, 'removeParicipant']);

    Route::get('conversations/{id}/messages', [MessagesController::class, 'index']);
    Route::post('messages', [MessagesController::class, 'store']);
    Route::delete('messages/{id}', [MessagesController::class, 'destroy']);


//});
