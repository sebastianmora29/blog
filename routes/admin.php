<?php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\EtiquetaController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::resource('categorias', CategoriaController::class);
Route::resource('posts', PostController::class);
Route::resource('etiquetas', EtiquetaController::class);