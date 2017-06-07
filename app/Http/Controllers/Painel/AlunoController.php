<?php

namespace App\Http\Controllers\Painel;

use App\Models\Painel\Aluno;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AlunoController extends Controller
{
    private $aluno;
    private $request;

    public function __construct(Aluno $aluno, Request $request)
    {
        $this->aluno = $aluno;
        $this->request = $request;
    }

    public function getIndex()
    {
        $alunos = $this->aluno->paginate(10);
        return view('painel.alunos.index', compact('alunos'));
    }
}
