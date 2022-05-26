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


Route::group(['middleware' => ['web']], function() {

	// home page
	Route::get('/', function(){
		return redirect()->route('services');
	});

	// Changes language
	Route::get('/lang/{id}', function($id){
    	session(['lang' => $id]);
		return redirect()->route(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName());
	})->name('lang');

	// services
	Route::get('/pakalpojumi', [ 
		'uses' => 'FrontendController@services', 
		'as' => 'services']);

	// doctors
	Route::get('/arsti', [ 
		'uses' => 'FrontendController@doctors', 
		'as' => 'doctors']);

	// prices
	Route::get('/cenas', [ 
		'uses' => 'FrontendController@prices', 
		'as' => 'prices']);


	// advertising
	Route::get('/akcijas', [ 
		'uses' => 'FrontendController@actions', 
		'as' => 'actions']);

	// contacts
	Route::get('/kontakti', [ 
		'uses' => 'FrontendController@contacts', 
		'as' => 'contacts']);


	Route::post('/update', [
		'uses' => 'FrontendController@updates',
		'as' => 'update']);

	Route::get('/updatePrices', [ 
		'uses' => 'FrontendController@updatePrices', 
		'as' => 'updatePrices']);
		
	Route::post('/updatePricesPost', [ 
		'uses' => 'FrontendController@updatePricesPost', 
		'as' => 'updatePricesPost']);


	// Protected routes
	Route::group(['middleware' => ['auth']], function() {
		// General updates of website
		Route::post('/updates', [
			'uses' => 'FrontendController@update',
			'as' => 'updates']);
		Route::get('/updates', [
			'uses' => 'FrontendController@update',
			'as' => 'updates']);

		// General uploads to website
		Route::post('/upload', [
			'uses' => 'FrontendController@uploadPost',
			'as' => 'uploadPost']);
		
		Route::get('/upload', [ 
			'uses' => 'FrontendController@uploadGet', 
			'as' => 'upload']);

	});



	// Refreshes services/doctors tile
	Route::get('/refresh', ['uses' => 'FrontendController@refresh',
		'as' => 'refresh'
	]);

	// Creates new service/doctor
	Route::get('/create', ['uses' => 'FrontendController@refresh',
		'as' => 'create'
	]);

	// Handels callback form
	Route::post('/callback', [
		'uses' => 'FrontendController@callback',
		'as' => 'callback'
	]);
	Route::get('/callback-reload',[
		'uses' => 'FrontendController@callbackReload',
		'as' => 'callbackReload'
	]);
});
Auth::routes();

