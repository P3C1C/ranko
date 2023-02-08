<?php

use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\LoginController;
use App\Models\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

Route::get('/', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [LoginController::class, 'showRegister']);
Route::post('/register', [LoginController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/guest', function () {
    return view('guestPage');
})->middleware(['role:guest']);

Route::group(['middleware' => ['role:coordinator']], function () {
    Route::get('/coordinator', [CoordinatorController::class, 'show']);
    Route::get('/coordinator/guest-section', [CoordinatorController::class, 'guestSection']);
    Route::post('/coordinator/updaterole/{id}', [CoordinatorController::class, 'ajaxResponse']);
});
