<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $metodo_autenticacao): Response
    {
        // if($metodo_autenticacao == 'padrao') {
        //     echo 'Parâmetro de middleware';
        // }

        session_start();

        if(isset($_SESSION['email']) && $_SESSION['nome'] != '') {
            return $next($request);
        } else {
            return redirect('login');
        }
    }
}
