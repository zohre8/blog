<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaschbordController extends Controller
{
    public function index()
    {
        $user=auth()->user();
        $roles=$user->getRoleNames();
        $permissions = $user->getAllPermissions();


        return view('admin.dashboard',compact(['roles','permissions']));
    }
}
