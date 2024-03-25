<?php

use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    // ->middleware('verified')
;


Route::resource('/tarefa', 'App\Http\Controllers\TarefaController')
->middleware('auth')
// ->middleware('verified')
;

    Route::get('/exportacao/{ext}', 'App\Http\Controllers\TarefaController@exportacao')->name('tarefa.exportacao');

    Route::get('/mensagem-teste', function() {
    return new MensagemTesteMail;

    // Mail::to('atendimento@jorgesantana.net.br')->send(new MensagemTesteMail());
    // return 'Email enviado com sucesso';
});
