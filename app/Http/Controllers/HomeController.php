<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if(empty(session('city_id')))
            return to_route('record.city');
        return view('home.index');
    }
}
