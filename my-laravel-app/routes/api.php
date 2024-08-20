<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;

use App\Http\Controllers\RoleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/register',[AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'issueToken']);

// Routes protected by Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});


Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::post('/', [RoleController::class, 'store']);
    Route::get('{role}', [RoleController::class, 'show']);
    Route::put('{role}', [RoleController::class, 'update']);
    Route::delete('{role}', [RoleController::class, 'destroy']);
});


// Route to assign a role to a user
// Route::middleware('auth:sanctum')->post('/users/{user}/roles', [UserController::class, 'assignRole']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
});


Route::middleware('auth:sanctum')->post('/user/assign-role', [UserRoleController::class, 'assignRole']);
