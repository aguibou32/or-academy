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
                  <h3 class="text text-secondary">List Of students to remove in {{ $module->module_name }}</h3>
                  <div class="panel-status pull-right">
                  </div>
              </div>
              <div class="card-body">
                <table class="table table-hover small">
                  <thead>
                    <tr>
                      <th scope="col">Name</th>                     
                      <th scope="col">Surname</th>
                      <th scope="col">Person ID</th>
                      <th scope="col">Email</th>
                      
                      <th>Action</th>
                    </tr>
                  </thead>

                  @if (count($students)>0)
                    @foreach ($students as $student)
                    <tbody>
                        <tr>
                            <td>{{$student->name}}</td>
                            <td>{{$student->surname}}</td>
                            <td>{{$student->username}}</td>
                            <td>{{$student->email}}</td>
                        
                            <td>
                            <form  action="{{ route('detach', $student->id) }}" class="">
                                @csrf
                                <input type="hidden" name="module_id" id="module_id" value="{{ $module->id }}">
                                <button class="fa fa-minus fa-lg text-danger" onclick="return confirm('Do you want remove this student from this module ?')"></button>
                            </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                  @else
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        No student to display yet.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  @endif
                  
                </table>
              </div>
          </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')

@endsection




