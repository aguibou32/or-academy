@extends('layouts.app2')


@section('content')

<style>
   tr:hover {background-color: #D3D3D3; cursor: pointer;}
   .lecture_name:hover{color:orangered; text-decoration-line: underline;};
   .font-weight-normal:hover{color:orangered; text-decoration-line: underline;};
</style>

@include('inc.backend_navbar')

<div class="container">
    <div class="row">
        @include('inc.backend_menu')
        <div class="col-md-9">
            <h3>Practical submission interface</h3>
             
           <div class="card">
                <div class="card-header">
                    submission for practical {{ $practical->practical_name }} in {{ $practical->module->module_name }}
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('submit_practical', $practical->id) }}" enctype="multipart/form-data" class="p-5 bg-light">
                        
                        @csrf
                        <input type="hidden" name="practical_id" id="practical_id" value="{{ $practical->id }}">

                        <div class="form-group">
                            <input type="file" class="form-control"  @error('practical_submission_file') is-invalid @enderror" value="{{old('practical_submission_file')}}" name="practical_submission_file" id="practical_submission_file">
                        </div> 
                        
                        @error('practical_submission_file')
                            <span class="help text-danger" role="alert">
                                {{$errors->first('practical_submission_file')}}
                            </span>
                        @enderror


                        <div class="form-group">
                            <button class="btn btn-primary rounded-0">Submit</button>
                        </div>

                    </form>
                </div>

            </div>                 

                  
            
        </div>
        
    </div>
</div>
@endsection
<br>

