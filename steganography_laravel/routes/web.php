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

Route::resource("/steganographies", "SteganographyController");
Route::resource("/reveals", "RevealController");

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dato', function () {
    //darle a decbin, ord de un string, trata el string como Dec en la tabla ASCII
    $ord = decbin(ord(3));
    //darle a decbin, solo un string, trata el string como Chr de la tabla ASCII
    $noord = decbin(3);
    //darle a decbin, un int, trata el int como Dec de la tabla ASCII
    $cin = decbin(51);
    echo $ord . "<br>";
    echo $noord . "<br>";
    echo $cin . "<br>";
});
