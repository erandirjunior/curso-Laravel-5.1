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


/*Utilizando sessao no route*/
Route::get('sessao/gravar', function() {
    echo "Gravar: Gravando Sessão";

    session(['msg' => 'Gravando sessão no laravel']);
});

Route::get('sessao/exibir', function() {
    $msg = session('msg');
    return $msg;
});

Route::controller('collection', 'CollectionController');

// Enviando e-mail com o laravel
Route::get('email', function() {

    Mail::raw('Mensagem de texto puro', function($m) {
        $m->to('b1346276@mvrht.net', 'Teste')->subject('Enviando emails pelo laravel');
    });

});

// Service Container
Route::get('services', function() {
    dd(App::make('geraLog', [1,2,3,4,5,6,7]));
    //dd(App::make('geraLogInstance'));
    //dd(App::make('geraLogInstanceAut'));

    return '123';
});

/*class LogSistem
{

}*/

// Query Builder DB
Route::get('query-builder', function () {
    //dd(DB::table('carros')->get());
    //dd(DB::table('carros')->first());
    //dd(DB::table('carros')->select('id', 'nome', 'placa')->first());
    //dd(DB::table('carros')->select('id', 'nome', 'placa')->get());
    //dd(DB::table('carros')->select('id', 'nome as nome-carro-luxo', 'placa')->get());
    //$carros = DB::table('carros')->select('id', 'nome as nomeCarroLuxo', 'placa')->get();
    //return $carros[0]->nomeCarroLuxo;
    //dd(DB::table('carros')->where('id', 1)->get());
    //dd(DB::table('carros')->where('id', '<>', 1)->orWhere('id', 1)->get());
    //dd(DB::table('carros')->lists('nome', 'id'));
    //dd(DB::table('carros')->count());
    //dd(DB::table('carros')->where('id', 1)->count());
    //dd(DB::table('carros')->max('nome'));
    //dd(DB::table('carros')->avg('placa'));
    //dd(DB::table('carros')->join('marcas_carro', 'marcas_carro.id','=', 'carros.id_marca')->select('carros.nome', 'carros.placa', 'marcas_carro.marca')->where('marcas_carro.marca', 'BMW')->get());
    //dd(DB::table('carros')->orderBy('nome', 'desc')->get());
    //dd(DB::table('carros')->take(1)->get());
    //dd(DB::table('carros')->insert(['nome' => 'Renault', 'placa' => '874569', 'id_marca' => 3]));
    //dd(DB::table('carros')->where('id', 2)->update(['nome' => 'Renault 2017']));
    dd(DB::table('carros')->where('id', 2)->delete());
});

// ORM Eloquent
Route::get('eloquent', function () {
    //dd(\App\Models\Painel\Carro::get());
    dd(\App\Models\Painel\Carro::first());
});

Route::get('collections', function () {
    //dd(\App\Models\Painel\Carro::get()->toArray());
    dd(\App\Models\Painel\Carro::get()->toJson());
});

// Relacionamentos
Route::get('relacionamentos', function () {
    //dd(\App\Models\Painel\Carro::find('1')->getChassi()->get()->toArray());
    //dd(\App\Models\Painel\Carro::find('1')->getMarca()->get()->toArray());
    dd(\App\Models\Painel\Carro::find('1')->getCores()->get()->toArray());
});

// Mutators
Route::get('mutators', function () {
   $carros = \App\Models\Painel\Carro::get();

   foreach ($carros as $carro) {
       echo "{$carro->nome} <br /> {$carro->placa}";
   }
});