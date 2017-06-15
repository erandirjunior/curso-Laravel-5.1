@extends('painel.templates.index')

@section('content')

    <h1 class="titulo-pg-painel">Dashboard</h1>

    <div class="divider"></div>

    <div class="conteudo-listagens">
        <div class="relatorio col-md-3">
            <i class="fa fa-user bg-padrao2 icone-relario"></i>
            <p class="relatorio">Total de Alunos <br /> {{$alunos}}</p>
        </div>
    </div>
    <div class="conteudo-listagens">
        <div class="relatorio col-md-3">
            <i class="icone-relario fa fa-user-secret bg-padrao3"></i>
            <p class="relatorio">Total de Matriculados <br /> {{$matriculas}}</p>
        </div>
    </div>
    <div class="conteudo-listagens">
        <div class="relatorio col-md-3">
            <i class="icone-relario fa fa-users bg-padrao2"></i>
            <p class="relatorio">Total de Pais <br /> {{$pais}}</p>
        </div>
    </div>
    <div class="conteudo-listagens">
        <div class="relatorio col-md-3">
            <i class="icone-relario fa fa-user-times bg-padrao3"></i>
            <p class="relatorio">Total de Turmas <br /> {{$turmas}}</p>
        </div>
    </div>
@endsection