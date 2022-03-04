<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /** Loads user login page */
    public function Login(){
        return view('auth.login');
    }
    
    /** Loads dashboard page */
    public function Index(){
        return view('admin.index');
    }

    /** Logs user out of the system */
    public function Logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
