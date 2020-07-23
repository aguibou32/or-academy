<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\GeneralNotice;
use Gate;

class GeneralNoticesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = GeneralNotice::latest()->get();
        return view('general_notices.index')->with('notices', $notices);
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

        return view('general_notices.create');
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

        request()->validate([
            'notice_title' => 'required',
            'notice_body' => 'required',
            
        ]);
        
        return request()->all();
        
        $notice = new GeneralNotice;
        
        $notice->notice_title = request('notice_title');
        $notice->notice_body = request('notice_body');

        $notice->save();

        return redirect()->route('general_notice.index')->withToastSuccess('Notice Posted !');
        
         
        $notice->notice_title = request('notice_title');
        $notice->notice_body = request('notice_body');

        $notice->save();

        return redirect()->route('general_notices.index')->withToastSuccess('Notice Posted !');


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

        $notice = GeneralNotice::findOrFail($id);

        // return $notice->notice_title;


        // return $notice;

        return view('general_notices.edit')->with('notice', $notice);
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

        request()->validate([
            'notice_title' => 'required',
            'notice_body' => 'required',
            
        ]);

        $notice = GeneralNotice::findOrFail($id);
        
        $notice->notice_title = request('notice_title');
        $notice->notice_body = request('notice_body');

        $notice->save();

        return redirect()->route('general_notice.index')->withToastSuccess('Notice Updated !');
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

        $notice = GeneralNotice::find($id);

        $notice->delete();

        return redirect()->route('general_notice.index')->withToastSuccess('Notice Removed !');
    }
}
