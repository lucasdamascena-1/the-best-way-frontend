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

Route::get('/', function () {
    return view('home');
});


Route::get('/carros', function () {
    return view('listarCarros');
});

Route::get('/carros/editar/id-{id}', function () {
    return view('listarCarros');
});

Route::get('/usuarios', function () {
    return view('listarUsuarios');
});

Route::get('/usuarios/editar/id-{id}', function () {
    return view('listarUsuarios');
});

Route::get('/viagem', function () {
    return view('listarViagem');
});

Route::get('/viagem/nova', function () {
    return view('novaViagem');
});

