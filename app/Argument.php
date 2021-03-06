<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Argument extends Model
{

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }

}
