<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Pai extends Model
{
    protected $table = "pais";

    protected $fillable = ['nome', 'email', 'telefone'];

    public $rules = ['nome' => 'required|min:3|max:60', 'email' => 'required|min:10|max:50', 'telefone' => 'required|min:15|max:15'];
}
