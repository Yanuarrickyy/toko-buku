<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrialController extends Controller
{
    public function index()
    {
        return view('trial.apa');
    }
}
