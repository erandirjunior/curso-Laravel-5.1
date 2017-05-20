<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Hash;
use Crypt;

class UserController extends Controller
{
    private $request;
    private $user;

    public function __construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }
    public function getIndex()
    {
        $users = User::paginate(2);

        $titulo = "Usuários | Curso de Laravel";

        // Passado dados para a view
        return view('painel.users.index', ['users' => $users, 'ctitulo' => $titulo]);
    }

    public function getAdicionar()
    {
        return view('painel.users.create-edit');
    }

    public function postAdicionar()
    {
        $dadosForm = $this->request->all();

        // Aplica as regras de validação aos devidos campos
        $validator = Validator::make($dadosForm, User::$rules);

        // verifica se ocorreu algum erro
        if ($validator->fails()) {
            return redirect('users/adicionar')->withErrors($validator)->withInput();
        }

        $dadosForm['password'] =  Hash::make($dadosForm['password']);

        $this->user->create($dadosForm)->save();

        
        return redirect('users');
    }

    public function getEditar($id)
    {
        $user = $this->user->find($id);

        $titulo = 'Editar {$user->name} | Gestão do usuário';


        // Passado dados para a view
        return view('painel.users.create-edit', ['user' => $user, 'titulo' => $titulo]);
    }

    public function postEditar($id)
    {
        $dadosForm = $this->request_>all();

        $rules = [
            'name' => 'required|min:3|max:150',
            'email' => 'required|email|max:250|unique:users,email,$id',
            'password' => 'required|min:3|max:20'
        ];

        $validator = Validator::make($dadosForm, User::$rules);

        if ($validator->fails()) {
            return redirect('users/editar/$id')->withErrors($validator)->withInput();
        }

        $dadosForm = $this->request->except('_token');
        $dadosForm['password'] = Crypt::encrypt($dadosForm['password']);

        $this->user->where('id', $id)->update($dadosForm);

        
        return redirect('users');
    }

    public function getDeletar($idUser)
    {
        $this->user->find($idUser)->delete();

        return redirect('users');
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
