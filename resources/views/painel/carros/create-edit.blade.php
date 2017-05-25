@extends('painel.templates.index')

@section('content')
    <h1>Getão do Carro</h1>

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning">
                {{$error}}
            </div>
        @endforeach
    @endif

    @if (isset($carro))

        {!!Form::open(['url' => "carros/editar/$carro->id", 'files' => true, 'class' => 'form'])!!}

    @else

        {!!Form::open(['url' => 'carros/adicionar', 'files' => true, 'class' => 'form'])!!}

    @endif

    {!!Form::text('nome', $carro->nome ?? null, ['placeholder' => 'Nome do Carro', 'class' => 'form-control form-group'])!!}

    {!!Form::text('placa', $carro->placa ?? null, ['placeholder' => 'Placa do Carro', 'class' => 'form-control form-group'])!!}

    {!!Form::select('id_marca', $marcas, $carro->id_marca ?? null, ['class' => 'form-group'])!!}

    {!!Form::file('file', ['class' => 'form-group'])!!}

    {!!Form::submit('Enviar', ['class' => 'btn btn-default'])!!}

    {!!Form::close()!!}
@endsection