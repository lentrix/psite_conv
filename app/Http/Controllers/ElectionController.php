<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Nomination;
use App\Vote;
use App\Election;

class ElectionController extends Controller
{
    public function index() {
        $election = Election::getActive();

        if($election)
            return view('election.index', compact('election'));

        return view('election.noel');
    }

    public function create() {
        return view('election.create');
    }

    public function store(Request $request) {
        $this->validate($request,[
            'title' => 'required',
            'max_votes' => 'required|numeric'
        ]);

        $el = Election::create([
            'title' => $request['title'],
            'created_by' => $request['created_by'],
            'max_votes' => $request['max_votes'],
            'active' => 1,
            'stage' => 1
        ]);

        return redirect('/election');
    }

    public function adminIndex() {
        $election = Election::getActive();
        return view('election.admin.index',[
            'election' => $election,
            'labels' => [
                '2' => 'Commence Nomination',
                '3' => 'Commence Election',
                '4' => 'Close Election'
            ]
        ]);
    }

    public function adminChangeStage($stage) {
        $election = Election::getActive();
        $election->stage = $stage;
        $election->save();

        return redirect()->back();
    }

    public function nominate(Request $request) {
        if(auth()->user()->nominated)
            return redirect()->back()->with('Error','You have already made a nomination.');

        $this->validate($request, [
            'nominee_user_id' => 'required|numeric',
            'nominator_user_id' =>'required|numeric'
        ]);

        $nomination = new \App\Nomination;
        $nomination->nominee = $request['nominee_user_id'];
        $nomination->by = $request['nominator_user_id'];

        $nomination->save();

        return redirect('/election')->with('Success','You have made a nomination successfully!');
    }

    public function setCandidacy(Request $request) {
        $this->validate($request, [
            'candidate_user_id' => 'required|numeric'
        ]);

        $user = User::find($request['candidate_user_id']);
        $user->candidate = $request['is_candidate'];
        $user->save();

        return redirect()->back();
    }

    public function voteConfirmation(Request $request) {
        $this->validate($request, [
            'voter_user_id' => 'required|numeric',
            'votes' => new \App\Rules\VoteCountRule
        ]);

        if(!$request['votes']) {
            return redirect()->back()->withErrors('You have to select at least one candidate in order to vote. Otherwise, just ignore voting if you wish to abstain.');
        }

        $candidates = [];
        foreach($request['votes'] as $candidate_id) {
            $candidates[] = User::find($candidate_id);
        }

        return view('/election/confirm', [
            'candidates' => $candidates,
            'voter_id' => $request['voter_user_id']
        ]);
    }

    public function vote(Request $request) {
        $this->validate($request, [
            'voter_user_id' => 'required|numeric',
            'candidate_ids' => [new \App\Rules\VoteCountRule]
        ]);

        foreach($request['candidate_ids'] as $cid) {
            Vote::create([
                'voter_id' => $request['voter_user_id'],
                'candidate_id' => $cid
            ]);
        }

        $user = auth()->user();

        $user->voted_on = now();
        $user->save();

        return redirect('/election');
    }
}
