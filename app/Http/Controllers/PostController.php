<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Post;
use DateTime;
use App\User;
use App\Role;
use App\Permission;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|editor|author');
    }

    public function index()
    {
        // Get user id
        $user_id = auth()->user()->id;

        // Get posts
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $user_posts = Post::where('author_id', $user_id)->orderBy('created_at', 'desc')->get();

        return view('manage.posts.index', compact('posts', 'user_posts'));
        
    }

   
    public function create()
    {
        return view('manage.posts.create');
    }

   
    public function store(Request $request)
    {
        // Validate data
        $this->validate($request, [
            'title' => 'required|min:5',
            'slug' => 'required',
            'content' => 'required|min:10'
        ]);

        $now = new DateTime();

        // Create and save post
        $post = new Post;

        $post->slug = $request->slug;
        $post->author_id = auth()->user()->id;
        $post->author_name = auth()->user()->name;
        $post->title = $request->title;
        $post->excerpt = $request->title;
        $post->content = $request->content;
        $post->published_at = $now;

        if($post->save()){
            Session::flash('success', 'Post created!');
            return redirect()->route('posts.index');
        } else{
            Session::flash('danger', 'Sorry, a problem occured while creating this post.');
            return redirect()->route('posts.create');
        }

    }

   
    public function show($id)
    {   
        // Find and show post
        $post = Post::findOrFail($id);
        return view('manage.posts.show', compact('post'));
    }

    
    public function edit($id)
    {
        // Find post
        $post = Post::findOrFail($id);

        // Get user id
        $user_id = auth()->user()->id;


        // Get user's role level
        foreach(auth()->user()->roles as $role){
            $role_level = $role['role_level'];
        }

        // Check if user has role "superadministrator"
        if($role_level == 90){
            return view('manage.posts.edit', compact('post')); 
            // Check if use has role "administrator"
        } else if ($role_level < 90){
            // Check if user is author of this post
            if($user_id !== $post->author_id){
                 return redirect('/manage/posts')->withErrors([

                'message' => 'You have no access to edit this post!'

            ]);
            } else{
                return view('manage.posts.edit', compact('post')); 
            }
        }

       
        return view('manage.posts.edit', compact('post')); 
        
    }

   
    public function update(Request $request, $id)
    {
        // Validate data
        $this->validate($request, [
            'title' => 'required|min:5',
            'slug' => 'required',
            'content' => 'required|min:10'
        ]);

        $now = new DateTime();

        // Find and update post
        $post = Post::findOrFail($id);

        $post->slug = $request->slug;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->updated_at = $now;

        $post->save();
        return redirect()->route('posts.show', $id);
    }

   
    public function destroy($id)
    {   
        // Find post
        $post = Post::findOrFail($id);

         // Get user id
        $user_id = auth()->user()->id;


        // Get user's role level
        foreach(auth()->user()->roles as $role){
            $role_level = $role['role_level'];
        }

        // Check if user has role "superadministrator"
        if($role_level == 90){
            $post->delete();
            return redirect('/manage/posts');
            // Check if use has role "administrator"
        } else if ($role_level < 90){
            // Check if user is author of this post
            if($user_id !== $post->author_id){
                 return redirect('/manage/posts')->withErrors([

                'message' => 'You have no access to delete this post!'

            ]);
            } else{
                $post->delete();
            return redirect('/manage/posts');
            }
        }
    }

    public function apiCheckUnique(Request $request)
    {
        return json_encode(!Post::where('slug', '=', $request->slug)->exists());
    }
}
