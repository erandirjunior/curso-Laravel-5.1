<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{$titulo or 'Painel | Curso de Laravel 5.1'}}</title>

    <!-- Latest compiled and minified CSS -->
    {!!HTML::style('assets/css/bootstrap.min.css')!!}

    <!-- Optional theme -->
    {!!HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css')!!}
    {!!HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css')!!}
    {!!HTML::style('assets/painel/css/especializati.css')!!}
    {!!HTML::style('assets/painel/css/especializati-responsivo.css')!!}

    <!--JQuery-->
    {!!HTML::script('assets/js/jquery.js')!!}
</head>
<body class="bg-padrao">

<header>
    <h1 class="oculta">{{$titulo or 'Painel | Curso de Laravel 5.1'}}</h1>
</header>

<section class="painel">
    <h1 class="oculta">Painel | EspecializaTi</h1>

    <div class="topo-painel col-md-12">
        <a href="" class="icon-acoes-painel">
            <i class="fa fa-expand"></i>
        </a>

        {!!HTML::image('assets/imgs/logo-especializati.png', 'EspecializaTi', ['class' => 'logo-painel', 'title' => 'EspecializaTi - Curso de Laravel 5.1'])!!}

        <select class="acoes-painel">
            <option>{{Auth::user()->name}}</option>
            <option class="sair">Sair</option>
        </select>
    </div>
    <!--End Top-->

    <div class="clear"></div>

    <!--Open menu-->

    @include('painel.includes.menu')

    <!--End menu-->

    <section class="conteudo col-md-10">
        <div class="cont">
            @yield('content')
        </div>
    </section>
    <!--End Conteúdo-->
</section>


<!-- Latest compiled and minified JavaScript -->
{!!HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js')!!}
</body>
</html>