@extends('auth.template.index')

@section('form')
<form class="form-padrao form" method="post" action="/resetar-senha">

    <div class="alert alert-danger" role="alert" style="display: none"></div>

    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <input type="text" name="email" class="form-control" placeholder="Usuário">
    </div>

    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Senha">
    </div>

    <div class="form-group">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Senha">
    </div>

    <input type="submit" name="btn-enviar" value="Recuperar Senha" class="btn-padrao btn-enviar">

</form>

@endsection