<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Make sure this line is present
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Hash;



class Usercontroller extends Controller 
{
    


   
    public function listuser()
    {
        
        $user = User::orderBy('name','ASC')->get();
         return view('listuser', compact('user'));
        
    }
   public function adduser()
   {
    $roles = Role::orderBy('name','ASC')->get();
     return view('adduser', compact('roles'));

   }
     public function insertuser(Request $request)
    {
           $request->validate([
        'name' => 'required',
        'email' => 'required',
        'passsword' => 'required',

        
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
         $user->password = Hash::make($request->passsword);
        $user->save();
        $user->syncRoles($request->role);
       
            return redirect('listuser');
       
        

    }
     public function edit(Request $request)
    { 
        $id = $request->query('ids');
       
        $user = User::findOrFail($id);
        // $haspermission = $role->permissions->pluck('name');
        // $permissions = Permission::orderBy('name','ASC')->get();
        $roles = Role::orderBy('name','ASC')->get();
        $hasroles = $user->roles->pluck('id');
        return view('useredit', compact('user','roles','hasroles'));
    }
    public function userUpdate(Request $request)
    {
         $mainid = $request->ids;
        $user = User::findOrFail($mainid);
        if($user && $mainid)
        {
        $request->validate([
        'name' => 'required',
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($user->id),
        ],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->syncRoles($request->role);
        return redirect('listuser');
    }
}

public function userdelete(Request $request)
    { 
        $id = $request->query('ids');
        $per = User::where('id', $id)
        ->delete();
          return redirect('listuser');

    }
}