<?php

namespace App\Http\Controllers\Painel;

use App\Models\Painel\Turma;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\StandardController;
use \Illuminate\Validation\Factory;

class TurmaController extends StandardController
{
    protected $model;
    protected $request;
    protected $validator;
    protected $nameView = 'turmas';
    protected $titulo = 'turmas';

    public function __construct(Turma $turma, Request $request, Factory $validator)
    {
        $this->model = $turma;
        $this->request = $request;
        $this->validator = $validator;
    }
}
