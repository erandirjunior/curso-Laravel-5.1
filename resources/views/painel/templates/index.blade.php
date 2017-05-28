<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{$titulo or 'Curso de Laravel 5.1'}}</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
</head>
<body>
<div class="container">
    @section('slide')
        slide
    @show <!-- Exibe -->

    <!-- é usada para exibir o conteúdo de uma determinada seção -->
    @yield('content')

</div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    {{--Insere os scripts js de forma dinâmica--}}
    @yield('scripts')

</body>
</html>