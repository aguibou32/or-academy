<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Module;
use App\User;
use Gate;
use DB;

class ModulesController extends Controller
{
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
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

       $modules = Module::latest()->get();
      
      

       return view('modules.index')->with('modules', $modules);
                                   
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

        // $lecturers = User::where('profile_type', 'Lecturer')->count();
        // return $lecturers;
        
         $lecturers = DB::table('users')->where('profile_type', 'Lecturer')->where('deleted_at')->latest()->get();
        // return $students;
   

        return view('modules.create')->with('lecturers', $lecturers);
       
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

        // return request('module_image');

        request()->validate([
            'module_name' => ['required', 'string', 'max:255'],
            'module_code' => ['required', 'string', 'max:255'],
            'module_duration' => ['required', 'string'],
            'module_description' => ['required', 'string', 'max:255'],
            'module_lecturer' => ['required', 'string', 'max:255'],
            'module_image' => ['required', 'file', 'image'],
        ]);

        

        $module = new Module;
        $module->module_name = request('module_name');
        $module->module_code = request('module_code');
        $module->module_duration = request('module_duration');
        $module->module_description = request('module_description');
        
        if(request()->has('module_image')){
            
            // return request()->module_image;

            request()->validate([
                'module_image' => ['file', 'image', 'max:5000']
            ]);
            $module->module_image = request('module_image')->store('module images', 'public');
            // Here we are storing the module picture inside storage/public/module imageser. Now we have to remember to link the storage directory and the public directory 
        }   

        $module->save();
        
        $lecturer = User::findOrFail(request('module_lecturer'));
        $module->users()->syncWithoutDetaching($lecturer);

        return redirect()->route('module.index')->withToastSuccess('module added !');
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

        $module = Module::findOrFail($id);

        return view('modules.show')->with('module', $module);

    }

    /**
     * Show the the view for adding students to a module.
     *
     * The id we passed here is the id of the module 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function attach_student($id){

        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

        $students = User::where('profile_type', 'Student')->latest()->get();
        $module = Module::findOrFail($id);
        $module_user = DB::table('module_user')->get();

        return view('modules.attach')->with('students', $students)
                                     ->with('module', $module)
                                     ->with('module_user', $module_user);
    }

    public function detach_student($id){

        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

        $students = User::where('profile_type', 'Student')->latest()->get();
        $module = Module::findOrFail($id);
        $module_user = DB::table('module_user')->get();

        return view('modules.detach')->with('students', $students)
                                     ->with('module', $module)
                                     ->with('module_user', $module_user);
    }


     /**
     * Attach the specified student to a module.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function attach($id){

        // The id we recieving here is the id of the student 
        // Now we have the id of the student the module we can just attach the 2


        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }
        
        $module = Module::findOrFail(request()->module_id);
               
        $student = User::findOrFail($id);

        // $module->users()->attach($student); // this the same as above. 
                                            //the difference is this one will diplicate the same association in database  
    //    $module->users()->sync($student);
       $module->users()->syncWithoutDetaching($student);

       return redirect()->back()->withToastSuccess('student added !');

    }

    public function detach($id){

        // The id we recieving here is the id of the student 
        // Now we have the id of the student the module we can just attach the 2

        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }
        
        $module = Module::findOrFail(request()->module_id);
               
        $student = User::findOrFail($id);

        // $module->users()->attach($student); // this the same as above. 
                                            //the difference is this one will diplicate the same association in database  
    //    $module->users()->sync($student);
       $module->users()->detach($student);

       return redirect()->back()->withToastSuccess('student removed !');

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


        $module = Module::findOrFail($id);
        $lecturers = DB::table('users')->where('profile_type', 'Lecturer')->where('deleted_at', null)->latest()->get();
        return view('modules.edit')->with('module', $module)->with('lecturers', $lecturers);
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
            'module_name' => ['required', 'string', 'max:255'],
            'module_code' => ['required', 'string', 'max:255'],
            'module_duration' => ['required', 'string'],
            'module_description' => ['required', 'string', 'max:255'],
            'module_lecturer' => ['required', 'string', 'max:255'],
            'module_image' => ['required','file', 'image', 'max:5000'],      
        ]);
        
        $module = Module::findOrFail($id);
        $module->module_name = request('module_name');
        $module->module_code = request('module_code');
        $module->module_duration = request('module_duration');
        $module->module_description = request('module_description');
        $module->module_image = request('module_image');

        $lecturer = User::findOrFail(request('module_lecturer'));


        if(request()->has('module_image')){
            
            // return request()->module_image;

            request()->validate([
                'module_image' => ['file', 'image', 'max:5000']
            ]);
            $module->module_image = request('module_image')->store('module images', 'public');
            // Here we are storing the module picture inside storage/public/module imageser. Now we have to remember to link the storage directory and the public directory 
        }   
        $module->save();
        // $module->users()->sync($lecturer);
        $module->users()->syncWithoutDetaching($lecturer);

        return redirect()->route('module.show', $module->id)->withToastSuccess('module updated !');
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


        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()->route('module.index')->withToastSuccess('Module deleted !');
    }
}
