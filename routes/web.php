<?php

use Illuminate\Support\Facades\Route;
use Naykel\Gotime\RouteBuilder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('pages.home', ['title' => 'Welcome']);
})->name('home');

(new RouteBuilder('nav-main'))->create();
(new RouteBuilder('nav-gotime', 'components.layouts.docs'))->create();
(new RouteBuilder('nav-jtb', 'components.layouts.docs'))->create();

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

// (new RouteBuilder('nav-admin'))->create();
