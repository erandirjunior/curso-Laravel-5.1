<!-- Info    {
rma a qual arquivo deseja utilizar as seções -->
@extends('painel.templates.index')

<p>{!! HTML::link('users/adicionar', 'Cadastrar Novo Usuário')!!}</p>

<!-- Conteúdo no qual deseja incluir no arquivo pai-->
@section('content')
    <h1>Listagem dos usuários do painel </h1>

    @if ($status != '')
        {{$status}}
    @endif

    Total = ({{$users->total()}}) |  Por página = ({{$users->count()}})

    <table class="table table-bordered">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th width="150">Ações</th>
        </tr>

        @forelse ($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{!! HTML::link("users/editar/{$user->id}", 'Editar') !!} {!! HTML::link("users/deletar/{$user->id}", 'Deletar') !!}</td> 
        </p>
        
        @empty
            <p>Nenhum usuário cadastrado!</p>
        @endforelse

    </table>
    

    {!! $users->render()!!}

@endsection