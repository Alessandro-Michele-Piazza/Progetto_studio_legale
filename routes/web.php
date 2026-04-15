<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;


Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/contatti', [PublicController::class, 'contact'])->name('contatti');
Route::post('/contatti', [ContactController::class, 'send'])->name('contatti.send')->middleware('throttle:5,1');

// Anteprima email (solo in ambiente locale)
if (app()->environment('local')) {
    Route::get('/email-preview/contatti', function () {
        $data = [
            'nome'       => 'Mario',
            'cognome'    => 'Rossi',
            'email'      => 'mario.rossi@email.it',
            'telefono'   => '+39 333 1234567',
            'area'       => 'civile',
            'area_label' => 'Diritto Civile',
            'messaggio'  => "Buongiorno,\nvorrei richiedere una consulenza in merito a una controversia contrattuale.\nResto in attesa di un Vostro cortese riscontro.",
        ];
        return new \App\Mail\ContactFormMail($data);
    });
}
