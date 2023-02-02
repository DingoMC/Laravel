<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserCoursesController;
use App\Http\Controllers\UserSettingsController;

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
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/myprofile', [UserSettingsController::class, 'index'])->name('myprofile');
Route::get('/mycourses', [UserCoursesController::class, 'index'])->name('mycourses');
Route::get('/enroll/{id}', [UserCoursesController::class, 'store'])->name('enroll');
Route::get('/leave/{id}', [UserCoursesController::class, 'destroy'])->name('leave');

Route::put('/updateuser/{id}', [UserSettingsController::class, 'update'])->name('updateuser');
Route::get('/deleteuser/{id}', [UserSettingsController::class, 'destroy'])->name('deleteuser');
Route::get('/clearAllComments/{id}', [UserSettingsController::class, 'deleteAllComments'])->name('clearAllComments');
Route::get('/leaveAllCourses/{id}', [UserSettingsController::class, 'leaveAllCourses'])->name('leaveAllCourses');

Route::get('/comments', [CommentsController::class, 'index'])->name('comments');
Route::get('/create', [CommentsController::class, 'create'])->name('create');
Route::post('/create', [CommentsController::class, 'store'])->name('store');
Route::get('/delete/{id}', [CommentsController::class, 'destroy'])->name('delete');
Route::get('/edit/{id}', [CommentsController::class,'edit'])->name('edit');
Route::put('/update/{id}', [CommentsController::class,'update'])->name('update');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/edituser/{id}', [AdminController::class, 'edituser'])->name('admin/edituser');
Route::put('/admin/updateuser/{id}', [AdminController::class, 'updateuser'])->name('admin/updateuser');
Route::get('/admin/deleteuser/{id}', [AdminController::class, 'deleteuser'])->name('admin/deleteuser');
Route::get('/admin/deleteenroll/{id}', [UserCoursesController::class, 'destroy'])->name('admin/deleteenroll');