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



Route::get('/', 'ContactsController@index');

Route::get('/mapping', 'ContactsController@map_view_page');
Route::get('/gmap', 'ContactsController@geomap');
Route::get('/google_map', 'ContactsController@google_map');

Route::get('/edit/{contactID}', 'ContactsController@edit_contact');
Route::get('/see-details/{cID}', 'ContactsController@view_contact');

Route::post('/edit_contact_details', 'ContactsController@update_contact');
Route::post('/add_contact_details', 'ContactsController@add_contact');

Route::post('/delete_contact', 'ContactsController@delete_contact');
Route::post('/send_mail', 'ContactsController@send_contact_email');
Route::post('/ajax_find_place', 'ContactsController@ajax_find_place');

Route::get('login/google', 'ContactsController@redirectToProvider');
Route::get('login/google/callback', 'ContactsController@handleProviderCallback');