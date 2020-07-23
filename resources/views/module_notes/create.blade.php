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
                    <h1>Add Lecture Note</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('notes.store')}}" enctype="multipart/form-data" class="p-5 bg-light">
                   
                        @csrf

                        <div class="form-group">
                            <label for="lecture_name">Lecture name </label>
                            <input type="text" name="lecture_name" id="lecture_name" class="form-control @error('lecture_name') is-invalid @enderror" value="{{old('lecture_name')}}" placeholder="lecture 01">
                            
                            @error('lecture_name')
                                <span class="help text-danger" role="alert">
                                    {{$errors->first('lecture_name')}}
                                </span>
                            @enderror
                        </div>
                        
                        @can('isLecturer')
                            <div class="form-group">
                                <label for="module_selected">Select a module</label>
                                <select name="module_selected" id="module_selected" class="form-control dropdown-toggle">
                                    @if (count($modules)> 0)
                                        @foreach ($modules as $module)     
                                            @foreach ($module_user as $m_user)
                                                    @if ($module->id == $m_user->module_id && Auth::user()->id == $m_user->user_id)
                                                        <option value="{{ $module->id }}">{{ $module->module_name }}</option>
                                                    @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endcan



                        @can('isAdmin')
                        <div class="form-group">
                            <label for="module_selected">Select a module</label>
                            <select name="module_selected" id="module_selected" class="form-control dropdown-toggle">
                                @if (count($modules)> 0)
                                    @foreach ($modules as $module)     
                                             <option value="{{ $module->id }}">{{ $module->module_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @endcan
                        
                        <div class="form-group">
                            <label for="file_name">Choose File</label>
                            <input type="file" name="file_name" id="file_name" class="form-control @error('file_name') is-invalid @enderror" value="{{old('file_name')}}">
                            
                            @error('file_name')
                                <span class="help text-danger" role="alert">
                                    {{$errors->first('file_name')}}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="link">Youtube Link</label>
                            <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{old('link')}}" placeholder="youtube link">
                            
                            @error('link')
                                <span class="help text-danger" role="alert">
                                    {{$errors->first('link')}}
                                </span>
                            @enderror
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
@endsection


