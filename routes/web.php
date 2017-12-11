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
Route::get('/user/get/{id}', "UserController@get");
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
Route::get('/component/get/{id}', "ComponentController@get");
Route::get('/component/create', "ComponentController@create");
Route::get('/component/edit/{id}', "ComponentController@edit");
Route::get('/component/delete/{id}', "ComponentController@delete");
Route::post('/component/save', "ComponentController@save");
Route::post('/component/update', "ComponentController@update");



/// project
Route::get('/project', "ProjectController@index");
Route::get('/project/create', "ProjectController@create");
Route::get('/project/edit/{id}', "ProjectController@edit");
Route::get('/project/delete/{id}', "ProjectController@delete");
Route::post('/project/save', "ProjectController@save");
Route::post('/project/update', "ProjectController@update");
Route::get('/project/get/{id}', "ProjectController@get");

/// activity type
Route::get('/activity_type', "ActivityTypeController@index");
Route::get('/activity_type/get/{id}', "ActivityTypeController@get");
Route::get('/activity_type/create', "ActivityTypeController@create");
Route::get('/activity_type/edit/{id}', "ActivityTypeController@edit");
Route::get('/activity_type/delete/{id}', "ActivityTypeController@delete");
Route::post('/activity_type/save', "ActivityTypeController@save");
Route::post('/activity_type/update', "ActivityTypeController@update");

/// framework
Route::get('/framework', "FrameworkController@index");
Route::get('/framework/get/{id}', "FrameworkController@get");
Route::get('/framework/create', "FrameworkController@create");
Route::get('/framework/edit/{id}', "FrameworkController@edit");
Route::get('/framework/delete/{id}', "FrameworkController@delete");
Route::post('/framework/save', "FrameworkController@save");
Route::post('/framework/update', "FrameworkController@update");

/// level
Route::get('/level', "LevelController@index");
Route::get('/level/create', "LevelController@create");
Route::get('/level/edit/{id}', "LevelController@edit");
Route::get('/level/delete/{id}', "LevelController@delete");
Route::post('/level/save', "LevelController@save");
Route::post('/level/update', "LevelController@update");

/// activity category
Route::get('/activity_category', "ActivityCategoryController@index");
Route::get('/activity_category/create', "ActivityCategoryController@create");
Route::get('/activity_category/edit/{id}', "ActivityCategoryController@edit");
Route::get('/activity_category/delete/{id}', "ActivityCategoryController@delete");
Route::post('/activity_category/save', "ActivityCategoryController@save");
Route::post('/activity_category/update', "ActivityCategoryController@update");

/// event
Route::get('/event', "EventController@index");
Route::get('/event/create', "EventController@create");
Route::get('/event/edit/{id}', "EventController@edit");
Route::get('/event/delete/{id}', "EventController@delete");
Route::post('/event/save', "EventController@save");
Route::post('/event/update', "EventController@update");

/// Venue type
Route::get('/venue_type', "VenueTypeController@index");
Route::get('/venue_type/create', "VenueTypeController@create");
Route::get('/venue_type/edit/{id}', "VenueTypeController@edit");
Route::get('/venue_type/delete/{id}', "VenueTypeController@delete");
Route::post('/venue_type/save', "VenueTypeController@save");
Route::post('/venue_type/update', "VenueTypeController@update");

/// event organizor
Route::get('/event_organizor', "EventOrganizorController@index");
Route::get('/event_organizor/create', "EventOrganizorController@create");
Route::get('/event_organizor/edit/{id}', "EventOrganizorController@edit");
Route::get('/event_organizor/delete/{id}', "EventOrganizorController@delete");
Route::post('/event_organizor/save', "EventOrganizorController@save");
Route::post('/event_organizor/update', "EventOrganizorController@update");

Route::get('/component/delete/{id}', "ComponentController@delete");
// language
Route::get('/language/{id}', "LanguageController@index");
// activity
Route::get('/activity', "ActivityController@index");
// indicator setting
Route::get('/indicator', "IndicatorController@index");
Route::get('/indicator/create', "IndicatorController@create");
Route::get('/indicator/edit/{id}', "IndicatorController@edit");
Route::get('/indicator/delete/{id}', "IndicatorController@delete");
Route::get('/indicator/detail/{id}', "IndicatorController@detail");
Route::post('/indicator/save', "IndicatorController@save");
Route::post('/indicator/update', "IndicatorController@update");
Route::post('/indicator/target/save', "IndicatorController@add_target");
Route::get('/indicator/target/delete/{id}', "IndicatorController@delete_target");
// activity setting
Route::get('/activity-setting', "ActivitySettingController@index");
Route::get('/activity-setting/create', "ActivitySettingController@create");
Route::get('/activity-setting/edit/{id}', "ActivitySettingController@edit");
Route::get('/activity-setting/delete/{id}', "ActivitySettingController@delete");
Route::get('/activity-setting/detail/{id}', "ActivitySettingController@detail");
Route::post('/activity-setting/save', "ActivitySettingController@save");
Route::post('/activity-setting/update', "ActivitySettingController@update");