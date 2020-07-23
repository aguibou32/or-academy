@extends('layouts.app2')


@section('content')

{{-- d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm --}}

@include('inc.backend_navbar')

<div class="container">
    <div class="row justify-content-center">
        @include('inc.backend_menu')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h1>Edit {{ $module->module_name }}</h1>
                </div>
                <div class="card-body">
                <form method="POST" action="{{ route('module.update', $module->id) }}" enctype="multipart/form-data" class="p-5 bg-light">
                   
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="module_name">Module Name</label>
                            <input type="text" name="module_name" id="module_name" class="form-control" value="{{$module->module_name}}" placeholder="Example: Module Name">
                        </div>

                        <div class="form-group">
                            <label for="module_code">Module Code</label>
                            <input type="text" name="module_code" id="module_code" class="form-control" value="{{$module->module_code}}" placeholder="Example: Module Code">
                        </div>
                        
                        <div class="form-group">
                            <label for="module_duration">Duration</label>
                            <input type="text" name="module_duration" id="module_duration" class="form-control" value="{{$module->module_duration}}" placeholder="Example: 30 days or 3 months or 1 year" >
                        </div>

                        <div class="form-group">
                            <label for="module_description">Description</label>
                            <textarea name="module_description" id="module_description" class="form-control" cols="30" rows="4" placeholder="Describe the course">{{$module->module_description}}</textarea>
                        </div>
    
                         <div class="form-group">
                            <label for="module_image">Choose picture</label>
                            <input type="file" name="module_image" id="module_image" class="form-control" value="{{$module->module_image}}">
                            
                            @error('module_image')
                            <span class="help text-danger" role="alert">
                                {{$errors->first('module_image')}}
                            </span>
                        @enderror
                       
                        </div>
                        
                        <div class="form-group">
                            <label for="module_lecturer">Select lecturer for this module</label>
                            <select name="module_lecturer" id="module_lecturer" class="form-control dropdown-toggle">
                                @if (count($lecturers)> 0)
                                    @foreach ($lecturers as $lecturer)                                       
                                        <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                                    @endforeach
                                @else
                                   
                                @endif
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <button class="btn btn-primary rounded-0">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'module_description' );
    </script>
@endsection


