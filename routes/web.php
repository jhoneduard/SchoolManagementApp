<?php

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\RegistrationCourseController;
use App\Http\Controllers\UsuarioController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// APIS de usuarios
Route::get('/users', [UsuarioController::class, 'getUsers']);
Route::post('/registerUser', [UsuarioController::class, 'registerUser']);
Route::delete('user/{id}', [UsuarioController::class, 'destroy']);
Route::put('/user/chanceState/{id}', [UsuarioController::class, 'chanceState']);
Route::put('/user/update', [UsuarioController::class, 'updateUser']);

// API de categoria de usuarios
Route::get('/selectCategoryUser', [UsuarioController::class, 'getCategory']);


// API de asignaturas
Route::get('/subjects', [AsignaturaController::class, 'geSubjects']);
Route::post('/registerSubject', [AsignaturaController::class, 'registerSubject']);
Route::delete('subject/{id}', [AsignaturaController::class, 'destroy']);
Route::put('/subject/update', [AsignaturaController::class, 'updateSubject']);

// API de categoria de listar Docentes
Route::get('/select-teachers', [AsignaturaController::class, 'getTeachers']);

// API de categoria de Categorias de Cursos
Route::get('/select-category-subjects', [AsignaturaController::class, 'getCategory']);

// API de listar cursos disponibles
Route::get('/course-available', [RegistrationCourseController::class, 'getCourses']);
Route::get('/course-recommendations', [RegistrationCourseController::class, 'courseRecommendations']);
Route::post('/registration-course', [RegistrationCourseController::class, 'registrationCourse']);
