<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Painel\Carro;

class CarrosController extends Controller
{
    public function getIndex()
    {
        // Jeito simplificado de obter dados
        /*$carros = DB::table('carros')->get();*/

        // Obtendo dados por uma model
        $carros = Carro::get();

        $titulo = "Listagem dos carros";

        // Passado dados para a view
        return view('painel.carros.index', compact('carros', 'titulo'));
    }

    public function getAdicionar()
    {
        $titulo = 'Adicionar novo carro';

        // Retornando uma view
        return view('painel.carros.create-edit', compact('titulo'));
    }

    public function getEditar($id)
    {
        // Passado dados para a view
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

    /**
     * Método chamado quando nenhum outro método corresponde ao chamado na rota
     * @param  array  $params [description]
     * @return [type]         [description]
     */
    public function missingMethod($params = array())
    {
        return 'ERRO 404, página não encontrada!';
    }
}