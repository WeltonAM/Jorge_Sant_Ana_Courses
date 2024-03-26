<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $marca = Marca::create($request->all());
        return $marca;
    }

    public function show(Marca $marca)
    {
        //
    }

    public function update(Request $request, Marca $marca)
    {
        //
    }

    public function destroy(Marca $marca)
    {
        //
    }
}
