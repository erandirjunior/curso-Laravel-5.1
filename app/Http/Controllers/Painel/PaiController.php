<?php

namespace App\Http\Controllers\Painel;

use App\Models\Painel\Pai;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\StandardController;
use \Illuminate\Validation\Factory;

class PaiController extends StandardController\Controller
{
    protected $model;
    protected $request;
    protected $validator;
    protected $nameView = 'pais';
    protected $titulo = 'Pais';

    public function __construct(Pai $pai, Request $request, Factory $validator)
    {
        $this->model = $pai;
        $this->request = $request;
        $this->validator = $validator;
    }

    public function getIndex()
    {
        $data = $this->model->paginate($this->totalItensPorPagina);

        $titulo = $this->titulo;

        return view("painel.{$this->nameView}.index", compact('data', 'titulo'));
    }
}
