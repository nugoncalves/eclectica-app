<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

     // VIEW ROUTES

    // LIST VIEW
    public function index() {
        return view('home.index', [
            'baseRoute' => '/home', //BaseRoute
            'title' => 'DashBoard',
        ]);
    }
}
