<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class CarrosController extends Controller
{
    public function getIndex()
    {
        $carros = DB::table('carros')->get();

        
        return view('painel.carros.index', compact('carros'));
    }

    public function getAdicionar()
    {
        return view('painel.carros.create-edit');
    }

    public function getEditar($id)
    {
        return view('painel.carros.create-edit', ['idCarro' => $id]);
    }

    public function postEditar($dados)
    {
        return 'Editando o carro...';
    }

    public function getDeletar($idCarro)
    {
        return "Deletando o carro {$idCarro}";
    }

    public function getListaCarrosLuxo()
    {
        return 'Listando os carros de luxo';
    }

    public function missingMethod($params = array())
    {
        return 'ERRO 404, página não encontrada!';
    }
}