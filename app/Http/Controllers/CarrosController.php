<?php

namespace App\Http\Controllers;

use App\Models\Painel\MarcasCarro;
use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Painel\Carro;
//use Validator;
use Cache;
use Crypt;

class CarrosController extends Controller
{
    private $carro;
    private $request;
    private $validator;

    /**
     * CarrosController constructor.
     * @param $carro
     * @param $request
     */
    public function __construct(Carro $carro, Request $request, \Illuminate\Validation\Factory $validator)
    {
        $this->carro = $carro;
        $this->request = $request;
        $this->validator = $validator;
    }

    public function getIndex()
    {
        // Jeito simplificado de obter dados
        /*$carros = DB::table('carros')->get();*/

        // Obtendo dados por uma model
        //$carros = Carro::get();

        $carros = $this->carro->paginate(2);

        $titulo = "Listagem dos carros";

        // Passado dados para a view
        return view('painel.carros.index', compact('carros', 'titulo'));
    }

    public function getAdicionar()
    {
        $titulo = 'Adicionar novo carro';

        // Busca todas as marcas de carros
        $marcas = MarcasCarro::lists('marca', 'id');

        // Retornando uma view
        return view('painel.carros.create-edit', compact('titulo', 'marcas'));
    }

    public function postAdicionar()
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

        $dadosForm = $this->request->all();

        // Aplica as regras de validação aos devidos campos
        $validator = $this->validator->make($dadosForm, Carro::$rules);

        // verifica se ocorreu algum erro
        if ($validator->fails()) {
            return redirect('carros/adicionar')->withErrors($validator)->withInput();
        }

        $this->carro->create($dadosForm);

        // redireciona para alguma url
        //return redirect('carros/adicionar')->withInput(); // retorna os dados antigos

        return redirect('carros');
    }

    public function getEditar($id)
    {
        $carro = $this->carro->find($id);

        $marcas = MarcasCarro::lists('marca', 'id');


        // Passado dados para a view
        return view('painel.carros.create-edit', compact('carro', 'marcas'));
    }

    public function postEditar($idCarro)
    {
        $dadosForm = $this->request->except('_token');

        $rulesEdit = [
            'nome' => 'required|min:3|max:150',
            'placa' => "required|min:7|max:7|unique:carros,placa,$idCarro"
        ];

        // atualiza determinado dado do banco
        $this->carro->where('id', $idCarro)->update($dadosForm);

        return redirect('carros');
    }

    public function getDeletar($idCarro)
    {
        // busca o dado no banco passado determinado valor
        $carro = $this->carro->find($idCarro);

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
     * @param  array $params [description]
     * @return [type]         [description]
     */
    public function missingMethod($params = array())
    {
        return 'ERRO 404, página não encontrada!';
    }

    public function getListarCarrosCache()
    {
        // chave, valor e tempo de disponibilidade
        /*Cache::put('carros', Carro::all(), 3);

        if (Cache::has('carros')) {
            return 'carro já está no cache';
        }

        // obter valor do cache
        $carros = Cache::get('carros', 'Não existe carros');*/

        // busca determinado valor, caso seja vazio, executa a função
        $carros = Cache::remember('carros', 3, function () {
            return $this->carro->all();
        });

        // Criptografando um valor
        $titulo = Crypt::encrypt('Cache Carros');

        return view('painel.carros.cache', compact('carros', 'titulo'));
    }
}