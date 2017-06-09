@extends('painel.templates.index')

@section('content')

    <h1 class="titulo-pg-painel">Listagem dos Alunos ({{$alunos->count()}}):</h1>

    <div class="divider"></div>

    <div class="col-md-12">

        <form class="form-padrao form-inline padding-20 form-pesquisa" method="post" send="/painel/alunos/pesquisar/">
            <a href="" class="btn-cadastrar" data-toggle="modal" data-target="#modalGestao"><i
                        class="fa fa-plus-circle"></i> Cadastrar</a>
            <input type="text" placeholder="Pesquisa" class="texto-pesquisa">
        </form>

        @if(isset($pesquisa))
            <p>Resultados para a pesquisa:  <b>{{$pesquisa}}</b></p>
        @endif
    </div>

    <table class="table table-hover">
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Data Nascimento</th>
            <th width="100px;"></th>
        </tr>

        @forelse($alunos as $aluno)
            <tr>
                <td>{{$aluno->nome}}</td>
                <td>{{$aluno->telefone}}</td>
                <td>{{$aluno->data_nascimento}}</td>
                <td>
                    <a href='{{url("/painel/alunos/pais/{$aluno->id}")}}' class="edit">
                        <i class="fa fa-users"></i>
                    </a>
                    <a class="edit" onclick="edit('/painel/alunos/editar/{{$aluno->id}}')">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a class="delete" onclick="del('/painel/alunos/deletar/{{$aluno->id}}')">
                        <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Nenhum aluno cadastrado.</td>
            </tr>
        @endforelse
    </table>

    <nav>
        {{$alunos->render()}}
    </nav>




    <!-- Modal Para Gestão de Conteúdo -->
    <div class="modal fade" id="modalGestao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-padrao4">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Gestão de aluno</h4>
                </div>

                <div class="alert alert-warning msg-war" role="alert" style="display: none"></div>
                <div class="alert alert-success msg-suc" role="alert" style="display: none"></div>

                <div class="modal-body">
                    <form class="form-padrao form-gestao" action="/painel/alunos/adicionar-aluno"
                          send="/painel/alunos/adicionar-aluno">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="text" name="nome" class="form-control" placeholder="Nome do Aluno">
                        </div>
                        <div class="form-group">
                            <input type="text" name="telefone" class="form-control" placeholder="Telefone do Aluno">
                        </div>
                        <div class="form-group">
                            <input type="text" name="data_nascimento" class="form-control"
                                   placeholder="Data de Nascimento do Aluno">
                        </div>

                        <div class="form-group">
                            {!! Form::select('id_turma', $turmas, null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="preloader" style="display: none">Enviando os dados, por favor aguarde...</div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection