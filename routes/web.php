<?php

use App\Http\Controllers\activityController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AsigController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { return view('Log_in'); });

Route::get('/', function(){return view('Log_in');})->name('Genesis');

Route::post('logIn', [PersonController::class, 'checkUserExists'])->name('logIn');

Route::post('register', [PersonController::class, 'RegisterNewUser'])->name('register');

Route::get('/registro', function () { return view('Register'); });

Route::get('Home', [activityController::class,'listActivityPending'])->name('Home');

Route::post('RegisterActivity', [activityController::class, 'RegisterActivity'])->name('RegistrarActividad');

Route::get('/activity/{id}', [activityController::class, 'show'])->name('ActivityShow');

//Route::get('subject', [AsigController::class,'listActivityPending'])->name('Home');

Route::post('RegistrarAsig', [AsigController::class, 'RegisterAsig'])->name('RegistrarAsig');

Route::get('subject', [AsigController::class,'listAsig'])->name('subject');