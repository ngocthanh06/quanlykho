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

// Route::get('/login', function () {
//     return view('login');
// });
Route::get('/logout','LoginController@getLogout');

Route::group(['prefix' => '/','middleware' => 'checkLogin'], function(){
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@postIndex');
});

Route::group(['prefix' => '/','middleware' => 'checkLogout'], function(){

/**
 * Todo Category
 */
Route::get('/listCategory', 'categoryController@index');
Route::get('addCate', 'categoryController@create');
Route::post('addCate', 'categoryController@store');
Route::get('editCate/{id}', 'categoryController@show');
Route::post('editCate/{id}', 'categoryController@update');
Route::get('delCate/{id}', 'categoryController@destroy');

/**
 * Todo Product
 */
Route::get('/listProduct', 'productController@index');
Route::get('addProd', 'productController@create');
Route::post('addProd', 'productController@store');
Route::get('editProd/{id}', 'productController@show');
Route::post('editProd/{id}', 'productController@update');
Route::get('delProd/{id}', 'productController@destroy');

/**
 * Todo Supplier
 */
Route::get('/listsupplier', 'SupplierController@index');
Route::get('/addsupp', 'SupplierController@create');
Route::post('/addsupp', 'SupplierController@store');
Route::get('editsupp/{id}', 'SupplierController@show');
Route::post('editsupp/{id}', 'SupplierController@update');
Route::get('delsupp/{id}', 'SupplierController@destroy');

/**
 * Todo nhapkho
 */
Route::get('/Nhapkho', 'NhapKhoController@index');
Route::get('/addNhap', 'NhapKhoController@create');
Route::post('/addNhap', 'NhapKhoController@store');
Route::get('editNhap/{id}','NhapKhoController@edit');
Route::post('editNhap/{id}','NhapKhoController@update');
Route::get('listSpNhapKho','NhapKhoController@listSpNhapKho');


/**
 * Todo xuatkho
 */
Route::get('/xuatkho', 'XuatKhoController@index');
Route::get('/addxuat', 'XuatKhoController@create');
Route::post('/addxuat', 'XuatKhoController@store');
Route::get('editxuat/{id}','XuatKhoController@edit');
Route::post('editxuat/{id}','XuatKhoController@update');
Route::get('listSpxuatKho','XuatKhoController@listSpNhapKho');


});
Route::get('/home', 'HomeController@index')->name('home');
