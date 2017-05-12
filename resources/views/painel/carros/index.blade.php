<!-- Info    {
rma a qual arquivo deseja utilizar as seções -->
@extends('painel.templates.index')

@section('slide')
    @parent <!-- Adiciona o conteúdo pai -->
    Conteúdo do slide
@endsection

<p>{!! HTML::link('carros/adicionar', 'Cadastrar Novo Carro')!!}</p>

<!-- Conteúdo no qual deseja incluir no arquivo pai-->
@section('content')
    <h1>Listagem dos carros do painel</h1>

    {!!'<h2>Olá, eu sou um h2</h2>'!!}

    {{-- Listagem dos carros --}}
    @forelse ($carros as $carro)
        <p><!-- Utiliza a variavel passado para view -->
        <b>Nome:</b> {{$carro->nome}} - ({{$carro->placa}}) {!! HTML::link("carros/editar/{$carro->id}", 'Editar') !!} {!! HTML::link("carros/deletar/{$carro->id}", 'Deletar') !!}
        </p>
        
    @empty
        <p>Nenhum carro cadastrado!</p>
    @endforelse

    {{-- Inclusão da página de captura de e-mail --}}
    @include('painel.includes.email')

@endsection