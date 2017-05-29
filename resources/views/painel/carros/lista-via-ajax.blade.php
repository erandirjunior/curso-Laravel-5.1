<!-- Informa a qual arquivo deseja utilizar as seções -->
@extends('painel.templates.index')

<!-- Conteúdo no qual deseja incluir no arquivo pai-->
@section('content')

    <h1>Listagem dos carros via ajax</h1>

    {{--Total = ({{$carros->total()}}) |  Por página = ({{$carros->count()}})--}}

    <table class="table table-bordered">
        <tr>
            <th>Nome</th>
            <th>Placa</th>
        </tr>


    </table>

    <div class="preloader" style="display: none">Listando os dados, por favor aguarde...</div>
@endsection

@section('scripts')

    <script>


        $(function () {
            jQuery.ajax({
                url: "/carros/carros-ajax",
                type: "GET",
                dataType: "JSON",
                beforeSend: inicializaPreloader()
            }).done(function (data) {
                finalizaPreloader();

                jQuery.each(data, function (key, value) {
                   jQuery(".table").append("<tr><td>" + value.nome + "</td><td>" + value.placa + "</td></tr>");
                });
            }).fail(function () {
                finalizaPreloader();
                alert('Fail send data');
            });
        });

        function inicializaPreloader() {
            jQuery(".preloader").show();
        }

        function finalizaPreloader() {
            jQuery(".preloader").hide();
        }

    </script>

@endsection