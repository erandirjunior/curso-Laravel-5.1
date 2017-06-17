<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Classe do Site.
 *
 * Class HomeController
 * @package App\Http\Controllers\Site
 */
class HomeController extends Controller
{
    /**
     * Página Principal.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        return view('site.home.index');
    }

    /**
     * Página de Sobre.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSobre()
    {
        return view('site.sobre.index');
    }

    /**
     * Página de Contato.
     *
     * @return string
     */
    public function getContato()
    {
        return 'Página de contato do site';
    }

    /**
     * Método de erro.
     *
     * @param array $parameters
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function missingMethod($parameters = [])
    {
        return view('site.404.index', compact('parameters'));
    }
}
