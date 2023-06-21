<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\projectController;
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

Route::get('/', function () {
    return view('Pages.auth.login');
});
Route::view('/dashboard', 'Pages.general.dashboard');
Route::view('/auth/register', 'Pages.auth.register');

Route::get("/user/getAll",[authController::class, "returnAllUser"]);
Route::get("/project/getAll",[projectController::class,"getAllProject"]);
