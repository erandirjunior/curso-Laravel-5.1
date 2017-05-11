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
}
