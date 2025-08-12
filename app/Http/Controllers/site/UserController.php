<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $user=auth()->user();

        return view('dashboard', ['user' => $user]);
    }
}
