<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    ProfileController,
    MailSettingController,
};
use App\Http\Controllers\SendMailController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AboutUsController;


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

// Route to the login view
Route::get('/', function () {
    return view('auth.login');
});


Route::get('/test-mail',function(){

    $message = "Testing mail";

    Mail::raw('Hi, welcome!', function ($message) {
      $message->to('ajayydavex@gmail.com')
        ->subject('Testing mail');
    });
    dd('Email sent');
});

// Route to the dashboard view, only accessible to authenticated users with 'front' middleware
Route::get('/dashboard', function () {
    return view('front.dashboard');
})->middleware(['front'])->name('dashboard');

// Including front_auth routes
require __DIR__.'/front_auth.php';

// Admin dashboard route, only accessible to authenticated users
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('admin.dashboard');

// Including auth routes
require __DIR__.'/auth.php';

// Admin routes namespace and prefix
Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')->group(function(){
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('users', 'UserController');
    Route::resource('posts', 'PostController');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/mail', [MailSettingController::class, 'index'])->name('mail.index');
    Route::put('/mail-update/{mailsetting}', [MailSettingController::class, 'update'])->name('mail.update');
});

// Routes for SendMailController
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/form', [SendMailController::class, 'loadForm']);
Route::post('/send/email', [SendMailController::class, 'send'])->name('send');


