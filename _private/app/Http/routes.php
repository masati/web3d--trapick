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

// Step by step form
Route::get('step1', 'OrderController@getStep1');
Route::post('step1', 'OrderController@postStep1')
    ->name('step1');

Route::get('step2', 'OrderController@getStep2');
Route::post('step2', 'OrderController@postStep2')
    ->name('step2');

Route::get('step3', 'OrderController@getStep3');
Route::post('step3', 'OrderController@postStep3')
    ->name('step3');

Route::get('step4', 'OrderController@getStep4');
Route::post('step4', 'OrderController@postStep4')
    ->name('step4');

Route::get('step5', 'OrderController@getStep5');
Route::post('step5', 'OrderController@postStep5')
    ->name('step5');



Route::group(['middlewareGroups' => 'web', 'middleware' => 'auth'], function ()
{
});

Route::group(['middlewareGroups' => 'web'], function ()
{    
    Route::get('registration', function(){
        return view('auth.registration');
        });
    Route::post('registration', 'Auth\AuthController@create');
    Route::auth();

// Step by step form
    Route::get('step1', 'OrderController@getStep1');
    Route::post('step1', 'OrderController@postStep1')
        ->name('step1');

    Route::get('step2', 'OrderController@getStep2');
    Route::post('step2', 'OrderController@postStep2')
        ->name('step2');

    Route::get('step3', 'OrderController@getStep3');
    Route::post('step3', 'OrderController@postStep3')
        ->name('step3');

    Route::get('step4', 'OrderController@getStep4');
    Route::post('step4', 'OrderController@postStep4')
        ->name('step4');

    Route::get('step5', 'OrderController@getStep5');
    Route::post('step5', 'OrderController@postStep5')
        ->name('step5');

    Route::get('orders/{id?}', 'OrderController@getOrders');
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



function is_active($step, $num) {
    $active = ($step === $num) ? 'color:blue' : '';
    return 'style="font-size:2em;' . $active . '"';
}
