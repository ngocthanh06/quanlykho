<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/allProduct', 'productController@allProduct');
Route::post('/removeDetailProduct', 'NhapkhoController@removeDetailProduct');
Route::post('/removeDetaiXuatkho', 'XuatKhoController@removeDetailProduct');
Route::get('/loadClient/{id}','ClientController@loadClient');
Route::get('/loadProduct/{id}','ProductController@loadProduct');
Route::get('/checkProduct/{id}', 'ProductController@checkProduct');
Route::get('/checkLoadProd/{id}','ProductController@checkLoadProd');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
