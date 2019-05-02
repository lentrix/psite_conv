<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DelegationController extends Controller
{
    public function index() {
        return view('delegation.index', ['users'=>\App\User::orderByRaw('lname,fname')->get()]);
    }
}
