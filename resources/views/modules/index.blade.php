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
                    <h1>List of modules</h1>
                </div>
                <div class="card-body">
                  <a class="btn btn-info fa fa-plus" disabled="disabled" style="width: 40px;
                  height: 40px;
                  padding: 6px 0px;
                  margin-bottom: 10px;
                  border-radius: 25px;
                  text-align: center;
                  font-size: 22px;
                  color:aliceblue;
                  line-height: 1.42857; " href="{{route('module.create')}}"></a>
                  <div class="row">
                    <div class="col-md-10 wrap-about py-5 pr-md-4 ftco-animate">@include('inc.messages')</div>
                  </div>
                  <div class="row">                   
                    @if (count($modules)>0)
                        @foreach ($modules as $module)        
                        <div class="col-lg-12 col-md-12 pb-5">
                          <div class="card h-100">
                            <a href="module/{{$module->id}}"><img class="card-img-top" src="{{URL::asset('storage/' . $module->module_image)}}" alt=""></a>
                            <div class="card-body">
                              <h4 class="card-title">
                                <a href="module/{{$module->id}}">{{$module->module_name}}</a>
                              </h4>
                                <h5></h5>
                                <p class="card-text">{!! $module->module_description !!}</p>
                              <p>{{ $module->name}}</p>
                              {{-- <p>{{count($module->students)}} student(s) registered for this module</p> --}}
                            <small><span>module created on: {{$module->created_at}}</span></small>
                            </div>
                            <div class="card-footer">                            
                              <a href="module/{{$module->id}}"><button class="btn btn-sm btn-info">view module</button></a>
                              <a href="{{ route('attach_student_view', $module->id) }}"><button class="tag-cloud-link btn btn-xsmall btn-info btn-sm" data-toggle="modal">Add students to this Module</button></a>
                              <a href="{{ route('detach_student_view', $module->id) }}"><button class="tag-cloud-link btn btn-xsmall btn-warning btn-sm" data-toggle="modal">remove students from this Module</button></a>
                            </div>

                          </div>
                        </div>
                        <br>
                                            
                      @endforeach
                    @else
                        <div class="container alert alert-danger alert-dismissible fade show" role="alert">
                          No module to display yet
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                        
                    @endif
                
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


