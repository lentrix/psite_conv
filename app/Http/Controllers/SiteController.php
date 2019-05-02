<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index() {
        $meta = [
            'active' => \App\User::where('active',1)->count(),
            'total' => \App\User::count()
        ];

        return view('home', compact('meta'));
    }

    public function login() {
        return view('login');
    }

    public function authenticate(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = \App\User::where('email', $request['email'])->first();

        if(!$user->active) return redirect()->back()->withErrors(['message'=>'Your account is not yet active']);

        if(!auth()->attempt(request(['email', 'password']))) {
            return back()->withErrors([
                'message' => 'Invalid user credentials!'
            ]);
        }

        return redirect('/');
    }

    public function logout() {
        auth()->logout();
        return redirect()->home();
    }

    public function home() {
        return view('home');
    }

    public function program() {
        return view('program');
    }

}
