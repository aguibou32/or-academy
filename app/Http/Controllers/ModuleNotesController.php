<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\ModuleNote;
use App\Module;
use App\User;

use Gate;
use DB;

class ModuleNotesController extends Controller
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
        $notes = ModuleNote::latest()->get();

        $modules = Module::latest()->get();

        $module_user = DB::table('module_user')->get();
        
        return view('module_notes.index')->with('notes', $notes)->with('modules', $modules)
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

        $modules = Module::latest()->get();
        
        $module_user = DB::table('module_user')->get();

        // return $module_user;
        return view('module_notes.create')->with('modules', $modules)->with('module_user', $module_user);
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
        if(!Gate::allows('isAdmin') && !Gate::allows('isLecturer') ){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

        $note = new ModuleNote;
        request()->validate([
            'lecture_name' => ['required', 'string'],
            'module_selected' => 'required',
            'file_name' => ['file', 'mimes:pdf, docx', 'max:5000'],
        ]);

        $module = Module::find(request()->module_selected);

        if (request()->has('file_name')) {
            $module->notes()->create([
                'lecture_name' => request()->lecture_name,
                'file_name' => request('file_name')->store('module_notes', 'public'),
                'link' => request()->link,
            ]);
        }
        else{
            $module->notes()->create([
                'lecture_name' => request()->lecture_name,               
                'link' => request()->link,
            ]);
        }
        

        // return $module->notices;

        return redirect()->route('notes.index')->withToastSuccess('Lecture note Added !');
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
        return redirect()->back();
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
        return redirect()->back();
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
        
        $note = ModuleNote::find($id);
        $note->delete();

        return redirect()->route('notes.index')->withToastSuccess('Lecture note deleted !');
    }
}
