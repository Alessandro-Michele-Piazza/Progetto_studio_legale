<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/contatti', [PublicController::class, 'contact'])->name('contatti');
Route::post('/contatti', [ContactController::class, 'send'])->name('contatti.send');

// Categorie
Route::get('/categorie/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Articoli
Route::get('/articoli', [ArticleController::class, 'index'])->name('articoli.index');
Route::get('/articoli/crea', [ArticleController::class, 'create'])->name('articoli.create');
Route::get('/articoli/categoria/{category:slug}', [ArticleController::class, 'byCategory'])->name('articoli.categoria');
Route::post('/articoli', [ArticleController::class, 'store'])->name('articoli.store');
Route::get('/articoli/{article}', [ArticleController::class, 'show'])->name('articoli.show');
Route::get('/articoli/{article}/modifica', [ArticleController::class, 'edit'])->name('articoli.edit');
Route::put('/articoli/{article}', [ArticleController::class, 'update'])->name('articoli.update');
Route::delete('/articoli/{article}', [ArticleController::class, 'destroy'])->name('articoli.destroy');

