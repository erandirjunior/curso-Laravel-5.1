<?php

namespace App\Http\Controllers\Painel;

use App\Models\Painel\Aluno;
use App\Models\Painel\Matricula;
use App\Models\Painel\Turma;
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

        $turmas = Turma::lists('nome', 'id');

        return view('painel.alunos.index', compact('alunos', 'turmas'));
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

        $aluno = $this->aluno->create($dadosForm);

        $matricula = ['id_aluno' => $aluno->id, 'numero' => uniqid($aluno->id)];

        Matricula::create($matricula);

        return 1;
    }

    public function getEditar($id)
    {
        return $this->aluno->find($id)->toJson();
    }

    public function postEditar($id)
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

        $this->aluno->find($id)->update($dadosForm);

        return 1;
    }
}
