<?php

namespace App\Http\Controllers\Painel;

use App\Models\Painel\Aluno;
use App\Models\Painel\Matricula;
use App\Models\Painel\Pai;
use App\Models\Painel\Turma;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PainelController extends Controller
{
    public function getIndex()
    {
        $alunos = Aluno::all()->count();
        $pais = Pai::all()->count();
        $turmas = Turma::all()->count();
        $matriculas = Matricula::all()->count();

        return view('painel.home.index', compact('alunos', 'pais', 'turmas', 'matriculas'));
    }

    public function missingMethod($parameters = [])
    {
        return view('painel.404.index');
    }
}
