<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    /**
     * Indica quais campos não podem ser preenchidos manualmente pelo usuário
     * @var array
     */
    protected $guarded = ['id'];

    static $rules = [
        'nome' => 'required|min:3|max:150',
        'placa' => 'required|min:7|max:7|unique:carros'
    ];
}
