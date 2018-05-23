<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;

class UserPostsController extends Controller
{
    
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        return view('user_posts.index', compact('posts'));
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        $post = Post::findOrFail($id);
        
        return view('user_posts.show', compact('post'));
    }

    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
