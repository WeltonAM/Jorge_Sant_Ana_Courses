<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function produtosPedido()
    {
        return $this->belongsToMany('App\Models\Produto', 'pedidos_produtos')->withPivot('quantidade');

        // return $this->belongsToMany('App\Models\Produto', 'pedidos_produtos', 'pedido_id', 'produtos_id')->pivot('created_at', 'updated_at');
    }
}
