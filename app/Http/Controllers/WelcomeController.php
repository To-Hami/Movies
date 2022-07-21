<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\TruckType;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('auth.login');

    }// end of index

}//end of controller
