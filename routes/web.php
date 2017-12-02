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
header('Access-Control-Allow-Headers: X-Requested-With, origin, content-type');
Route::get('/', function () {
    return redirect('/login');
});
// user route
Route::get('/user', "UserController@index");
Route::get('/user/profile', "UserController@load_profile");
Route::get('/user/reset-password', "UserController@reset_password");
Route::post('/user/change-password', "UserController@change_password");
Route::get('/user/finish', "UserController@finish_page");
Route::post('/user/update-profile', "UserController@update_profile");
Route::get('/user/delete/{id}', "UserController@delete");
Route::get('/user/create', "UserController@create");
Route::post('/user/save', "UserController@save");
Route::get('/user/edit/{id}', "UserController@edit");
Route::post('/user/update', "UserController@update");
Route::get('/user/update-password/{id}', "UserController@load_password");
Route::post('/user/save-password', "UserController@update_password");
Route::get('/user/getrole/{id}', "UserController@getRole");
Route::get('/user/getcomponent/{id}', "UserController@getComponent");
// role
Route::get("/role", "RoleController@index");
Route::get("/role/create", "RoleController@create");
Route::get("/role/edit/{id}", "RoleController@edit");
Route::get("/role/delete/{id}", "RoleController@delete");
Route::post("/role/save", "RoleController@save");
Route::post("/role/update", "RoleController@update");
Route::get('/role/permission/{id}', "PermissionController@index");
Route::post('/rolepermission/save', "PermissionController@save");
//Auth::routes();
Route::auth();
Route::get('/home', 'HomeController@index')->name('home');

// settings
Route::get('/setting', "SettingController@index");

// company
Route::get('/ngo', "NgoController@index");
Route::get('/ngo/detail/{id}', "NgoController@detail");
Route::get('/ngo/create', "NgoController@create");
Route::get('/ngo/delete/{id}', "NgoController@delete");
Route::get('/ngo/edit/{id}', "NgoController@edit");
Route::post('/ngo/save', "NgoController@save");
Route::post('/ngo/update', "NgoController@update");

/// component
Route::get('/component', "ComponentController@index");
Route::get('/component/create', "ComponentController@create");
Route::get('/component/edit/{id}', "ComponentController@edit");
Route::post('/component/save', "ComponentController@save");
Route::post('/component/update', "ComponentController@update");
Route::get('/component/delete/{id}', "ComponentController@delete");
// language
Route::get('/language/{id}', "LanguageController@index");