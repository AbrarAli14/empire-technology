<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Resources\TeacherResource\Pages\TeacherDashboard;
use Filament\Shield\Middleware\RoleMiddleware;
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
Route::middleware(['auth', 'role:teacher'])->get('/teacher/dashboard', \App\Filament\Resources\TeacherResource\Pages\TeacherDashboard::class)
     ->name('filament.resources.teacher-resource.pages.teacher-dashboard');

Route::get('/', function () {
    return view('welcome');
});
