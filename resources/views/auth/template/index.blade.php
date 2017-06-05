<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{$titulo or 'Login | Curso de Laravel 5.1'}}</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/especializati.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/especializati-responsivo.css')}}">
    <link rel="icon" type="image/png" href="{{url('assets/imgs/favicon.png')}}">

    <!--JQuery-->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body class="bg-padrao">

<header>
    <h1 class="oculta">Login | EspecializaTi</h1>
</header>

<section class="login">
    <div class="topo-login">
        <h1 class="titulo-login">{{$titulo or 'Login | Curso de Laravel 5.1'}}</h1>
    </div>

    <div class="conteudo-login">

        @yield('form')

    </div>
</section>


<!-- Modal Recueração de Senha -->
<div class="modal fade" id="recuperarSenha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-padrao2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Recuperar Senha</h4>
            </div>
            <div class="modal-body">
                <form class="form-padrao">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="E-mail">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Recuperar</button>
            </div>
        </div>
    </div>
</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>

    $(function () {
        jQuery('form.form').submit(function () {

            jQuery(".alert-danger").hide();

            var dadosForm = jQuery(this).serialize();

            jQuery.ajax({
                url: jQuery(this).attr('send'),
                type: "POST",
                data: dadosForm,
                beforeSend: iniciaPreloader()
            }).done(function (data) {
                finalizaPreloader();

                if (data == "1") {
                    location.href = "/painel";
                } else {
                    jQuery(".alert-danger").show();
                    jQuery(".alert-danger").html(data);
                }
            }).fail(function () {
                finalizaPreloader();
                alert('Falha ao enviar dados.');
            });

            return false;
        });
    });

    function iniciaPreloader() {
        jQuery(".btn-enviar").attr("disable");
    }

    function finalizaPreloader() {
        jQuery(".btn-enviar").removeAttr("disable");
    }

</script>

@yield('scripts')
</body>
</html>