@extends('painel.templates.index')

@section('content')
<h1>Getão do Carro</h1>

    @if (isset($idCarro))
        <p>Exibe o carro: {{$idCarro}}</p>
    @endif

    {!!Form::open(['url' => 'carros/adicionar'])!!}

        {!!Form::text('nome', old('nome'), ['placeholder' => 'Nome do Carro'])!!}

        {!!Form::text('placa', old('placa'), ['placeholder' => 'Placa do Carro'])!!}

        {!!Form::submit('Enviar')!!}


    {!!Form::close()!!}
@endsection