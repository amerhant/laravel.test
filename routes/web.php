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

Route::match(['get', 'post'], '/', 'SiteController@index'); 
Route::get('/admin',  function (){
    return redirect('/admin/employees');
});
Route::resource('/admin/employees', 'Admin\EmployeesResource',['except'=>['show']]);

Auth::routes(['except'=>['/register']]);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout'); 
