<?php

namespace App\Http\Controllers\Painel;

use App\Models\Painel\Aluno;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Illuminate\Validation\Factory;

class AlunoController extends Controller
{
    private $aluno;
    private $request;
    private $validator;

    public function __construct(Aluno $aluno, Request $request, Factory $validator)
    {
        $this->aluno = $aluno;
        $this->request = $request;
        $this->validator = $validator;
    }

    public function getIndex()
    {
        $alunos = $this->aluno->paginate(10);
        return view('painel.alunos.index', compact('alunos'));
    }

    public function postAdicionarAluno()
    {
        $dadosForm = $this->request->all();

        $validator = $this->validator->make($dadosForm, Aluno::$rules);

        if ($validator->fails()) {
            $messages = $validator->messages();

            $displayErrors = '';

            foreach ($messages->all("<p>:message</p>") as $error) {
                $displayErrors .= $error;
            }

            return $displayErrors;
        }

        $this->aluno->create($dadosForm);

        return 1;
    }
}
