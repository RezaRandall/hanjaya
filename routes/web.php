<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemMasterController;
use App\Http\Controllers\OrderProcessController;
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

// LOGIN AUTH
Route::get('/', [AuthController::class, 'getLogin'])->name('login');
Route::get('login', [AuthController::class, 'getLogin'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('register', [AuthController::class, 'getRegister'])->name('register');
Route::post('register', [AuthController::class, 'postRegister']);

Route::group(['middleware' => 'auth'], function()
{
    Route::get('logout', [AuthController::class, 'getLogout'])->name('logout');

    // ITEM MASTER
    Route::get('itemMaster', [ItemMasterController::class, 'itemMaster'])->name('itemMaster');
    // create new item
    Route::post('itemMaster/storeItemMaster', [ItemMasterController::class, 'storeItemMaster'])->name('storeItemMaster');
    // edit route item master
    Route::get('itemMaster/edit/{id}',  [ItemMasterController::class, 'edit'])->name('edit');
    // update route
    Route::post('itemMaster/update', [ItemMasterController::class, 'update'])->name('update');
    // delete item master
    Route::get('itemMaster/deleteItemMaster/{id}', [ItemMasterController::class, 'deleteItemMaster'])->name('deleteItemMaster');
    // search
    Route::post('itemMaster', [ItemMasterController::class, 'search'])->name('search');
    // pdf
    Route::get('itemMaster/print_pdf', [ItemMasterController::class, 'print_pdf'])->name('print_pdf');

    // ORDER PROCESS
    // Get dropdown item master list
    Route::get('orderProcess', [OrderProcessController::class, 'getItemMasterList'])->name('getItemMasterList');
    // get data price by selected item
    Route::get('findPrice', [OrderProcessController::class, 'getItemPrice'])->name('getItemPrice'); // getItemPrice
    // store order
    Route::post('orderProcess/storeOrder', [OrderProcessController::class, 'storeOrder'])->name('storeOrder');

    // LIST ORDER
    // get list order items
    Route::get('listOrderItem', [OrderProcessController::class, 'getListOrder'])->name('getListOrder');
    // pdf
    Route::get('listOrderItem/print_pdf', [OrderProcessController::class, 'print_pdf'])->name('print_pdf');
    // search list item
    Route::post('listOrderItem', [OrderProcessController::class, 'searchListOrder'])->name('searchListOrder');

});


// Route::get('login', function(){
//     if(session()->has('name'))
//     {
//         return redirect('itemMaster');
//     }
//     return view('login');
// });

// Route::get('logout', function(){
//     if(session()->has('name'))
//     {
//         session()->pull('name');
//     }
//     return redirect('login');
// });



// Retrieve data from database item_master 'App\Http\Controllers\ItemMasterController@itemMaster'
// Route::get('itemMaster', [ItemMasterController::class, 'itemMaster'])->name('itemMaster');

// Route::get('logout',  [AuthController::class, 'getLogout'])->name('logout');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
