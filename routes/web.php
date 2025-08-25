<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', HomeController::class);

Route::resource('articles', ArticleController::class)
    ->except(['show']);
