<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;
use Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $user = auth()->user();
        $user_id = auth()->user()->id;

        // User's post/posts info
        $posts = Post::where('author_id', $user_id)->paginate(5);

        return view('manage.profile.index', compact('user', 'posts'));
    }

    

    public function create()
    {
        return view('manage.profile.create');
    }


    public function store(Request $request)
    {   
       //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {   
        //
    }

    
    public function update(Request $request, $id)
    {   
        // Find user
        $user = User::findOrFail($id);

        // Validate data
        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|min:6|confirmed'
        ]);

        if (!(Hash::check($request->get('current-password'), $user->password))) {
            // The passwords matches
            return redirect('manage/profile')->withErrors([
                'message' => 'Passwords do not match!'
            ]);
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect('manage/profile')->withErrors([
                'message' => 'New password can not be same as current!'
            ]);
        }

         //Change Password
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect('/manage/profile');
    }

    
    public function destroy($id)
    {
        //
    }
}
