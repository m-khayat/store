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

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});


//  CategoriesController Api

Route::get('categories','CategoriesController@index');
Route::get('categories/{id}','CategoriesController@show');
Route::post('categories/store','CategoriesController@store');
Route::post('categories/update/{id}','CategoriesController@update');
Route::post('categories/delete/{id}','CategoriesController@destroy');
Route::get('SearchByCategory/','ProductsController@SearchByCategory');

   //  productsController Api

Route::get('products','ProductsController@index');
Route::get('products/progressive','ProductsController@progressive');
Route::get('products/descending','ProductsController@descending');
Route::get('products/{id}','ProductsController@show');
Route::post('products/store','ProductsController@store');
Route::post('products/update/{id}','ProductsController@update');
Route::post('products/delete/{id}','ProductsController@destroy');
Route::get('search/','ProductsController@search');

//registerController Api

Route::post('register','RegisterController@register');
Route::post('login','LoginController@login');
Route::middleware('auth:api')->post('logout','LoginController@logout');

//  CommentsController Api

Route::get('comments','CommentsController@index');
Route::get('comments/{id}','CommentsController@show');
Route::post('comments/store','CommentsController@store');
Route::post('comments/update/{id}','CommentsController@update');
Route::post('comments/delete/{id}','CommentsController@destroy');

//  LikesController Api

Route::get('like','LikesController@index');
Route::post('like/store','LikesController@store');
Route::post('like/delete/{id}','LikesController@destroy');
