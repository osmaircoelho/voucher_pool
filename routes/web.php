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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get( '/', [ 'as' => 'index', 'uses' => 'Vpool\IndexController@index' ] );

Route::get( '/offer/create', [ 'as' => 'offer.create', 'uses' => 'Vpool\SpecialOfferController@create' ] );
Route::post( '/offer/create', 'Vpool\SpecialOfferController@save' );