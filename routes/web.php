<?php

use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
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

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegister']);
Route::post('/register', [LoginController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/', [HomeController::class, 'home'])->middleware(['auth']);

Route::group(['middleware' => ['role:coordinator']], function () {
    Route::get('/guest-section', [CoordinatorController::class, 'guestSection']);
    Route::get('/student-section', [CoordinatorController::class, 'studentSection']);
    Route::get('/teacher-section', [CoordinatorController::class, 'teacherSection']);
    Route::get('/class-section', [CoordinatorController::class, 'classSection']);
    Route::get('/class-section/{id}/class', [CoordinatorController::class, 'classDetail']);
    Route::post('/class-section/{id}/create-request', [CoordinatorController::class, 'requestCreate']);
    Route::post('/class-section/create', [CoordinatorController::class, 'classCreate']);
    Route::post('/student-section/create', [CoordinatorController::class, 'studentCreate']);
    Route::post('/teacher-section/create', [CoordinatorController::class, 'teacherCreate']);
    Route::post('/guest-section/updaterole/{id}', [CoordinatorController::class, 'updateGuest']);
    Route::post('/student-section/update/{id}', [CoordinatorController::class, 'updateStudent']);
    Route::post('/teacher-section/update/{id}', [CoordinatorController::class, 'updateTeacher']); 
    Route::get('/guest-section/delete/{id}', [CoordinatorController::class, 'deleteGuest']);
    Route::get('/student-section/delete/{id}', [CoordinatorController::class, 'deleteStudent']);
    Route::get('/teacher-section/delete/{id}', [CoordinatorController::class, 'deleteTeacher']);
    Route::get('/class-section/delete/{id}', [CoordinatorController::class, 'deleteClass']);
});

Route::group(['middleware' => ['role:student']], function () {
    Route::get('/valutazione/{id}', [StudentController::class, 'valutationDetail']);    
});
