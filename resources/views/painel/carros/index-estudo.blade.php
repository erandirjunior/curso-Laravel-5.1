<!-- Informa que está estendo o arquivo da outra pasta -->
@extends('painel.templates.index')

<!-- Verifica se determinada váriavel foi passada para a view, caso não foi passada, exibe um valor qualquer -->
{{$titulo or ''}}

@section('slide')
    @parent <!-- Adiciona o conteúdo pai -->
    Conteúdo do slide
@endsection

<!-- Conteúdo no qual deseja incluir no arquivo pai-->
@section('content')
    <h1>Listagem dos carros do painel</h1>

    @forelse ($carros as $carro)
        <p>
            <!-- Utiliza a variavel passado para view -->
            <b>Nome: </b> {{$carro->nome}}
        </p>
        <p>
            <b>Placa: </b> {{$carro->placa}}
        </p>
    @empty
        <p>Nenhum carro cadastrado!</p>
    @endforelse

@endsection