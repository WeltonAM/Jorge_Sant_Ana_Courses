<?php

namespace App\Http\Controllers;

use App\Exports\TarefasExport;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class TarefaController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        // if(!auth()->check()) {
        //     return;
        // }

        $usuarioId = auth()->user()->id;

        $tarefas = Tarefa::where('user_id', $usuarioId)->get();

        return view('tarefa.index', ['tarefas' => $tarefas]);
    }

    public function create()
    {
        return view('tarefa.create');
    }

    public function store(Request $request)
    {
        $usuario = auth()->user();

        $dados = $request->all('tarefa', 'data_limite_conclusao');
        $dados['user_id'] = $usuario->id;

        $tarefa = Tarefa::create($dados);

        Mail::to($usuario->email)->send(new NovaTarefaMail($tarefa));

        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    public function edit(Tarefa $tarefa)
    {
        $usuarioId = auth()->user()->id;

        if($tarefa->user_id == $usuarioId) {
            return view('tarefa.edit', ['tarefa' => $tarefa]);
        }

        return view('paginaNaoEncontrada');
    }

    public function update(Request $request, Tarefa $tarefa)
    {
        $usuarioId = auth()->user()->id;

        if($tarefa->user_id == $usuarioId) {
            $tarefa->update($request->all());
            return view('tarefa.show', ['tarefa' => $tarefa]);
        }

        return view('paginaNaoEncontrada');
    }

    public function destroy(Tarefa $tarefa)
    {
        $usuarioId = auth()->user()->id;

        if($tarefa->user_id == $usuarioId) {
            $tarefa->delete();
            return view('tarefa.index');
        }

        return view('paginaNaoEncontrada');
    }

    public function exportacao($ext) {

        $tarefas = auth()->user()->tarefas()->get();

        if($ext == 'pdf') {
            $pdf = Pdf::loadView('tarefa.pdf', ['tarefas' => $tarefas]);
            // $pdf->setPaper('a4', 'portrait');

            return $pdf->download('lista_de_tarefas.pdf');
        }

        $extencoes = [
            'csv',
            'xlsx'
        ];

        if(!in_array($ext, $extencoes)) {
            return view('tarefa.index');
        }

        return Excel::download(new TarefasExport, 'lista_de_tarefas.'.$ext);
    }
}
