<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class MainController extends Controller
{
    function login() 
    {
        return view('auth.login');
    }

    function register()
    {
        return view('auth.register');
    }
    function welcome()
    {
        return view('welcome');
    }
}
