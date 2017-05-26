<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carro extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
