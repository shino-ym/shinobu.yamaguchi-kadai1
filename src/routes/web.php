<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;



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


Route::get('/', [ContactController::class, 'index'])->name('index');            // 入力画面
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm'); // 確認画面
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');             // 送信処理

// 新規登録フォーム表示
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
// 新規登録処理（POST）
Route::post('/register', [RegisterController::class, 'store']);

// ログインフォーム表示
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// ログイン処理（POST）
Route::post('/login', [LoginController::class, 'login'])->name('login');

// 管理画面
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

// 一覧＋検索
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// モーダルからのデータ削除
Route::delete('/admin/contact/{id}', [AdminController::class, 'destroy'])->name('admin.delete');

// エクスポート
Route::get('/export', [ExportController::class, 'export'])->name('admin.export');


