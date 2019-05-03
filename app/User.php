<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $dates = ['voted_on'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lname', 'fname', 'gender', 'email', 'designation', 'school', 'school_address', 'password', 'tmp_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarPath() {
        if(Storage::exists('public/avatars/' . $this->id . ".png")) {
            return asset("storage/avatars/$this->id.png");
        }
        return asset("storage/avatars/noface.png");
    }

    public function fullName() {
        return $this->lname  . ', ' . $this->fname;
    }

    public function prizes() {
        return $this->hasMany('App\Raffle', 'user_id');
    }

    public static function nonWinners() {
        return DB::table('users')
            ->whereRaw('id NOT IN (SELECT user_id FROM raffles WHERE user_id IS NOT NULL)')
            ->where('active',1)->get();
    }

    public function nominations() {
        return $this->hasMany('App\Nomination', 'nominee');
    }

    public function nomination() {
        return $this->hasOne('App\Nomination', 'by');
    }

    public function nominationCount() {
        return \App\Nomination::where('nominee', $this->id)->count();
    }

    public function votesEarned() {
        return $this->hasMany('App\Vote', 'candidate_id');
    }

    public function votesMade() {
        return $this->hasMany('App\Vote', 'voter_id');
    }

    public static function candidates() {
        return static::where('candidate',1)
            ->where('active', 1)
            ->orderByRaw('lname, fname')
            ->get();
    }

}
