<?php

namespace App\Http\Controllers\Painel;

use App\Models\Painel\Aluno;
use App\Models\Painel\Carro;
use App\Models\Painel\Matricula;
use App\Models\Painel\Pai;
use App\Models\Painel\Turma;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Defender;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Illuminate\Validation\Factory;

/**
 * Class AlunoController
 * @package App\Http\Controllers\Painel
 */
class AlunoController extends Controller
{
    /**
     * @var int
     */
    private $totalItensPorPagina = 10;
    /**
     * @var Aluno
     */
    private $aluno;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Factory
     */
    private $validator;

    /**
     * AlunoController constructor.
     *
     * @param Aluno   $aluno
     * @param Request $request
     * @param Factory $validator
     */
    public function __construct(Aluno $aluno, Request $request, Factory $validator)
    {
        $this->aluno = $aluno;
        $this->request = $request;
        $this->validator = $validator;
    }

    /**
     * Método de página inicial.
     * Caso o usuário não tenha permissão de acesso, será redirecionado para uma página de erro.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        if (Defender::hasPermission('alunos.index')) {
            $alunos = $this->aluno->join('matriculas', 'matriculas.id_aluno', '=', 'alunos.id')->join('turmas', 'turmas.id', '=', 'alunos.id_turma')->select('matriculas.numero as matricula', 'alunos.nome', 'alunos.telefone', 'alunos.data_nascimento', 'alunos.id', 'turmas.nome as turma')->paginate($this->totalItensPorPagina);

            $turmas = Turma::lists('nome', 'id');

            $titulo = 'Alunos';

            return view('painel.alunos.index', compact('alunos', 'turmas', 'titulo'));
        } else {
            return view('painel.403.index');
        }
    }

    /**
     * Método para adicionar um Aluno.
     *
     * @return int|string
     */
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

        $dadosForm['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $dadosForm['data_nascimento'])->toDateString();

        $aluno = $this->aluno->create($dadosForm);

        $matricula = ['id_aluno' => $aluno->id, 'numero' => uniqid($aluno->id)];

        Matricula::create($matricula);

        return 1;
    }

    /**
     * Método para retornar dados do Aluno para edição.
     * Retorna os dados em formato JSON.
     *
     * @param $id
     *
     * @return mixed
     */
    public function getEditar($id)
    {
        return $this->aluno->find($id)->toJson();
    }

    /**
     * Método para edição de Alunos.
     * Faz a validação dos dados.
     * Caso não tenha erros, atualiza os dados.
     *
     * @param $id
     *
     * @return int|string
     */
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

        $dadosForm['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $dadosForm['data_nascimento'])->toDateString();

        $this->aluno->find($id)->update($dadosForm);

        return 1;
    }

    /**
     * Método para remoção de Aluno.
     * Quando um aluno é removido, todos os pais referenciados a esse aluno, também são removidos.
     * @param $id
     *
     * @return int
     */
    public function getDeletar($id)
    {
        $aluno = $this->aluno->find($id);

        $aluno->getPais()->detach();

        $aluno->delete();

        return 1;
    }

    /**
     * Método de retorno de Pais.
     * Retorna todos os Pais que podem ser associados a determinado Aluno.
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPais($id)
    {
        $aluno = $this->aluno->find($id);

        $pais = $aluno->getPais()->paginate($this->totalItensPorPagina);

        $titulo = "Pais do aluno: $aluno->nome";

        $paisAdd = Pai::lists('nome', 'id');

        return view('painel.alunos.pais', compact('aluno', 'pais', 'titulo', 'paisAdd', 'id'));
    }

    /**
     * Método para associar um Pai ao Aluno.
     *
     * @param $id
     *
     * @return int
     */
    public  function postAdicionarPai($id)
    {
        $this->aluno->find($id)->getPais()->sync($this->request->get('id_pai'));

        return 1;
    }

    /**
     * Método para exclusão de uma pai de aluno.
     *
     * @param $idAluno
     * @param $idPai
     *
     * @return mixed
     */
    public function getDeletarPai($idAluno, $idPai)
    {
        return $this->aluno->find($idAluno)->getPais()->detach($idPai);
    }

    /**
     * Método de Pesquisar Aluno.
     * Faz uma busca na tabela Aluno buscando por determinado nome.
     *
     * @param string $pesquisa
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPesquisar($pesquisa = '')
    {
        $alunos = $this->aluno->where('nome', 'LIKE', "%{$pesquisa}%")->paginate($this->totalItensPorPagina);

        $turmas = Turma::lists('nome', 'id');

        $titulo = "Resultados da pesquisa: {$pesquisa}";

        return view('painel.alunos.index', compact('alunos', 'turmas', 'pesquisa'));
    }

    /**
     * Método de Pesquisar Pai.
     * Faz uma busca na tabela pais utilizado os dados da tabela alunos_pais buscando por determinado nome.
     *
     * @param $id
     * @param $pesquisa
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPesquisarPais($id, $pesquisa)
    {
        $aluno = $this->aluno->find($id);

        $pais = $aluno->getPais()->where('nome', 'LIKE', "%{$pesquisa}%")->paginate($this->totalItensPorPagina);

        $titulo = "Resultados para a pesquisa: {$pesquisa} | Aluno: {$aluno->nome}";

        $paisAdd = Pai::lists('nome', 'id');

        return view('painel.alunos.pais', compact('aluno', 'pais', 'titulo', 'paisAdd', 'id', 'pesquisa'));
    }
}
