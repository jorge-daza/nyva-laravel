<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'application' => 'NYVA',
        'activity' => 'Actividad 2 - Esquema de BD con Laravel',
        'status' => 'ok',
    ]);
});
