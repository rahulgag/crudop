<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Validation\Rule;


class Permissioncontroller extends Controller
{
    public function listper()
    {
        $services = Permission::all();
         return view('listpermission', compact('services'));
        
    }
     public function addper()
    {
        $data = Permission::all();
        return view('addper');
        
    }
    public function insertper(Request $req)
    {
           $req->validate([
        'name' => 'required|unique:permissions',
        ]);
        $per = new Permission;
        $per->name = $req->name;
        $per->save();
        return redirect('listper');
    }
   
     public function peredit(Request $request)
    { 
        $id = $request->query('ids');
         $edit_dt = DB::table('permissions')
        ->select('permissions.*') 
        ->where('permissions.id', $id)
        ->first();
        return view('per_edit', compact('edit_dt'));
    }
    public function perUpdate(Request $req )
    {
        $mainid = $req->mainid;
        $perdata = Permission::find($mainid);
        if($perdata && $mainid)
        {
             $req->validate([
            'name' => [
                'required',
                Rule::unique('permissions')->ignore($mainid), // Ignore current record during validation
            ],
        ]);
            $perdata->name = $req->name;
        
       
             $perdata->save();
             return redirect('listper');

        }

        
    }
    
      public function perdelete(Request $request)
    { 
        $id = $request->query('ids');
        $per = Permission::where('id', $id)
        ->delete();
          return redirect('listper');

    }
    
}
