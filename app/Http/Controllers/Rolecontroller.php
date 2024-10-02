<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Validation\Rule;


use Illuminate\Http\Request; 

class Rolecontroller extends Controller
{
    public function listrole()
    {
        $roles = Role::orderBy('name','ASC')->get();
         return view('listrole', compact('roles'));
        
    }
     public function Addrole()
    {
        $permission = Permission::orderBy('name','ASC')->get();

        return view('addroles', compact('permission'));
        
    }
    public function insertrole(Request $request)
    {
           $request->validate([
        'name' => 'required|unique:roles',
        ]);
        $rol = new Role;
        $rol->name = $request->name;
        $rol->save();
        if(!empty($request->permission))
        {
               
            foreach ($request->permission as $name) {
                $rol->givePermissionTo($name);
            }
            return redirect('listrole');
        }
        

    }
   
     public function roleedit(Request $request)
    { 
        $id = $request->query('ids');
        //  $edit_dt = DB::table('roles')
        // ->select('roles.*') 
        // ->where('roles.id', $id)
        // ->first();
        $role = Role::findOrFail($id);
        $haspermission = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name','ASC')->get();
        return view('role_edit', compact('haspermission','permissions','role'));
    }
    public function rolUpdate(Request $req )
    {
        $mainid = $req->ids;
        $role = Role::findOrFail($mainid);
        if($role && $mainid)
        {
             $req->validate([
            'name' => [
                'required',
                Rule::unique('roles')->ignore($mainid), // Ignore current record during validation
            ],
        ]);
            $role->name = $req->name;
             $role->save();

              if(!empty($req->permission))
            {
                $role->syncPermissions($req->permission);
                
            }
            else
            {
                $role->syncPermissions([]);
            }
            return redirect('listrole');


        }


        
    }
      public function roldelete(Request $request)
    { 
        $id = $request->query('ids');
        $per = Role::where('id', $id)
        ->delete();
          return redirect('listrole');

    }
}
