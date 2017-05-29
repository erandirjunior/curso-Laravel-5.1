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
     *
     * @param Carro $carro
     * @param Request $request
     * @param \Illuminate\Validation\Factory $validator
     */
    public function __construct(Carro $carro, Request $request, \Illuminate\Validation\Factory $validator)
    {
        $this->carro = $carro;
        $this->request = $request;
        $this->validator = $validator;
    }

    /**
     * Mostra os dados devidamente páginados.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        // Jeito simplificado de obter dados
        /*$carros = DB::table('carros')->get();*/

        // Obtendo dados por uma model
        //$carros = Carro::get();

        $carros = $this->carro->paginate(2);

        $titulo = "Listagem dos carros";

        $marcas = MarcasCarro::lists('marca', 'id');

        // Passado dados para a view
        return view('painel.carros.index', compact('carros', 'titulo', 'marcas'));
    }


    public function getListarViaAjax()
    {
        return view('painel.carros.lista-via-ajax');
    }

    public function getCarrosAjax()
    {
        sleep(3);
        return $this->carro->get()->toJson();
    }

    /**
     * Formulário de cadastro de carros.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdicionar()
    {
        $titulo = 'Adicionar novo carro';

        // Busca todas as marcas de carros
        $marcas = MarcasCarro::lists('marca', 'id');

        // Retornando uma view
        return view('painel.carros.create-edit', compact('titulo', 'marcas'));
    }

    /**
     * Faz o cadastro de carros.
     * Verifica se existe algum arquivo enviado.
     * Valida os campos.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postAdicionar()
    {
        /*
          // retorna um dado especifico do formulário
         dd($request->input('nome'));

          // retorna todos os dados do formulário
         dd($request->all());

          // retorna somente os dados desejados
         dd($request->only('nome', 'placa'));

          // retorna todos os campos, exceto o desejado
         dd($request->except('_token'));

          // retorna o tipo de requisição
         dd($request->method());

          // retorna se a requisição é do tipo desejado
         dd($request->isMethod('post'));

         $carro = new Carro();
         $carro->nome = $request->input('nome');
         $carro->placa = $request->input('placa');
         $carro->save();*/

        $dadosForm = $this->request->except('file');

        // Aplica as regras de validação aos devidos campos
        $validator = $this->validator->make($dadosForm, Carro::$rules);

        // verifica se ocorreu algum erro
        if ($validator->fails()) {
            return redirect('carros/adicionar')->withErrors($validator)->withInput();
        }

        // Pega o arquivo
        $file = $this->request->file('file');

        // Verifica se o arquivo existe e se ele é válido, caso for, move o arquivo para determinada pasta
        if ($this->request->hasFile('file') && $file->isValid()) {
            if ($file->getClientMimeType() == "image/jpeg" || $file->getClientMimeType() == "image/png") {
                $file->move('assets/uploads/images', $file->getClientOriginalName());
            }
        }

        $this->carro->create($dadosForm);

        // redireciona para alguma url
        //return redirect('carros/adicionar')->withInput(); // retorna os dados antigos

        return redirect('carros');
    }

    public function postAdicionarViaAjax()
    {


        $dadosForm = $this->request->all();

        // Aplica as regras de validação aos devidos campos
        $validator = $this->validator->make($dadosForm, Carro::$rules);

        // verifica se ocorreu algum erro
        if ($validator->fails()) {
            $messages = $validator->messages();

            $displayErrors = '';

            foreach ($messages->all("<p>:message</p>") as $error) {
                $displayErrors .= $error;
            }

            return $displayErrors;
        }

        $this->carro->create($dadosForm);

        return 1;
    }

    /**
     * Formulário de edição de dados.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditar($id)
    {
        $carro = $this->carro->find($id);

        $marcas = MarcasCarro::lists('marca', 'id');


        // Passado dados para a view
        return view('painel.carros.create-edit', compact('carro', 'marcas'));
    }

    /**
     * Faz a edição de carros.
     * Valida os campos.
     *
     * @param $idCarro
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * Deleta um carro.
     * Exclui o carro pelo id.
     *
     * @param $idCarro
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getDeletar($idCarro)
    {
        // busca o dado no banco passado determinado valor
        $carro = $this->carro->find($idCarro);

        // remove o dado do banco
        $carro->delete();

        return redirect('carros');
    }

    /**
     * Lista os carros de luxo.
     *
     * @return string
     */
    public function getListaCarrosLuxo()
    {
        return 'Listando os carros de luxo';
    }

    /**
     * Mátodo invocado caso não exista uma utl válida.
     *
     * @param array $params
     * @return string
     */
    public function missingMethod($params = array())
    {
        return 'ERRO 404, página não encontrada!';
    }

    /**
     * Utilizado para realizar testes de Cache e encriptação.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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