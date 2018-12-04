<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//login page
Route::get('login', 'LoginController@index')->name('admin.login');
Route::post('doLogin', 'LoginController@doLogin')->name('admin.doLogin');

//logout
Route::get('logout', 'LoginController@logout')->name('admin.logout');

Route::group(['middleware' => ['adminAuth']], function () {

    //极验验证
    Route::get('geetest', 'LoginController@geetest')->name('admin.geetest');
    Route::post('verifyGt', 'LoginController@verifyGeetest')->name('admin.verifyGeetest');
    

    //upload file
    Route::post('upload','BaseController@uploadFile')->name('admin.upload');
    Route::post('draftPicUpload','BaseController@draftPicUpload')->name('admin.draftPicUpload');

    //dashboard
    Route::get('/','IndexController@index')->name('admin.index');
    Route::get('dashboard','IndexController@dashboard')->name('admin.dashboard');

    //login to site
    Route::get('/loading/{site}','IndexController@loadShow')->name('admin.loadShow');

    //getUserMenu
    Route::get('getMenu/{pid?}','IndexController@getMenu')->name('admin.getMenu');

    //user manage
    Route::get('users/getList','UserController@getList')->name('users.getList');
    Route::post('users/delete','UserController@delete')->name('users.delete');
    Route::resource('users', 'UserController',['parameters' => [
        'user' => 'id'
    ]]);

    //operation manage
    Route::get('operations/getList','OperationController@getList')->name('operations.getList');
    Route::post('operations/delete','OperationController@delete')->name('operations.delete');
    Route::resource('operations', 'OperationController',['parameters' => [
        'operation' => 'id'
    ]]);

    //menu manage
    Route::get('menus/getList','MenuController@getList')->name('menus.getList');
    Route::post('menus/delete','MenuController@delete')->name('menus.delete');
    Route::resource('menus', 'MenuController',['parameters' => [
        'menu' => 'id'
    ]]);

    //article manage
    Route::get('articles/getList','ArticleController@getList')->name('articles.getList');
    Route::post('articles/delete','ArticleController@delete')->name('articles.delete');
    Route::resource('articles', 'ArticleController',['parameters' => [
        'article' => 'id'
    ]]);

    //role manage
    Route::post('roles/upMenus','RoleController@upMenus')->name('roles.upMenus');
    Route::get('roles/getList','RoleController@getList')->name('roles.getList');
    Route::post('roles/delete','RoleController@delete')->name('roles.delete');
    Route::resource('roles', 'RoleController',['parameters' => [
        'role' => 'id'
    ]]);


    //permission manage
    Route::get('permissions/getList','PermissionController@getList')->name('permissions.getList');
    Route::post('permissions/delete','PermissionController@delete')->name('permissions.delete');
    Route::resource('permissions', 'PermissionController',['parameters' => [
        'permission' => 'id'
    ]]);
   
    //config manager
    Route::any('config','ConfigController@index')->name('config.index');

    //log manage
    Route::get('logs/getList','LogController@getList')->name('logs.getList');
    Route::post('logs/delete','LogController@delete')->name('logs.delete');
    Route::resource('logs', 'LogController',['parameters' => [
        'log' => 'id'
    ]]);

    //auto generate routes
    
});


