<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match_summ extends Model
{
    const CREATED_AT = 'created_at';

    protected $fillable = [
        'port', 'created_at', 'map', 'server_id'
    ];

    function server(){
        return $this->belongsTo('App\Server', 'server_id', 'id');
    }
}
