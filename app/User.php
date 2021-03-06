<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'permissions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isServer()
    {
        if ($this->permissions = 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function isAdmin()
    {
        if ($this->permissions > 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function isSuperAdmin()
    {
        if ($this->permissions > 2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function isBanned()
    {
        foreach($this->bans as $ban)
        {
            if($ban->banneduntil > Carbon::now()->format('Y-m-d H:i:s'))
            {
                return true;
            }
        }
        return false;
    }

    public function actionplayers(){
        return $this->hasMany('App\Actionplayer', 'account_id', 'id');
    }

    public function playerstat(){
        return $this->hasOne('App\Playerstat', 'account_id', 'id');
    }

    public function playerinfo(){
        return $this->hasOne('App\Playerinfo', 'account_id', 'id');
    }

    public function commanderstat(){
        return $this->hasOne('App\Commanderstat', 'account_id', 'id');
    }

    public function votes(){
        return $this->hasMany('App\Vote', 'comm_id', 'id');
    }

    public function v_votes(){
        return $this->hasMany('App\Vote', 'account_id', 'id');
    }

    public function karmas(){
        return $this->hasMany('App\Karma', 'target_id', 'id');
    }

    public function v_karmas(){
        return $this->hasMany('App\Karma', 'account_id', 'id');
    }

    public function badges(){
        return $this->hasMany('App\Badge', 'account_id', 'id');
    }

    //a user can have multiple bans, we're keeping track of expired ones.
    public function bans(){
        return $this->hasMany('App\Ban', 'account_id', 'id');
    }
}
