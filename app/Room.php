<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'join_hash',
        'owner_id',
        'opponent_id',
        'turn',
        'owner_ships',
        'opponent_ships',
        'owner_fires',
        'opponent_fires',
        'owner_shots',
        'opponent_shots',
        'started_at'
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }
}
