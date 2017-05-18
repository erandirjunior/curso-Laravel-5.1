@extends('painel.templates.index')

@section('content')
    <h1>{{$titulo}}</h1>

    {{print_r($carros)}}

@endsection