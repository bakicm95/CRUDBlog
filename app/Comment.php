<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	# This property!
    protected $fillable = ['name', 'body'];
    
     public function post()
    {
    	return $this->belongsTo(Post::class);
    }

}
