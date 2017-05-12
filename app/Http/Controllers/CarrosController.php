<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Painel\Carro;
use Validator;

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

    public function postAdicionar(REQUEST $request)
    {
        // retorna um dado especifico do formulário
        //dd($request->input('nome'));
        
        // retorna todos os dados do formulário
        //dd($request->all());
        
        // retorna somente os dados desejados
        //dd($request->only('nome', 'placa'));
        
        // retorna todos os campos, exceto o desejado
        //dd($request->except('_token'));

        // retorna o tipo de requisição
        //dd($request->method());

        // retorna se a requisição é do tipo desejado
        //dd($request->isMethod('post'));
        
        /*$carro = new Carro();
        $carro->nome = $request->input('nome');
        $carro->placa = $request->input('placa');
        $carro->save();*/

        $dadosForm = $request->all();

        // Regras de validação
        $rules = [
            'nome' => 'required|min:3|max:100',
            'placa' => 'required|min:7|max:7'
        ];

        // Aplica as regras de validação aos devidos campos
        $validator = Validator::make($dadosForm, $rules);

        // verifica se ocorreu algum erro
        if ($validator->fails()) {
            return redirect('carros/adicionar')->withErrors($validator)->withInput();
        }

        Carro::create($dadosForm);

        // redireciona para alguma url
        //return redirect('carros/adicionar')->withInput(); // retorna os dados antigos
        
        return redirect('carros');
    }

    public function getEditar($id)
    {
        $carro = Carro::find($id);


        // Passado dados para a view
        return view('painel.carros.create-edit', compact('carro'));
    }

    public function postEditar(Request $request, $idCarro)
    {
        $dadosForm = $request->except('_token');

        // atualiza determinado dado do banco
        Carro::where('id', $idCarro)->update($dadosForm);

        return redirect('carros');
    }

    public function getDeletar($idCarro)
    {
        // busca o dado no banco passado determinado valor
        $carro = Carro::find($idCarro);

        // remove o dado do banco
        $carro->delete();

        return redirect('carros');
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