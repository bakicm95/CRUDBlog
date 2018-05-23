<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;


class CommentController extends Controller
{

    public function store(Post $post)
    {
    	if(auth()->user()){

    		$this->validate(request(), [
    		'body' => 'required|min:2'
    		]);

	    	$name = auth()->user()->name;

	    	$post->addComment($name, request('body'));

    		return back();
    	} else{
    		return redirect('/login');
    	}

    	
    }
}
