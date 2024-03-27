<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = ['marca_id', 'nome', 'imagem', 'numero_portas', 'lugares', 'air_bag', 'abs'];

    public function rules()
    {
        return [
            'marca_id' => 'exists:marcas,id',
            'nome' => 'required|unique:modelos,nome,' . $this->id . '|min:3',
            'imagem' => 'required|file|mimes:png,jpg,jpeg',
            'numero_portas' => 'required|integer|digits_between:1,5',
            'lugares' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo [:attribute] é obrigatório.',

            'nome.unique' => 'O [nome] da marca já existe.',
            'nome.min' => 'O [nome] deve ter no mínimo 3 caracteres.',

            'imagem.mimes' => 'A [imagem] precisa ser dos tipos (png, jpg, jpeg).',

            'numero_portas.integer' => 'O [número de portas] deve ter de 1 a 5.',

            'lugares.integer' => 'O [número de lugares] deve ter de 1 a 20.',
        ];
    }

    public function marca()
    {
        return $this->belongsTo('App\Models\Marca');
    }
}
