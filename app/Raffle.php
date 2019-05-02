<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    protected $fillable = ['prize', 'sponsor'];
    protected $dates = ['drawn_on'];

    public function winner() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function prizeList() {
        return Raffle::where('drawn_on',null)->pluck('prize','id');
    }
}
