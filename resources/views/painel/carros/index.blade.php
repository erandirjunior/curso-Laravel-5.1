<!-- Info    {
rma a qual arquivo deseja utilizar as seções -->
@extends('painel.templates.index')

@section('slide')
    @parent <!-- Adiciona o conteúdo pai -->
    Conteúdo do slide
@endsection

<!-- Conteúdo no qual deseja incluir no arquivo pai-->
@section('content')

    <p>{!! HTML::link('carros/adicionar', 'Cadastrar Novo Carro', ['class' => 'btn btn-success'])!!}</p>

    <h1>Listagem dos carros do painel </h1>

    Total = ({{$carros->total()}}) |  Por página = ({{$carros->count()}})

    {!!'<h2>Olá, eu sou um h2</h2>'!!}

    <table class="table table-bordered">
        <tr>
            <th>Nome</th>
            <th>Placa</th>
            <th width="150">Ações</th>
        </tr>

        {{-- Listagem dos carros --}}
        @forelse ($carros as $carro)
            <tr>
                <td>{{$carro->nome}}</td><!-- Utiliza a variavel passado para view -->
                <td>{{$carro->placa}}</td>
                <td>
                    {!! HTML::link("carros/editar/{$carro->id}", 'Editar') !!} {!! HTML::link("carros/deletar/{$carro->id}", 'Deletar') !!}
                </td>
            </tr>


        @empty
            <p>Nenhum carro cadastrado!</p>
        @endforelse
    </table>

    {!! $carros->render()!!}

    {{-- Inclusão da página de captura de e-mail --}}
    @include('painel.includes.email')

@endsection