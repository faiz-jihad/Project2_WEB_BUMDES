<?php

use Illuminate\Support\Facades\Route;

Route::get('/Beranda', function () {
    return view('pages.Beranda');
});

Route::get('/about', function () {
    $biodata = [
        "nama" => "Fauzan Maulana",
        "email" => "faizjihad@gmail.com",
        "alamat" => "Jl. Cempaka No. 12",
        "pekerjaan" => "Mahasiswa",
        "umur" => 20,
        "hobi" => "Bermain Game"
    ];
    return view('pages.about', $biodata);
});

Route::get('/about/{id}', function ($id) {
    return view('pages.detail', [
        'Nomor' => $id
    ]);
});

Route::view('/contact', 'pages.contact');
Route::view('/produk', 'pages.produk');
