<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Raffle;
use App\User;

class RaffleController extends Controller
{
    public function index() {
        $winners = Raffle::where('user_id','<>',null)
            ->with('winner')->get();
        return view('raffles.index', compact('winners'));
    }

    public function create() {

        $raffles = Raffle::orderBy('drawn_on')->get();
        return view('raffles.create', compact('raffles'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'prize' => 'required',
            'sponsor' => 'required'
        ]);
        for($i=0; $i<$request['number']; $i++)
            $raffle = Raffle::create($request->all());

        return redirect()->back()->with('Success', 'A new prize has been registered.');
    }

    public function draw() {
        $listPrizes = Raffle::prizeList();
        return view('raffles.draw', compact('listPrizes'));
    }

    public function raffleDraw(Request $request) {
        $this->validate($request, [
            'prize' => 'required',
        ]);

        $raffle = Raffle::find($request['prize']);
        if($request['filter']) {
            $users = User::nonWinners();
        }else {
            $users = User::get();
        }

        return view('raffles.raffle-draw', ['raffle'=>$raffle, 'users'=>$users]);
    }

    public function confirm(Request $request) {
        $this->validate($request, [
            'raffle_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        $raffle = Raffle::find($request['raffle_id']);

        $raffle->user_id = $request['user_id'];
        $raffle->drawn_on = now();
        $raffle->save();

        return redirect('/raffle/draw');
    }
}
