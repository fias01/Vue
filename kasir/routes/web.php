<?php

Route::get('/', function () {
    return view('welcome');
});

route::resource('/orders', 'OrderController');
