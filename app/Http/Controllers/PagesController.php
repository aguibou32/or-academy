<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function welcome()
    {
        //
        return view('pages.welcome')->withToastError('You are not allowed to perfom that action !');
    }

    public function about(){
        return view ('pages.about');
    }

    public function team(){
        return view('pages.team');
    }

    public function application(){
        return view ('pages.application');
    }
}
