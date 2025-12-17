<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang', function () {
     return view('tentang');
});


Route::get('/sapa/{nama}', function ($nama) {
    return "Halo!  selamat datang $nama di toko online";

});

Route::get('/sapa/{nama?}', function ($nama='semua') {
    return "Halo! $nama! selamat datang di toko online";

});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
