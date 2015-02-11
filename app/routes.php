<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the Closure to execute when that URI is requested.
    |
    */

    Route::group(array('before' => 'auth'),function(){
        Route::get('/','HomeController@home');
        Route::get('/activity','ActivityController@index');
    });
    Route::group(array('prefix' => 'user'),function(){
        Route::get('/login','UserController@getLogin');
        Route::post('/login', array('before' => 'csrf', 'uses' => 'UserController@postLogin'));
        Route::get('/register','UserController@getRegister');
        Route::post('/register', array('before' => 'csrf', 'uses' => 'UserController@postRegister'));
        Route::get('/forgotpassword','UserController@getForgotPassword');
        Route::post('/forgotpassword',array('before' => 'csrf', 'uses' => 'UserController@postForgotPassword'));
        Route::get('/resetpassword','UserController@getResetPassword');
        Route::post('/resetpassword','UserController@postResetPassword');
        Route::get('/logout','UserController@getLogout');
    });
    Route::group(array('prefix' => 'ajax', 'before' => 'auth'),function(){
        Route::post('/page', array('before' => 'csrf', 'uses' => 'AjaxController@page'));
        Route::post('/form', array('before' => 'csrf', 'uses' => 'AjaxController@form'));
        Route::post('/expense', array('before' => 'csrf', 'uses' => 'AjaxController@expense'));
        Route::post('/save', array('before' => 'csrf', 'uses' => 'AjaxController@save'));
        Route::post('/delete', array('before' => 'csrf', 'uses' => 'AjaxController@delete'));
        Route::post('/upload', array('before' => 'csrf', 'uses' => 'AjaxController@upload'));
        Route::post('/clear', array('before' => 'csrf', 'uses' => 'AjaxController@clear'));
        Route::post('/import', array('before' => 'csrf', 'uses' => 'AjaxController@import'));
        Route::post('/deleteall', array('before' => 'csrf', 'uses' => 'AjaxController@deleteAll'));
        Route::post('/quicksetup', array('before' => 'csrf', 'uses' => 'AjaxController@quicksetup'));
        Route::post('/genreport', array('before' => 'csrf', 'uses' => 'AjaxController@generateReport'));
        Route::post('/expensereport', array('before' => 'csrf', 'uses' => 'AjaxController@expenseReport'));
        Route::post('/chart', array('before' => 'csrf', 'uses' => 'AjaxController@loadChart'));
        Route::post('/invoice', array('before' => 'csrf', 'uses' => 'AjaxController@loadInvoice'));
        Route::post('/invoices', array('before' => 'csrf', 'uses' => 'AjaxController@invoices'));
        Route::post('/invoice/action', array('before' => 'csrf', 'uses' => 'AjaxController@invoiceAction'));
        Route::get('/client', array('before' => 'csrf', 'uses' => 'AjaxController@getClient'));
        Route::get('/category', array('before' => 'csrf', 'uses' => 'AjaxController@categoryPage'));
        Route::post('/expensereport', array('before' => 'csrf', 'uses' => 'AjaxController@expenseReport'));
        Route::post('/changeDate', array('before' => 'csrf', 'uses' => 'AjaxController@changeDate'));
        //modify
        Route::post('/category/renameCategory', array( 'uses' => 'AjaxController@renameCategory'));
        Route::post('/category/deleteCategory', array( 'uses' => 'AjaxController@deleteCategory'));
        Route::post('/category/addNewCategory', array( 'uses' => 'AjaxController@addNewCategory'));

    });
    Route::get('/cron/{recurring_id}','RecurringController@excute');
    Route::get('/jrsql','HomeController@jrsql');
    Route::post('/MobileAPI','MobileAPI@api');

