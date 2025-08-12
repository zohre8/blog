<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function single(){
        return view('single');
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }

    public function category(){
        return view('category');
    }

}
