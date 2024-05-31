<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function index()
    {
       // dump($_ENV);
    }
    public function show($slug)
    {
        // dump($_ENV);
        dump(config('database.connections.mysql.password'));
        return view("catalog.$slug");
    }
}
