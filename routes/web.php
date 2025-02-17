<?php

use Illuminate\Support\Facades\Route;

Route::get('download/{file}', function ($file) {
    if ($file == 'backup') {
        $file = database_path() . '/database.sqlite';
    } else {
        $file = storage_path() . '/app/public/' . $file;
    }

    return response()->download($file);
});
