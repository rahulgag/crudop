<?php

namespace App\Http\Controllers;
use App\Models\Service; // Make sure this line is present

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function dashbooard()
    {
            $services = Service::all();

            return view('dashboard', compact('services'));

    }
}
