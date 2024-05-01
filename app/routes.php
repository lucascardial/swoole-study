<?php

use Core\Facades\Route;

use TheMembers\Shortner\Http\Controllers\CacheController;
use TheMembers\Shortner\Http\Controllers\DataController;
use TheMembers\Shortner\Http\Controllers\JpController;
use TheMembers\Shortner\Http\Controllers\LeandroController;

Route::get("/data", DataController::class);

Route::get("/cache", CacheController::class);

Route::get("/leandro", LeandroController::class);

Route::get("/jp", JpController::class);