<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\ApplicationConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Application;
use Gate;

class ApplicationsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('create', 'store');
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
            return redirect()->back();
        }
        
        $applications = Application::orderBy('created_at', 'desc')->get();

        return view('application.index')->with('applications', $applications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('application.create');
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
        $application = new Application(); // Application here refers to the application model 
        // dd(request()->all());

        request()->validate([
            
            'title' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'phone_number' => 'required',
            'email_address' => 'required',
            'name_on_certificate' => 'required',
            'id_or_passport_number' => 'required',
            'course_apply' => 'required',
            'institution_name' => 'required',
            'year_of_study' => 'required',
            'highest_educational_qualification_name' => 'required',
            'certificate' => 'required|mimes:pdf|max:10000',
            'id_or_passport_document' => 'required|mimes:pdf|max:10000',
            'declaration' => 'required'
            ]);


            if(request()->has('certificate')){            
                // dd(request()->certificate);    
                request()->validate([
                    'certificate' => ['file', 'mimes:pdf', 'max:5000']
                ]);
                $application->certificate = request('certificate')->store('applications/certificates', 'public');
            }

            if(request()->has('id_or_passport_document')){            
                // dd(request()->id_or_passport_document);    
                request()->validate([
                    'id_or_passport_document' => ['file', 'mimes:pdf', 'max:5000']
                ]);
                $application->id_or_passport_document = request('id_or_passport_document')->store('applications/id_or_passport_documents', 'public');
            }
                  
            $application->title = request('title');
            $application->name = request('name');
            $application->surname = request('surname');
            $application->gender = request('gender');
            $application->date_of_birth = request('date_of_birth');
            $application->phone_number = request('phone_number');
            $application->email_address = request('email_address');
            $application->name_on_certificate = request('name_on_certificate');
            $application->id_or_passport_number = request('id_or_passport_number');
            $application->course_apply = request('course_apply');
            $application->institution_name = request('institution_name');
            $application->year_of_study = request('year_of_study');
            $application->highest_educational_qualification_name = request('highest_educational_qualification_name');
            $application->declaration = "acknowledged";

            $application->save();

            $name = request('name');
            $surname = request('surname');
            $course_apply = request('course_apply');

            Mail::to(request('email_address'))->send(new ApplicationConfirmation($name, $surname, $course_apply));

            return redirect()->route('pages.welcome')->withToastSuccess("Your application has been sent !");
    }   
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // locks out anyone who is not administrator
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }

        $application = Application::findOrFail($id);


        return view('application.show')->with('application', $application);
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
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route("application.index");
    }
}
