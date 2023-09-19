<?php

use App\Http\Controllers\activityController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AsigController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('Log_in');
    })->name('Genesis');

    Route::post('logIn', [PersonController::class, 'checkUserExists'])->name('logIn');

    Route::post('register', [PersonController::class, 'RegisterNewUser'])->name('register');

    Route::get('/registro', function () {
        return view('Register');
    });


//Route::get('/', function () { return view('Log_in'); });


/*Avtividades */

Route::get('Home', [activityController::class, 'listActivityPending'])->name('Home');

//registrar actividad

Route::post('RegisterActivity', [activityController::class, 'RegisterActivity'])->name('RegistrarActividad');

//mostrar detalle de actividad

Route::get('/activity/{id}', [activityController::class, 'show'])->name('ActivityShow');

//actualizar actividad

Route::post('updateAct/{id}', [activityController::class, 'updateActivity'])->name('ActActividad');

//eliminar actividad

Route::get('deleteAct/{id}', [activityController::class, 'deleteActivity'])->name('delActividad');

//subir Actividad

Route::post('uploadfile/{id}', [activityController::class, 'uploadFile'])->name('uploadFile');

//calificar actividad

Route::get('calificar/{id}', [StudentController::class, 'tareaStudent'])->name('calificar');

//actualizar calificación
Route::put('actualizarcal/{id}', [StudentController::class, 'updateScore'])->name('actualizarcal');



/*Asignaturas */

Route::post('RegistrarAsig', [AsigController::class, 'RegisterAsig'])->name('RegistrarAsig');

Route::get('subject', [AsigController::class, 'listAsig'])->name('subject');

//Vizualizar clase

Route::get('estudiante/{id}', [StudentController::class, 'listStudent'])->name('estudiante');

//eliminar clase

Route::get('deleteAsig/{id}', [AsigController::class, 'deleteSubject'])->name('delAsignatura');



/*Clase Estudiante */

Route::post('IngresarClase', [AsigController::class, 'RegisterClass'])->name('IngresarClase');

Route::get('perfilUser', [PersonController::class,'perfilUser'])->name('perfilUser');

});

//URL::forceScheme('https');