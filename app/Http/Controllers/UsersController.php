<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\User;
use Gate;
use DB;

class UsersController extends Controller
{
    // This where I learned to to implement the following Access Control Level method https://www.youtube.com/watch?v=yKxR8TQrr2A

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::latest()->get();      

        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }
        
        // $lecturers = DB::table('users')->where('profile_type', 'Student')->latest()->get();
        // return $lecturers;

        // Save as above 
        //if(auth()->user()->profile_type != 'Admin'){
        //     return redirect()->back();
        // }

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }
        $user = User::findOrFail($id);
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

        $user = User::findOrFail($id);
        // return request()->all();

        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string'],
            'profile_type' => ['required', 'string', 'max:255'],
        ]);

        $user->name = request('name');
        $user->surname = request('surname');
        $user->email = request('email');
        $user->profile_type = request('profile_type');
        
        $user->save();

        return redirect()->route('users.index')->withToastSuccess('User information updated !');;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }
        

        $user = User::findOrFail($id);

        $user->delete();
        
        return redirect('/users');
        
    }
}
