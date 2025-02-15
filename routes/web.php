<?php

use Illuminate\Support\Facades\Route;

Route::get('download/{file}', function ($file) {
    $file = storage_path() . '/app/public/' . $file;
    return response()->download($file);
});

Route::get('download/backup', function () {
    $file = database_path() . '/database.sqlite';
    return response()->download($file);
});