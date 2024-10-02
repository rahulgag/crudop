<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Service; // Make sure this line is present
use DB;



class Customer extends Controller 
{
  

        
    
    public function cform()
    {
        if (Auth::guard('merchant')->check() || Auth::guard('customer')->check()) {

            return redirect()->route('dashboard'); 
        }
        return view('customer.form');
    }
    public function customerlogin(Request $req)
    {
        $input = $req->all();
        // dd($input);
        if(Auth::guard('customer')->attempt(['email' => $input['cemail'],'password' => $input['cpass']]))
        {
            return redirect('dashboard');

        }
        else
        {
            return redirect()->back();

        }
       
    }
     public function customerlogout()
        {
            Auth::guard('customer')->logout();
             return redirect('/');
            
        }
    public function addservice()
    {
        $data = Service::all();
        return view('addservice');
        
    }
    public function insertser(Request $req)
    {
           $req->validate([
        'uname' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $service = new Service;
        $service->name = $req->uname;
        
        if ($req->hasFile('image')) {
                $ext = $req->image->getClientOriginalExtension();
                $newFilename = $req->uname . '_' . uniqid() . '.' . $ext;
                $req->image->move(public_path('assets/img/cimages'), $newFilename);
                $service->image = $newFilename;
            }
        $service->save();
        return redirect('dashboard');
    }
    public function serviceedit(Request $request)
    { 
        $id = $request->query('ids');
         $edit_dt = DB::table('service')
        ->select('service.*') 
        ->where('service.id', $id)
        ->first();
        return view('service_edit', compact('edit_dt'));
    }
    public function serviceUpdate(Request $req )
    {
        $mainid = $req->mainid;
        $servicedata = Service::find($mainid);
        if($servicedata && $mainid)
        {
            $servicedata->name = $req->uname;
        
        if ($req->hasFile('image')) {
                $ext = $req->image->getClientOriginalExtension();
                $newFilename = $req->uname . '_' . uniqid() . '.' . $ext;
                $req->image->move(public_path('assets/img/cimages'), $newFilename);
                $servicedata->image = $newFilename;
            }
             $servicedata->save();
             return redirect('dashboard');

        }

        
    }
     public function servicedelete(Request $request)
    { 
        $id = $request->query('ids');
          $service = Service::where('id', $id)
        ->delete();
          return redirect('dashboard');

    }
    public function listservice()
    {
         $services = Service::all();

            return view('listservice', compact('services'));

    }
}
