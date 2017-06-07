@extends('painel.templates.index')

@section('content')

    <h1 class="titulo-pg-painel">Listagem dos Alunos ({{$alunos->count()}}):</h1>

    <div class="divider"></div>

    <div class="col-md-12">

        <form class="form-padrao form-inline padding-20">
            <a href="" class="btn-cadastrar" data-toggle="modal" data-target="#modalGestao"><i class="fa fa-plus-circle"></i> Cadastrar</a>
            <input type="text" placeholder="Pesquisa">
        </form>
    </div>

    <table class="table table-hover">
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Data Nascimento</th>
            <th width="70px;"></th>
        </tr>

        @forelse($alunos as $aluno)
            <tr>
                <td>{{$aluno->nome}}</td>
                <td>{{$aluno->telefone}}</td>
                <td>{{$aluno->data_nascimento}}</td>
                <td>
                    <a class="edit" data-toggle="modal" data-target="#modalGestao" href="">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a class="delete" href="" data-toggle="modal" data-target="#modalConfirmacaoDeletar">
                        <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">Nenhum aluno cadastrado.</td></tr>
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
                <div class="modal-body">
                    <form class="form-padrao form">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="text" name="nome" class="form-control" placeholder="Nome do Aluno">
                        </div>
                        <div class="form-group">
                            <input type="text" name="telefone" class="form-control" placeholder="Telefone do Aluno">
                        </div>
                        <div class="form-group">
                            <input type="text" name="data_nascimento" class="form-control" placeholder="Data de Nascimento do Aluno">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>

@endsection