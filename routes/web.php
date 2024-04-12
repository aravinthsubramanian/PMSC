<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\LoginCheck;
use App\Http\Middleware\UserAuth;
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

Route::get('/', [UserController::class, 'loginoption'])->name('users.loginoption')->middleware(LoginCheck::class);

Route::post('users/login', [UserController::class, 'login'])->name('users.login');
Route::post('users/sendmail', [UserController::class, 'sendmail'])->name('users.sendmail');
Route::post('users/register', [UserController::class, 'register'])->name('users.register');
Route::get('users/registeroption', [UserController::class, 'registeroption'])->name('users.registeroption');
Route::get('users/forgotpassword', [UserController::class, 'forgotpassword'])->name('users.forgotpassword');
Route::post('users/updatepassword', [UserController::class, 'updatepassword'])->name('users.updatepassword');
Route::get('users/resetpassword/{token}', [UserController::class, 'resetpassword'])->name('users.resetpassword');
Route::get('users/loginoption', [UserController::class, 'loginoption'])->name('users.loginoption')->middleware(LoginCheck::class);

Route::middleware([UserAuth::class])->group(function () {
    Route::get('users/product', [UserController::class, 'products'])->name('users.product');
    Route::post('users/filterproduct', [UserController::class, 'filerproducts'])->name('users.filterproduct');
    Route::get('users/logout', [UserController::class, 'logout'])->name('users.logout');
    Route::get('users/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');
    Route::resource('users', UserController::class);
});


Route::post('admins/login', [AdminController::class, 'login'])->name('admins.login');
Route::post('admins/sendmail', [AdminController::class, 'sendmail'])->name('admins.sendmail');
Route::get('admins/forgotpassword', [AdminController::class, 'forgotpassword'])->name('admins.forgotpassword');
Route::post('admins/updatepassword', [AdminController::class, 'updatepassword'])->name('admins.updatepassword');
Route::get('admins/resetpassword/{token}', [AdminController::class, 'resetpassword'])->name('admins.resetpassword');
Route::get('admins/loginoption', [AdminController::class, 'loginoption'])->name('admins.loginoption')->middleware(LoginCheck::class);

Route::get('api/categories/{id}', [SubcategoryController::class, 'getSubcategories']);

Route::middleware([AdminAuth::class])->group(function () {

    Route::post('adminusers/fetch', [AdminController::class, 'userfetch'])->name('adminusers.fetch');
    Route::get('admins/users', [AdminController::class, 'users'])->name('admins.users');
    
    Route::get('admins/logout', [AdminController::class, 'logout'])->name('admins.logout');
    Route::get('admins/dashboard', [AdminController::class, 'dashboard'])->name('admins.dashboard');

    Route::post('admins/fetch', [AdminController::class, 'fetch'])->name('admins.fetch');

    Route::get('admins/myprofile/{id}', [AdminController::class, 'myprofile'])->name('admins.myprofile');
    Route::post('admins/proupdate/{id}', [AdminController::class, 'proupdate'])->name('admins.proupdate');

    Route::get('admins/mypassword/{id}', [AdminController::class, 'mypassword'])->name('admins.mypassword');
    Route::post('admins/updatepass/{id}', [AdminController::class, 'updatepass'])->name('admins.updatepass');

    Route::get('user/create', [AdminController::class,'usercreate'])->name('user.create');
    Route::post('user/store', [AdminController::class,'userstore'])->name('user.store');

    Route::get('user/{id}/edit', [AdminController::class,'useredit'])->name('user.edit');
    Route::patch('user/{id}', [AdminController::class,'userupdate'])->name('user.update');

    Route::delete('user/{id}', [AdminController::class,'userdestroy'])->name('user.destroy');

    Route::resource('admins', AdminController::class);

    Route::post('roles/fetch', [RoleController::class, 'fetch'])->name('roles.fetch');
    Route::resource('roles', RoleController::class);
    
    Route::post('permissions/fetch', [PermissionController::class, 'fetch'])->name('permissions.fetch');
    Route::resource('permissions', PermissionController::class);
    
    Route::post('categories/fetch', [CategoryController::class, 'fetch'])->name('categories.fetch');
    Route::resource('categories', CategoryController::class);
    
    Route::post('subcategories/fetch', [SubcategoryController::class, 'fetch'])->name('subcategories.fetch');
    
    Route::resource('subcategories', SubcategoryController::class);

    Route::post('products/fetch', [ProductController::class, 'fetch'])->name('products.fetch');
    Route::resource('products', ProductController::class);
});


Route::group(['middleware' => 'api'], function ($router) {
    Route::post('tokregister',[TokenController::class,'tokregister']);
    Route::post('toklogin', [TokenController::class, 'toklogin']);
    Route::post('toklogout', [TokenController::class, 'toklogout']);
    Route::post('tokrefresh', [TokenController::class, 'tokrefresh']);
    Route::post('tokme', [TokenController::class, 'tokme']);
});
