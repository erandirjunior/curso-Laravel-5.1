@extends('painel.templates.index')

@section('content')
    <h1>Getão do Carro</h1>

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)

            {{$error}}

        @endforeach
    @endif

    @if (isset($carro))

        {!!Form::open(['url' => "carros/editar/$carro->id"])!!}

    @else

        {!!Form::open(['url' => 'carros/adicionar'])!!}

    @endif

    {!!Form::text('nome', $carro->nome ?? null, ['placeholder' => 'Nome do Carro'])!!}

    {!!Form::text('placa', $carro->placa ?? null, ['placeholder' => 'Placa do Carro'])!!}

    {!!Form::select('id_marca', $marcas, $carro->id_marca ?? null, ['class' => 'form-group'])!!}

    {{--{!!Form::file('file', ['class' => 'form-group'])!!}--}}

    {!!Form::submit('Enviar')!!}

    {!!Form::close()!!}
@endsection