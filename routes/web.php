<?php

use App\Http\Controllers\Admin\HomeController as AdminController;
use App\Http\Controllers\Admin\MailBoxController;
use App\Http\Controllers\Admin\ProductsContoller;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('admin-components.index');
// });


Route::prefix('/admin')->middleware(["auth", "roles:admin"])->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('/', "index")->name("index");
    Route::prefix('/mailbox')->name('mailbox.')->controller(MailBoxController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/send-mail', 'create')->name('sendMail');
        Route::post('/send-mail', 'sendMail');
    });
    Route::prefix("/product")->name("product.")->controller(ProductsContoller::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create-product', 'create')->name('create');
        Route::post('/create-product', 'store')->name('store');
        Route::get('/edit-product/{id}', 'edit')->name('edit');
        Route::post('/edit-product', 'update')->name('update');
        Route::get('/destroy-product/{id}', 'destroy')->name('destroy');
    });
    Route::prefix("/category")->name("category.")->controller(\App\Http\Controllers\Admin\CategoriesController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create-category', 'create')->name('create');
        Route::post('/create-category', 'store')->name('store');
        Route::post('/edit-category', 'update')->name('update');
        Route::get('/edit-category/{id}', 'edit')->name('edit');
        Route::get('/destroy-category/{id}', 'destroy')->name('destroy');
    });

    Route::prefix("/announcement")->name("announcement.")->controller(\App\Http\Controllers\Admin\AnnouncementsController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create-announcement', 'create')->name('create');
        Route::post('/create-announcement', 'store')->name('store');
        Route::post('/edit-announcement', 'update')->name('update');
        Route::get('/edit-announcement/{id}', 'edit')->name('edit');
        Route::get('/destroy-announcement/{id}', 'destroy')->name('destroy');
    });
    Route::prefix("/user")->name("user.")->controller(\App\Http\Controllers\Admin\UsersController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create-user', 'create')->name('create');
        Route::post('/create-user', 'store')->name('store');
        Route::post('/edit-user', 'update')->name('update');
        Route::get('/edit-user/{id}', 'edit')->name('edit');
        Route::get('/destroy-user/{id}', 'destroy')->name('destroy');
    });
    Route::prefix("/role")->name("role.")->controller(\App\Http\Controllers\Admin\AnnouncementsController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create-role', 'create')->name('create');
        Route::post('/create-role', 'store')->name('store');
        Route::post('/edit-role', 'update')->name('update');
        Route::get('/edit-role/{id}', 'edit')->name('edit');
        Route::get('/destroy-role/{id}', 'destroy')->name('destroy');
    });
});
Route::prefix("/")->name("home.")->controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('authhome');
