<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function posts() {

        return $this->morphedByMany('App\Post', 'taggble');
    }

    public function videos() {

        return $this->morphedByMany('App\Video', 'taggble');
    }

}
