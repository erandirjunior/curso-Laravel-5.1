<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return 'Home Page do Site';
});

/*Route::get('/contato', function () {
    return 'Página de contato';
});

Route::get('empresa', function () {
    return 'Página empresa';
});

Route::post('/cadastrar/user', function () {
    return 'Cadastrando usuário...';
});

// Define quais tipos de requisição servem para aquela rota
Route::match(['post', 'get'], '/match', function () {
    return 'minha rota match';
});

// Recebe qualquer tipo de requisição
Route::any('any', function () {
    return 'Rota do tipo any';
});


Route::get('/produto', function () {
    return 'Listagem dos produtos';
});

Route::get('produto/adicionar', function () {
    return 'Form de Add Prod';
});

// Rota com parametros e validação
Route::get('produto/editar/{idProd}', function ($idProd) {
    return "Editar o Produto => {$idProd}";
})->where('idProd', '[0-9]+');

// Rota com parametro opcional
Route::get('produto/deletar/{idProd?}', function ($idProd = 'Valor não passado') {
    return "Deletar o Produto => {$idProd}";
});

// Rota com parametros dinâmicos
Route::get('produto/{idProd}/imagem/{idImagem}', function ($idProd, $idImagem) {
    return "Produto => {$idProd} e imagem -> {$idImagem}";
});

// Agrupando rotas
Route::group(['prefix' => 'painel', 'middleware' => 'my-middleware'], function () {

    Route::get('/', function () {
        return view('painel.home.index');
    });

    Route::get('financeiro', function () {
        return view('painel.financeiro.index');
    });

    Route::get('usuarios', function () {
        return 'Usuarios do painel';
    });

});

Route::get('login', function() {
    return 'Formulário de login';
});*/

Route::get('produtos', 'ProdutoController@index');
Route::get('produto/create', 'ProdutoController@create');
Route::post('produto/create', 'ProdutoController@store');
Route::get('produto/{idProd}', 'ProdutoController@show');
/*Route::get('produto/{idProd}/{idCod}', 'ProdutoController@showTwo');*/
Route::get('produto/edit/{idProd}', 'ProdutoController@edit');


Route::controller('/carros', 'CarrosController');

Route::controller('/users', 'UserController');