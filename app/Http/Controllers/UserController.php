<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust;
use App\User;
use App\Role;
use Session;
use Hash;
use LaraFlash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator');
    }

    public function index()
    {   
        // Show users
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('manage.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('manage.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        
        // Validate form
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users'
        ]);

        // Generate password
        if($request->has('password') && !empty($request->password)){
            $password = trim($request->password);
        } else{
            // set the auto password
            $length = 10;
            $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;

        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
            $password = $str;
        }

        $user = new User();
        // Insert User's data into database and save 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        

        if($user->save()){
            $user->syncRoles(explode(',', $request->roles));
            return redirect()->route('users.show', $user->id);
        } else{
            Session::flash('danger', 'Sorry, a problem occured while creating this user.');
            return redirect()->route('users.create');
        }

    }

    public function show($id)
    {
        // Find and show user
        $user = User::where('id', $id)->with('roles')->first();
        return view('manage.users.show', compact('user'));
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::where('id', $id)->with('roles')->first();

       // Get user's role level
        foreach(auth()->user()->roles as $role){
            $role_level = $role['role_level'];
        }

        foreach($user->roles as $user_roles){
            $user_role_level = $user_roles['role_level'];
        }

        // Check if user has role "superadministrator"
        if($role_level == 90){
            return view('manage.users.edit', compact('user', 'roles')); 
            // Check if use has role "administrator"
        } else if ($role_level < 90){
            // Check if user is superadministrator 
            if($user_role_level >= 80){
                 return redirect('/manage/users')->withErrors([

                'message' => 'You have no access to edit this user!'

            ]);
            } else{
                return view('manage.users.edit', compact('user', 'roles')); 
            }
        }



        return view('manage.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // Validate data
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        // Find and update user
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password_options == 'auto'){
            // Set the auto password
            $length = 10;
            $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;

        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
            $user->password = Hash::make($str);

            // Set the maunal password
        } elseif($request->password_options == 'manual'){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Sync role
        $user->syncRoles(explode(',', $request->roles));
        return redirect()->route('users.show', $id);
    }

    public function destroy($id)
    {
        // Find user
        $user = User::findOrFail($id);

         // Get user id
        $user_id = auth()->user()->id;


        // Get user's role level
        foreach(auth()->user()->roles as $role){
            $role_level = $role['role_level'];
        }

        // Check if user has role "superadministrator"
        if($role_level == 90){
            $user->delete();
            return redirect('/manage/users');
            // Redirect if user has another role
        } else{
             return redirect('/manage/users')->withErrors([

                'message' => 'You have no access to delete users!'

            ]);
            }
        }
}
