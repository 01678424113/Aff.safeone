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


Auth::routes();
Route::post('/forgot-password', 'Auth\ForgotPasswordController@sendMail')->name('forgot.sendMail');
Route::match(['get', 'post'], '/forgot-reset-password/{token}', 'Auth\ForgotPasswordController@resetPassword')->name('forgot.resetPassword');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'permissions']], function () {
    Route::group(['prefix' => 'user-manager'], function () {
        Route::get('/', 'UserAdminController@index')->name('user-admin.index');
        Route::get('show/{id}', 'UserAdminController@show')->name('user-admin.show');
        Route::get('create', 'UserAdminController@create')->name('user-admin.create');
        Route::post('store', 'UserAdminController@store')->name('user-admin.store');
        Route::get('{id}/edit', 'UserAdminController@edit')->name('user-admin.edit');
        Route::post('update/{id}', 'UserAdminController@update')->name('user-admin.update');
        Route::get('destroy/{id}', 'UserAdminController@destroy')->name('user-admin.destroy');
    });

    Route::group(['prefix' => 'campaign'], function () {
        Route::get('/', 'CampaignController@index')->name('campaign.index');
        Route::get('show/{id}', 'CampaignController@show')->name('campaign.show');
        Route::get('create', 'CampaignController@create')->name('campaign.create');
        Route::post('store', 'CampaignController@store')->name('campaign.store');
        Route::get('{id}/edit', 'CampaignController@edit')->name('campaign.edit');
        Route::post('update/{id}', 'CampaignController@update')->name('campaign.update');
        Route::get('destroy/{id}', 'CampaignController@destroy')->name('campaign.destroy');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::get('show/{id}', 'CategoryController@show')->name('category.show');
        Route::get('create', 'CategoryController@create')->name('category.create');
        Route::post('store', 'CategoryController@store')->name('category.store');
        Route::get('{id}/edit', 'CategoryController@edit')->name('category.edit');
        Route::post('update/{id}', 'CategoryController@update')->name('category.update');
        Route::get('destroy/{id}', 'CategoryController@destroy')->name('category.destroy');
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', 'PermissionController@index')->name('permission.index');
        Route::get('/tool', 'PermissionController@tool')->name('permission.tool');
        Route::get('show/{id}', 'PermissionController@show')->name('permission.show');
        Route::get('create', 'PermissionController@create')->name('permission.create');
        Route::post('store', 'PermissionController@store')->name('permission.store');
        Route::get('{id}/edit', 'PermissionController@edit')->name('permission.edit');
        Route::post('update/{id}', 'PermissionController@update')->name('permission.update');
        Route::get('destroy/{id}', 'PermissionController@destroy')->name('permission.destroy');
    });
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'RoleController@index')->name('role.index');
        Route::get('show/{id}', 'RoleController@show')->name('role.show');
        Route::get('create', 'RoleController@create')->name('role.create');
        Route::post('store', 'RoleController@store')->name('role.store');
        Route::get('{id}/edit', 'RoleController@edit')->name('role.edit');
        Route::post('update/{id}', 'RoleController@update')->name('role.update');
        Route::get('destroy/{id}', 'RoleController@destroy')->name('role.destroy');
    });
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'RoleController@index')->name('role.index');
        Route::get('show/{id}', 'RoleController@show')->name('role.show');
        Route::get('create', 'RoleController@create')->name('role.create');
        Route::post('store', 'RoleController@store')->name('role.store');
        Route::get('{id}/edit', 'RoleController@edit')->name('role.edit');
        Route::post('update/{id}', 'RoleController@update')->name('role.update');
        Route::get('destroy/{id}', 'RoleController@destroy')->name('role.destroy');
    });

});

