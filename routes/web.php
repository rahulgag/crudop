<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant;
use App\Http\Controllers\Customer;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Permissioncontroller;
use App\Http\Controllers\Rolecontroller;
use App\Http\Controllers\Usercontroller;




    

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['merchant.auth'])->group(function () {
    Route::get('dashboard', [Dashboard::class, 'dashbooard'])->name('dashboard');
    Route::get('merchantlogout', [Merchant::class, 'merchantlogout'])->name('merchant.logout');
    Route::get('customerlogout', [Customer::class, 'customerlogout'])->name('customer.logout');
    Route::get('addservice', [Customer::class, 'addservice'])->name('add.service');
    Route::get('listservice', [Customer::class, 'listservice']);
    Route::post('insertser', [Customer::class, 'insertser'])->name('insert.service');
    Route::get('serviceedit', [Customer::class, 'serviceedit']);
    Route::get('serviceddelete', [Customer::class, 'serviceddelete'])->name('service.delete');
    Route::post('service-update',[Customer::class, 'serviceUpdate'])->name('update.service');
    Route::get('servicedelete',[Customer::class, 'servicedelete'])->name('service.delete');

    Route::group(['middleware' => ['permission:view per']], function () {
        Route::get('listper', [Permissioncontroller::class, 'listper']);
     });
      Route::group(['middleware' => ['permission:create per']], function () {
        Route::get('addper', [Permissioncontroller::class, 'addper'])->name('per.add');
        Route::post('insertper', [Permissioncontroller::class, 'insertper'])->name('insert.per');
     });
       Route::group(['middleware' => ['permission:edit per']], function () {
       Route::get('peredit', [Permissioncontroller::class, 'peredit']);
        Route::post('per-update',[Permissioncontroller::class, 'perUpdate'])->name('update.per');
     });
     Route::group(['middleware' => ['permission:delete per']], function () {
        Route::get('perdelete',[Permissioncontroller::class, 'perdelete'])->name('per.delete');
     });

     Route::group(['middleware' => ['permission:view rol']], function () {
        Route::get('listrole', [Rolecontroller::class, 'listrole']);
     });
      Route::group(['middleware' => ['permission:create rol']], function () {
        Route::get('addrole', [Rolecontroller::class, 'addrole'])->name('add.role');
    Route::post('insertrole', [Rolecontroller::class, 'insertrole'])->name('insert.role');
     });
       Route::group(['middleware' => ['permission:edit rol']], function () {
        Route::get('roleedit', [Rolecontroller::class, 'roleedit']);
    Route::post('rol-update',[Rolecontroller::class, 'rolUpdate'])->name('update.rol');
     });
     Route::group(['middleware' => ['permission:delete rol']], function () {
       Route::get('roldelete',[Rolecontroller::class, 'roldelete'])->name('rol.delete');
     });
     Route::group(['middleware' => ['permission:delete user']], function () {
           Route::get('userdelete', [Usercontroller::class, 'userdelete'])->name('user.delete');

     });


    Route::group(['middleware' => ['permission:create user']], function () {
        Route::get('adduser', [Usercontroller::class, 'adduser'])->name('add.user');
        Route::post('insertuser', [Usercontroller::class, 'insertuser'])->name('insert.user');
     });
    Route::group(['middleware' => ['permission:view user']], function () {
         Route::get('listuser', [Usercontroller::class, 'listuser']);
     });
    Route::group(['middleware' => ['permission:edit user']], function () {
        Route::get('useredit', [Usercontroller::class, 'edit']);
        Route::post('user-update',[Usercontroller::class, 'userUpdate'])->name('update.user');
    });


    









        
        

        













        

    







   
});
 
    
    Route::get('merchant', [Merchant::class, 'mform'])->name('merchant');
    Route::post('merchantlogin', [Merchant::class, 'merchantlogin'])->name('merchant.login');
    Route::get('customer', [Customer::class, 'cform'])->name('customer');
    Route::post('customerlogin', [Customer::class, 'customerlogin'])->name('customer.login');









