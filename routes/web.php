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

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegister']);
Route::post('/register', [LoginController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/', function () {
    return view('home');
})->middleware(['auth']);

Route::group(['middleware' => ['role:coordinator']], function () {
    Route::get('/guest-section', [CoordinatorController::class, 'guestSection']);
    Route::post('/guest-section/updaterole/{id}', [CoordinatorController::class, 'update']);
});
