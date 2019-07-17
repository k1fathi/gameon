<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->action('Admin\AdminController@index');
    }
}
