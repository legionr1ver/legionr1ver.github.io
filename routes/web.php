<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/campanias/{id}/articulos', function ($id) {
    switch ($id){
        case 1:
            return [
                ['idItmArticulo' => 1, 'codigo' => '10230501001'],
                ['idItmArticulo' => 2, 'codigo' => '10230501002'],
                ['idItmArticulo' => 3, 'codigo' => '10230501003'],
                ['idItmArticulo' => 4, 'codigo' => '10230501004'],
                ['idItmArticulo' => 5, 'codigo' => '10230501005'],
            ];
        case 2:
            return [
                ['idItmArticulo' => 2, 'codigo' => '10230501002'],
                ['idItmArticulo' => 3, 'codigo' => '10230501003'],
                ['idItmArticulo' => 4, 'codigo' => '10230501004'],
            ];
    }
});

Route::fallback(function(){
    return view('index');
});