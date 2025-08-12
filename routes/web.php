<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

//


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/',['App\Http\Controllers\site\HomeController','index']);
Route::get('/single',['App\Http\Controllers\site\HomeController','single']);
Route::get('/about',['App\Http\Controllers\site\HomeController','about']);
Route::get('/contact',['App\Http\Controllers\site\HomeController','contact']);
Route::get('/category',['App\Http\Controllers\site\HomeController','category']);


Route::get('/dashboard',['App\Http\Controllers\admin\DaschbordController','index'])->middleware(['auth', 'verified', 'role:admin|author'])->name('dashboard');

Route::get('/user/profile',['App\Http\Controllers\site\UserController','profile'])->middleware(['auth', 'verified', 'role:user'])->name('user.profile');

Route::controller('App\Http\Controllers\admin\UserController')->middleware(['auth', 'verified', 'role:admin|author'])->group(function () {
    Route::get('/user','index')->name('user');
    Route::get('/user/creat','create')->name('user-creat');
    Route::post('/user/store','store')->name('user.store');
    Route::delete('/user/destroy/{id}','destroy')->name('user-destroy');
    Route::get('/user/edit/{id}','edit')->name('user-edit');
    Route::put('/user/update/{id}','update')->name('user.update');
});
Route::controller('App\Http\Controllers\admin\CategoryController')->middleware(['auth', 'verified', 'role:admin|author'])->group(function () {
    Route::get('/category/','index')->name('category');
    Route::get('/category/create','create')->name('category.create');
    Route::post('/category/store','store')->name('category.store');
    Route::delete('/category/destroy/{id}','destroy')->name('category.destroy');
    Route::get('/category/edit/{id}','edit')->name('category.edit');
    Route::put('/category/update/{id}','update')->name('category.update');
});
Route::controller('App\Http\Controllers\admin\PostController')->middleware(['auth', 'verified', 'role:admin|author'])->group(function () {
    Route::get('/post/','index')->name('post');
    Route::get('/post/create','create')->name('post.create');
    Route::get('/post/show/{id}','show')->name('post.show');
    Route::post('/post/store','store')->name('post.store');
    Route::delete('/post/destroy/{id}','destroy')->name('post.destroy');
    Route::get('/post/edit/{id}','edit')->name('post.edit');
    Route::put('/post/update/{id}','update')->name('post.update');
});
Route::controller('App\Http\Controllers\admin\SiteController')->middleware(['auth', 'verified', 'role:admin|author'])->group(function () {
    Route::get('/setting/about/', 'about')->name('setting.about');
    Route::put('/setting/about/update/{id}', 'updateAbout')->name('setting.about.update');
    Route::get('/setting/contact/', 'contact')->name('setting.contact');
    Route::put('/setting/contact/update/{id}', 'updateContact')->name('setting.contact.update');
    Route::get('/setting/rules/', 'rules')->name('setting.rules');
    Route::put('/setting/rules/update/{id}', 'updateRules')->name('setting.rules.update');
});
Route::controller('App\Http\Controllers\admin\RolleController')->middleware(['auth', 'verified', 'role:admin|author'])->group(function () {
    Route::get('/role/','index')->middleware(['auth', 'verified'])->name('role');
    Route::get('/role/create','create')->middleware(['auth', 'verified'])->name('role.create');
    Route::post('/role/store','store')->middleware(['auth', 'verified'])->name('role.store');
    Route::delete('/role/destroy/{id}','destroy')->middleware(['auth', 'verified'])->name('role.destroy');
    Route::get('/role/edit/{id}','edit')->middleware(['auth', 'verified'])->name('role.edit');
    Route::put('/role/update/{id}','update')->middleware(['auth', 'verified'])->name('role.update');
});








