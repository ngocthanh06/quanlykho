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
Route::get('addCate', 'categoryController@create')->middleware('checkRole');
Route::post('addCate', 'categoryController@store')->middleware('checkRole');
Route::get('editCate/{id}', 'categoryController@show')->middleware('checkRole');
Route::post('editCate/{id}', 'categoryController@update')->middleware('checkRole');
Route::get('delCate/{id}', 'categoryController@destroy')->middleware('checkRole');

/**
 * Todo Product
 */
Route::get('/listProduct', 'productController@index');
Route::get('addProd', 'productController@create')->middleware('checkRole');
Route::post('addProd', 'productController@store')->middleware('checkRole');
Route::get('editProd/{id}', 'productController@show')->middleware('checkRole');
Route::post('editProd/{id}', 'productController@update')->middleware('checkRole');
Route::get('delProd/{id}', 'productController@destroy')->middleware('checkRole');
Route::get('changeStatusProduct/{id}', 'productController@changeStatusProduct');
Route::get('conhsd', 'productController@conhsd');
Route::get('hethan', 'productController@hethan');
Route::get('saphethan', 'productController@saphethan');
Route::get('conkinhdoanh', 'productController@conkinhdoanh');
Route::get('ngungkinhdoanh', 'productController@ngungkinhdoanh');

/**
 * Todo Supplier
 */
Route::get('/listsupplier', 'SupplierController@index');
Route::get('/addsupp', 'SupplierController@create')->middleware('checkRole');
Route::post('/addsupp', 'SupplierController@store')->middleware('checkRole');
Route::get('editsupp/{id}', 'SupplierController@show')->middleware('checkRole');
Route::post('editsupp/{id}', 'SupplierController@update')->middleware('checkRole');
Route::get('delsupp/{id}', 'SupplierController@destroy')->middleware('checkRole');

/**
 * Todo cung cấp
 * Nhà cung sản xuất thành nhà cung cấp và ngược lại
 */
Route::get('/listnhacungcap', 'NhasanxuatController@index');
Route::get('/addnhasx', 'NhasanxuatController@create')->middleware('checkRole');
Route::post('/addnhasx', 'NhasanxuatController@store')->middleware('checkRole');
Route::get('editnhasx/{id}', 'NhasanxuatController@show')->middleware('checkRole');
Route::post('editnhasx/{id}', 'NhasanxuatController@update')->middleware('checkRole');
Route::get('delnhasx/{id}', 'NhasanxuatController@destroy')->middleware('checkRole');


/**
 * Todo nhapkho
 */
Route::get('/Nhapkho', 'NhapKhoController@index');
Route::get('/addNhap', 'NhapKhoController@create')->middleware('checkRole');
Route::post('/addNhap', 'NhapKhoController@store')->middleware('checkRole');
Route::get('editNhap/{id}','NhapKhoController@edit')->middleware('checkRole');
Route::post('editNhap/{id}','NhapKhoController@update')->middleware('checkRole');
Route::get('listSpNhapKho','NhapKhoController@listSpNhapKho');


/**
 * Todo xuatkho
 */
Route::get('/xuatkho', 'XuatKhoController@index');
Route::get('/addxuat', 'XuatKhoController@create')->middleware('checkRole');
Route::post('/addxuat', 'XuatKhoController@store')->middleware('checkRole');
Route::get('editxuat/{id}','XuatKhoController@edit')->middleware('checkRole');
Route::post('editxuat/{id}','XuatKhoController@update')->middleware('checkRole');
Route::get('listSpxuatKho','XuatKhoController@listSpxuatKho');

/**
 * Todo thongke
 */
Route::get('/thongkesp', 'thongkeController@thongkesp');
Route::get('/home', 'thongkeController@home');
Route::post('/thongkesp', 'thongkeController@postthongkesp')->middleware('checkRole');
Route::get('/kiemke', 'thongkeController@kiemke');
Route::post('/kiemke','thongkeController@searchKiemke');
Route::get('/kiemke/addThucte/{id}','ThongkeController@addThucte')->middleware('checkRole');
Route::post('/kiemke/addThucte/{id}','ThongkeController@postaddThucte')->middleware('checkRole');
Route::get('/kiemke/editThucte/{id}','ThongkeController@editThucte')->middleware('checkRole');
Route::post('/kiemke/editThucte/{id}','ThongkeController@postEditThucte')->middleware('checkRole');
Route::get('/kiemke/thongketonkho','ThongkeController@thongketonkho');

// Route::get('editxuat/{id}','XuatKhoController@edit');
// Route::post('editxuat/{id}','XuatKhoController@update');
// Route::get('listSpxuatKho','XuatKhoController@listSpxuatKho');


});
// Route::get('/home', 'HomeController@index')->name('home');
/**
 * Todo Khách Hàng
 */
Route::get('/listClient', 'ClientController@index');
Route::get('addClient', 'ClientController@create')->middleware('checkRole');
Route::post('addClient', 'ClientController@store')->middleware('checkRole');
Route::get('editClient/{id}', 'ClientController@show')->middleware('checkRole');
Route::post('editClient/{id}', 'ClientController@update')->middleware('checkRole');
Route::get('delClient/{id}', 'ClientController@destroy')->middleware('checkRole');

/**
 * Todo user
 */
Route::get('user/update/{id}', 'Usercontroller@show');
Route::post('user/update/{id}', 'Usercontroller@update')->middleware('checkRole');
Route::get('/listusers', 'Usercontroller@index');
Route::get('/adduser', 'Usercontroller@create')->middleware('checkRole');
Route::post('/adduser', 'Usercontroller@store')->middleware('checkRole');    
Route::get('/deluser/{id}', 'Usercontroller@destroy')->middleware('checkRole');

/**
 * Todo role
 */

Route::get('editrole/{id}', 'RoleController@show')->middleware('checkRole');
Route::post('editrole/{id}', 'RoleController@update')->middleware('checkRole');
Route::get('/listrole', 'RoleController@index');
Route::get('/addrole', 'RoleController@create')->middleware('checkRole');
Route::post('/addrole', 'RoleController@store')->middleware('checkRole');    
Route::get('/delrole/{id}', 'RoleController@destroy')->middleware('checkRole');