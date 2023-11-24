<?php

use Illuminate\Support\Facades\Route;



Route::get('/',function() {
    return view('welcome');
});


Route::resource('flights','FlightController',['names' => 'flights']);

Route::get('search','HomeController@search');

Route::get('search-flights','HomeController@searchFlights');

