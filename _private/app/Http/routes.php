<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middlewareGroups' => 'web', 'middleware' => 'auth'], function ()
{
});

Route::group(['middlewareGroups' => 'web'], function ()
{    
    /*Route::get('registration', function(){
        return view('auth.registration');
        });
    Route::post('registration', 'Auth\AuthController@create');*/
    Route::auth();

    /*Route::get('sessions/backup/{id}', 'SessionsController@getBackups')->where(['id' => '[0-9]+']);*/
/*    Route::get('contacts', 'HomeController@getFeed');
    Route::get('/{url}','HomeController@getPage')->where(['url' => '^(?!admin|_debugbar|contacts).+$']);*/
    Route::get('/', 'HomeController@getIndex');


});

/*
Route::get('init', function(){
    \App\Models\User::find( 1 )->update( [
        'email' => 'em@web3d.co.il',
        'first_name' => 'Eugene',
        'last_name' => 'Mednikov',
        'is_sa' => 1,
        'password' => 'makom_pwd',
    ]);
});
*/
