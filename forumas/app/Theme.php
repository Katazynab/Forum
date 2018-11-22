<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = "themes";

    public function category() {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }


    public function comments() {
        return $this->hasMany('App\Comment', 'theme_id', 'id');
    }
}
