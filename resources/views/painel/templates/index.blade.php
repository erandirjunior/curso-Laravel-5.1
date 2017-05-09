<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{$titulo or 'Curso de Laravel 5.1'}}</title>
</head>
<body>

    @section('slide')
        slide
    @show <!-- Exibe -->
    
    <!-- é usada para exibir o conteúdo de uma determinada seção -->
    @yield('content')

</body>
</html>