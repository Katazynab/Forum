<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    public function themes() {
        return $this->hasMany('App\Theme', 'category_id', 'id');
    }

}
