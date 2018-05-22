<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Auth;
use App\Permission;
use Session;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator');
    }
    
    public function index()
    {
        $roles= Role::all();
        return view('manage.roles.index', compact('roles'));
    }

    public function create()
    {   
        // Get permissions
        $permissions = Permission::all();

        // Check if user is superadmin
        foreach(auth()->user()->roles as $role){
            $user_role = $role['role_level'];
        }

        if($user_role == 90){
            return view('manage.roles.create', compact('permissions'));
        } else{
            return redirect("/manage/roles")->withErrors([
                'message' => 'You have no access to create role!'
            ]);
        }        
    }

   
    public function store(Request $request)
    {
            // Validate data
            $this->validate($request, [
            'display_name' => 'required|max:255',
            'name' => 'required|max:100|alpha_dash|unique:roles,name',
            'description' => 'sometimes|max:255'
         ]);

            // Create role
            $role = new Role();
            $role->display_name = $request->display_name;
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();

            // Sync permissions
            if($request->permissions){
                $role->syncPermissions(explode(',', $request->permissions));
            }

            Session::flash('success', 'Successfully created the new ' . $role->display_name . ' role in the database.');
            return redirect()->route('roles.show', $role->id);
    
        }

    public function show($id)
    {   
        // Show roles
         $role = Role::where('id', $id)->with('permissions')->first();
         return view('manage.roles.show', compact('role'));
    }

   
    public function edit($id)
    {   
         // Find role and get permissions
         $role = Role::where('id', $id)->with('permissions')->first();
         $permissions = Permission::all();

         // Check if user is superadministrator
         foreach(auth()->user()->roles as $item){
            $user_role = $item['role_level'];
        }

        if($user_role == 90){
            return view('manage.roles.edit', compact('role', 'permissions'));
        } else{
            return redirect('/manage/roles')->withErrors([
                'message' => 'You have no acces to edit this role!'
            ]);
        }

        
    }

    public function update(Request $request, $id)
    {
        // Validate data
        $this->validate($request, [
            'display_name' => 'required|max:255',
            'description' => 'sometimes|max:255'
        ]);

        // Find and update role
        $role = Role::findOrFail($id);
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        // Sync permissions
        if($request->permissions){
            $role->syncPermissions(explode(',', $request->permissions));
        }

        Session::flash('success', 'Successfully update the ' . $role->display_name . ' role in the database.');
        return redirect()->route('roles.show', $id);
        
    }

    public function destroy($id)
    {
        // Get role
        $role = Role::findOrFail($id);

         // Get role id
        $user_id = auth()->user()->id;


        // Get user's role level
        foreach(auth()->user()->roles as $item){
            $role_level = $item['role_level'];
        }

        // Check if user has role "superadministrator"
        if($role_level == 90){
            $role->delete();
            return redirect('/manage/roles');
            // Redirect if user has another role
        } else{
             return redirect('/manage/roles')->withErrors([

                'message' => 'You have no access to delete role!'

            ]);
        }
    }
}
