<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $guarded = ['id'];

    public static $rules = ['nome' => 'required|min:3|max:60', 'telefone' => 'required|min:11|max:15', 'data_nascimento' => 'required'];
}
