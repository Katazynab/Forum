<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;

class Comment extends Model
{
    protected $table = "comments";

    public function users() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function themes() {
        return $this->hasOne('App\Theme', 'id', 'theme_id');
    }


    public function likes()
    {
        return $this->morphToMany('App\User', 'likeable')->whereDeletedAt(null);
    }

    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }
}
