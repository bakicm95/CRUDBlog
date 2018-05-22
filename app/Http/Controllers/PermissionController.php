<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use Session;
use App\Role;
use Auth;
use LaratrustRoleTrait;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator');
    }
   
    public function index()
    {
        $permissions = Permission::all();
        return view('manage.permissions.index', compact('permissions'));
    }

   
    public function create()
    {   

        // Check if user is superadministrator
        foreach(auth()->user()->roles as $role){
            $user_role = $role['role_level'];
        }

        if($user_role == 90){
            return view('manage.permissions.create');
        } else{
            return redirect('/manage/permissions')->withErrors([
                'message' => 'You have no access to create permission!'
            ]);
        }

        
    }

    public function store(Request $request)
    {
        // Check for basic type
        if ($request->permission_type == 'basic') {
         $this->validate($request, [          
          'display_name' => 'required|max:255',
          'name' => 'required|max:255|alphadash|unique:permissions,name',
          'description' => 'sometimes|max:255'
      ]);

         // Create permission
         $permission = new Permission();
         $permission->name = $request->name;
         $permission->display_name = $request->display_name;
         $permission->description = $request->description;
         $permission->save();

         Session::flash('success', 'Permission has been successfully added');
         return redirect()->route('permissions.index');

         // If type is "crud"
     } elseif ($request->permission_type == 'crud') {
        $this->validate($request, [
          'resource' => 'required|min:3|max:100|alpha'
      ]);

        $crud = explode(',', $request->crud_selected);
        if (count($crud) > 0) {
          foreach ($crud as $x) {
            $slug = strtolower($x) . '-' . strtolower($request->resource);
            $display_name = ucwords($x . " " . $request->resource);
            $description = "Allows a user to " . strtoupper($x) . ' a ' . ucwords($request->resource);

            // Create permission
            $permission = new Permission();
            $permission->name = $slug;
            $permission->display_name = $display_name;
            $permission->description = $description;
            $permission->save();
        }
        Session::flash('success', 'Permissions were all successfully added');
        return redirect()->route('permissions.index');
        }
    } else {
        return redirect()->route('permissions.create')->withInput();
        }   
    }

  
    public function show($id)
    {   
        // Find and show permission
        $permission = Permission::findOrFail($id);
        return view('manage.permissions.show', compact('permission'));
    }

    
    public function edit($id)
    {
        // Find permission
        $permission = Permission::findOrFail($id);

        // Check if user is superadministrator
        foreach(auth()->user()->roles as $role){
            $user_role = $role['role_level'];
        }

        if($user_role == 90){
            return view('manage.permissions.edit', compact('permission'));
        } else{
            return redirect('/manage/permissions')->withErrors([
                'message' => 'You have no access to edit this permission!'
            ]);
        }

        
    }

    public function update(Request $request, $id)
    {
        // Validte data
        $this->validate($request, [
        'display_name' => 'required|max:255',
        'description' => 'sometimes|max:255'
      ]);

      // Find permission and update
      $permission = Permission::findOrFail($id);
      $permission->display_name = $request->display_name;
      $permission->description = $request->description;
      $permission->save();
      
      Session::flash('success', 'Updated the '. $permission->display_name . ' permission.');
      return redirect()->route('permissions.show', $id);
    }

    public function destroy($id)
    {   
        // Find permission
        $permission = Permission::findOrFail($id);

        // Get user's role level
        foreach(auth()->user()->roles as $role){
            $role_level = $role['role_level'];
        }

        // Check if user has role "superadministrator"
        if($role_level == 90){
            $permission->delete();
            return redirect('/manage/permissions');
            // Redirect if user has another role
        } else{
             return redirect('/manage/permissions')->withErrors([

                'message' => 'You have no access to delete this permission!'

            ]);
        }
    }
}
