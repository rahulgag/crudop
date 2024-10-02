<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class Merchant extends Controller
{
    public function mform()
    {
                if (Auth::guard('web')->check() || Auth::guard('customer')->check()) {

            return redirect()->route('dashboard'); // Redirect to dashboard
        }
        return view('merchant.form');
    }
    public function merchantlogin(Request $req)
    {
        $input = $req->all();
        if (Auth::guard('web')->attempt(['email' => $input['memail'], 'password' => $input['mpass']])) {
    return redirect('dashboard');
}

        else
        {
            return redirect()->back();

        }
    }
    public function merchantlogout()
    {
         Auth::guard('web')->logout();
             return redirect('/');
    }
}
