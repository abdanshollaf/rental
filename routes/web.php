<?php

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
    if (!Session::get('login')) {
        return redirect('login');
    } else {
        return view('dashboard');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'DashboardCont@index')->name('dashboard');

Route::get('/master/konsumen/index', 'Master\CustomerCont@index')->name('custindex');
Route::get('/master/konsumen/create', 'Master\CustomerCont@create')->name('custcreate');
Route::post('/master/konsumen/store', 'Master\CustomerCont@store')->name('custstore');
Route::get('/master/konsumen/edit/{id}', 'Master\CustomerCont@edit')->name('custedit');
Route::post('/master/konsumen/update/{id}', 'Master\CustomerCont@update')->name('custupdate');
Route::get('/master/konsumen/delete/{id}', 'Master\CustomerCont@delete')->name('custdelete');

Route::get('/master/mobil/index', 'Master\MobilCont@index')->name('carindex');
Route::get('/master/mobil/create', 'Master\MobilCont@create')->name('carcreate');
Route::post('/master/mobil/store', 'Master\MobilCont@store')->name('carstore');
Route::get('/master/mobil/edit/{id}', 'Master\MobilCont@edit')->name('caredit');
Route::post('/master/mobil/update/{id}', 'Master\MobilCont@update')->name('carupdate');
Route::get('/master/mobil/delete/{id}', 'Master\MobilCont@delete')->name('cardelete');

Route::get('/master/vendor/index', 'Master\VendorCont@index')->name('vendorindex');
Route::get('/master/vendor/create', 'Master\VendorCont@create')->name('vendorcreate');
Route::post('/master/vendor/store', 'Master\VendorCont@store')->name('vendorstore');
Route::get('/master/vendor/edit/{id}', 'Master\VendorCont@edit')->name('vendoredit');
Route::post('/master/vendor/update/{id}', 'Master\VendorCont@update')->name('vendorupdate');
Route::get('/master/vendor/delete/{id}', 'Master\VendorCont@delete')->name('vendordelete');



// Route::resource('/master/driver','Master\DriverCont');

Route::get('/master/driver/index', 'Master\DriverCont@index')->name('driverindex');
Route::get('/master/driver/create', 'Master\DriverCont@create')->name('drivercreate');
Route::post('/master/driver/store', 'Master\DriverCont@store')->name('driverstore');
Route::get('/master/driver/edit/{id}', 'Master\DriverCont@edit')->name('driveredit');
Route::post('/master/driver/update/{id}', 'Master\DriverCont@update')->name('driverupdate');
Route::get('/master/driver/delete/{id}', 'Master\DriverCont@delete')->name('driverdelete');

Route::get('/master/tipe_pelanggan/index', 'Master\TipePelangganCont@index')->name('tipeindex');
Route::get('/master/tipe_pelanggan/create', 'Master\TipePelangganCont@create')->name('tipecreate');
Route::post('/master/tipe_pelanggan/store', 'Master\TipePelangganCont@store')->name('tipestore');
Route::get('/master/tipe_pelanggan/edit/{id}', 'Master\TipePelangganCont@edit')->name('tipeedit');
Route::post('/master/tipe_pelanggan/update/{id}', 'Master\TipePelangganCont@update')->name('tipeupdate');
Route::get('/master/tipe_pelanggan/delete/{id}', 'Master\TipePelangganCont@delete')->name('tipedelete');

Route::get('/master/tipe_mobil/index', 'Master\TIpeMobilCont@index')->name('tipemobilindex');
Route::get('/master/tipe_mobil/create', 'Master\TIpeMobilCont@create')->name('tipemobilcreate');
Route::post('/master/tipe_mobil/store', 'Master\TIpeMobilCont@store')->name('tipemobilstore');
Route::get('/master/tipe_mobil/edit/{id}', 'Master\TIpeMobilCont@edit')->name('tipemobiledit');
Route::post('/master/tipe_mobil/update/{id}', 'Master\TIpeMobilCont@update')->name('tipemobilupdate');
Route::get('/master/tipe_mobil/delete/{id}', 'Master\TIpeMobilCont@delete')->name('tipemobildelete');

Route::get('/orders/index', 'Orders\OrderCont@index')->name('orderindex');
Route::get('/orders/add', 'Orders\OrderCont@create')->name('orderadd');
Route::post('/order/create', 'Orders\OrderCont@store')->name('orderstore');
Route::get('/orders/edit/{id}', 'Orders\OrderCont@edit')->name('orderedit');
Route::post('/orders/update/{id}', 'Orders\OrderCont@update')->name('orderupdate');
Route::get('/orders/show/{id}', 'Orders\OrderCont@show')->name('ordershow');
Route::get('/orders/delete/{id}', 'Orders\OrderCont@delete')->name('orderdelete');
Route::get('/orders/print-pdf/{id}/invoice', 'Orders\OrderCont@invoice')->name('invoice');
Route::get('/orders/print-pdf/{id}/spj', 'Orders\OrderCont@spj')->name('spj');
Route::get('/orders/print-pdf/{id}/tiket', 'Orders\OrderCont@tiket')->name('tiket');
Route::get('/orders/(:num?)','Orders\OrdersCont@filterCnD')->name('order.filter');