<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
       'user_id',
       'category_id',
       'title',
       'summary',
       'body',
       'slug',
       'published'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function arguments()
    {
        return $this->belongsToMany('App\Argument');
    }

}
