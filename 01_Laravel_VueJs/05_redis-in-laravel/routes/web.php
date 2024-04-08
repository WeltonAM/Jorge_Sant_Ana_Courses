<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return redirect()->route('principal')->with('msg', 'A página que você tentou acessar não existe.');
});
