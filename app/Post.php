<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Post extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	// Add comment
	public function addComment($name, $body)
	{
		$this->comments()->create(compact('name', 'body'));
	}
}
