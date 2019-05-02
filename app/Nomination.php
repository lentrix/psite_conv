<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nomination extends Model
{
    public function theNominee() {
        return $this->belongsTo('App\User', 'nominee');
    }

    public function nominator() {
        return $this->belongsTo('App\User', 'by');
    }

    public static function list() {
        return User::whereRaw('id IN (SELECT nominee FROM nominations)')
            ->orderByRaw('lname, fname')
            ->with('nominations')
            ->get();
    }
}
