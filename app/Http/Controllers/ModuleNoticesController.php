<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\ModuleNotice;
use App\Module;

use Gate;
use DB;

class ModuleNoticesController extends Controller
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
        //
        $notices = ModuleNotice::latest()->get();
        $modules = Module::latest()->get();

        $module_user = DB::table('module_user')->get();

        return view('notices_board.index')->with('notices', $notices)
                                          ->with('modules', $modules)
                                          ->with('module_user', $module_user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if(!Gate::allows('isAdmin') && !Gate::allows('isLecturer') ){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

        
        $module_user = DB::table('module_user')->get();
        $modules = Module::latest()->get();
        return view('notices_board.create')->with('modules', $modules)->with('module_user', $module_user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('isAdmin') && !Gate::allows('isLecturer') ){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

        //

        $notice = new ModuleNotice;
        request()->validate([
            'module_selected' => 'required',
            'notice_title' => 'required',
            'notice_body' => 'required',
        ]);

        $module = Module::find(request()->module_selected);

        $module->notices()->create([
            'notice_title' => request()->notice_title,
            'notice_body' => request()->notice_body,
        ]);

        // return $module->notices;

        return redirect()->route('notices.index')->withToastSuccess('Notice Posted !');

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

        if(!Gate::allows('isAdmin') && !Gate::allows('isLecturer') ){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

        $notice = ModuleNotice::find($id);
        

        $modules = Module::latest()->get();

        return view('notices_board.edit')->with('notice', $notice)
                                            ->with('modules', $modules);
        
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
        if(!Gate::allows('isAdmin') && !Gate::allows('isLecturer') ){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }
        

        request()->validate([
            'module_selected' => 'required',
            'notice_title' => 'required',
            'notice_body' => 'required',
        ]);

        
        $notice = ModuleNotice::find($id);
        
      
        $notice->notice_title = request('notice_title');
        $notice->notice_body = request('notice_body');

        $notice->module_id = request('module_selected');

        $notice->save();
        
        return redirect()->route('notices.index')->withToastSuccess('notice updated !');

        // return $module->notices;

       
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
        if(!Gate::allows('isAdmin') && !Gate::allows('isLecturer') ){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

        $notice = ModuleNotice::find($id);
        $notice->delete();

        return redirect()->route('notices.index')->withToastSuccess('Notice removed !');

    }
}
