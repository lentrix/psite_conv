<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Election extends Model
{
    public const STAGE_PREP = 1;
    public const STAGE_NOMINATION = 2;
    public const STAGE_ELECTION = 3;
    public const STAGE_RESULT = 4;

    protected $fillable = ['title', 'created_by', 'max_votes', 'stage', 'active'];

    public function creator() {
        return $this->belongsTo('App\User','created_by');
    }

    public static function getActive() {
        return static::where('active', 1)->first();
    }

    public function setActive() {
        //deactivate all else
        DB::table('elections')
            ->where('id','<>', $this->id)
            ->update(['active'=>0]);

        //activate this election
        $this->active = 1;
        $this->save();
    }

    public function stageString() {
        switch($this->stage) {
            case static::STAGE_PREP: return "Preparatory"; break;
            case static::STAGE_NOMINATION: return "Nomination"; break;
            case static::STAGE_ELECTION: return "Election"; break;
            case static::STAGE_RESULT: return "Results";
        }
    }

    public static function results() {
        $candidates = \App\User::candidates();
        $results = [];

        foreach($candidates as $candidate) {
            $results[] = [
                'candidate' => $candidate,
                'votes' => count($candidate->votesEarned)
            ];
        }

        return $results;
    }

    public static function totalVotes() {
        return \App\Vote::count();
    }
}
