<?php

use App\Http\Controllers\auth\authController;
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

Route::get("/user/getAllUser",[authController::class, "returnAllUser"]);
