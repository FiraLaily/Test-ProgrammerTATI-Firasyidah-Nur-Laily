<?php

use App\Http\Controllers\LogController;

Route::resource('log', LogController::class);
Route::get('log/search', [LogController::class, 'search'])->name('log.search');


