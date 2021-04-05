<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ユーザー一覧
Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');
// 新規登録：申込
Route::get('/users/create', [UserController::class, 'create'])
    ->name('users.create');
// 新規登録：保存
Route::post('/users', [UserController::class, 'save'])
    ->name('users.save');
// アカウント情報変更：申込
Route::get('/users/edit/{id}', [UserController::class, 'edit'])
    ->name('users.edit');
// アカウント情報変更：保存
Route::patch('/users/{id}', [UserController::class, 'update'])
    ->name('users.update');
// ユーザー解約
Route::patch('/users/{id}', [UserController::class, 'delete'])
    ->name('users.delete');
