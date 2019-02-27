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

Route::get('/logout', 'HomeController@logout')->name('logout');

Route::get('redirect-step-1/{aff_id}', 'AffController@affRedirectStep1')->name('affRedirectStep1');
Route::get('/', 'LandingPageController@landingPage')->name('landingPage');

Route::group(['middleware' => ['auth','permissions']], function () {
    Route::group(['prefix' => 'admin-manager'], function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::group(['prefix' => 'user-manager'], function () {
            Route::get('/', 'UserAdminController@index')->name('user-admin.index');
            Route::get('show/{id}', 'UserAdminController@show')->name('user-admin.show');
            Route::get('create', 'UserAdminController@create')->name('user-admin.create');
            Route::post('store', 'UserAdminController@store')->name('user-admin.store');
            Route::get('{id}/edit', 'UserAdminController@edit')->name('user-admin.edit');
            Route::post('update/{id}', 'UserAdminController@update')->name('user-admin.update');
            Route::get('destroy/{id}', 'UserAdminController@destroy')->name('user-admin.destroy');
            Route::get('withdrawal', 'UserAdminController@withdrawal')->name('user-admin.withdrawal');
            Route::post('withdrawal', 'UserAdminController@doWithdrawal')->name('user-admin.doWithdrawal');
        });

        Route::group(['prefix' => 'campaign'], function () {
            Route::get('/', 'CampaignController@index')->name('campaign.index');
            Route::get('show/{id}', 'CampaignController@show')->name('campaign.show');
            Route::get('create', 'CampaignController@create')->name('campaign.create');
            Route::post('store', 'CampaignController@store')->name('campaign.store');
            Route::get('{id}/edit', 'CampaignController@edit')->name('campaign.edit');
            Route::post('update/{id}', 'CampaignController@update')->name('campaign.update');
            Route::get('destroy/{id}', 'CampaignController@destroy')->name('campaign.destroy');

            Route::get('my-campaign', 'CampaignController@myCampaign')->name('campaign.myCampaign');
        });
        Route::post('join/{campaign_id}', 'AffController@joinCampaign')->name('joinCampaign');
        Route::post('create-link-aff', 'AffController@createLinkAFF')->name('createLinkAFF');

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
        Route::group(['prefix' => 'transaction-manager'], function () {
            Route::get('/', 'TransactionController@index')->name('transaction-manager.index');
            Route::get('manager', 'TransactionController@manager')->name('transaction-manager.manager');
            Route::get('create', 'TransactionController@create')->name('transaction-manager.create');
            Route::get('individual', 'TransactionController@individual')->name('transaction-manager.individual');
            Route::post('store', 'TransactionController@store')->name('transaction-manager.store');
            Route::get('show/{id}', 'TransactionController@show')->name('transaction-manager.show');
            Route::get('{id}/edit', 'TransactionController@edit')->name('transaction-manager.edit');
            Route::post('update/{id}', 'TransactionController@update')->name('transaction-manager.update');
            Route::post('update-withdrawal/{id}', 'TransactionController@updateWithdrawal')->name('transaction-manager.updateWithdrawal');
            Route::get('destroy/{id}', 'TransactionController@destroy')->name('transaction-manager.destroy');
            Route::get('list-request-paid', 'TransactionController@listRequestPaid')->name('transaction-manager.listRequestPaid');
            Route::get('list-withdrawal', 'TransactionController@listWithdrawal')->name('transaction-manager.listWithdrawal');
        });

        Route::group(['prefix' => 'customer'], function () {
            Route::get('/admin/{campaign_id}', 'CustomerController@indexAdmin')->name('customer.indexAdmin');
            Route::get('/{campaign_id}', 'CustomerController@index')->name('customer.index');
            Route::post('/update/{id}', 'CustomerController@update')->name('customer.update');
            Route::get('/destroy/{id}', 'CustomerController@destroy')->name('customer.destroy');
            Route::post('/request-pay/{id}', 'CustomerController@requestPay')->name('customer.requestPay');
            Route::post('/pay/{id}', 'CustomerController@pay')->name('customer.pay');
        });
    });
});
Route::post('customer/store', 'CustomerController@store')->name('customer.store');

