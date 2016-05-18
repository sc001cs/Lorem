<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    //

      protected $table = 'posts';

      protected $dates = ['deleted_at'];

      protected $fillable = ['content', 'textsomewhere', 'created_at', 'updated_at', 'deleted_at'];

    public function user() {
     
        return $this->belongsTo('App\User');
    }
}
