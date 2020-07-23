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
            <h3>Practicals</h3>
             
            @if (count($modules)>0)
              @foreach ($modules as $module)

                  @can('isAdmin')
                      @if (count($practicals)>0)
                      <div class="card">
                        <div class="card-header">
                          {{ $module->module_name }}
                        </div>
                      <div class="card-body">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Practical Files</th>                     
                              <th scope="col">Due Date</th>
                              <th scope="col">Solution Files</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                      
                            @foreach ($module->practicals as $practical)
                            <tr>
                              <th scope="row"><a target="_blank" href={{ asset("storage/assets/practicals/$practical->practical_filename") }} class="font-weight-normal text-reset" >{{$practical->practical_name}}</a></th>
                              <td>{{$practical->due_date}}</td>
                              
                                @if ($practical->solution_filename)
                                  <th scope="row"><a target="_blank" href={{ asset("storage/assets/practicals/$practical->solution_filename") }} class="font-weight-normal text-reset">solution</a></th>
                                @else
                                  <th scope="row"><a href="" class="font-weight-normal">No solution available yet</a></th>
                                @endif
                              <td>
                                <form method="POST" action="/practicals/{{$practical->id}}" class="">
                                  <a href="/practicals/{{$practical->id}}/edit" class="fa fa-pencil-square-o fa-lg mr-2 text-warning" ></a>
                                 
                                  @csrf
                                  @method('DELETE')
                                  <button class="fa fa-trash fa-lg text-danger" onclick="return confirm('Do you want to remove this practical?')"></button>
                                  <button><a target="_blank" href="{{ route('add_practical_marks_view', $practical->id) }}">Mark practical</a></button>
                              </form>
                              </td>
      
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      </div>
                      @else
                      <div class="alert alert-info">No practicals yet</div>
                      @endif
                  @endcan

                  @can('isLecturer')

                  @foreach ($module_user as $m_user)
                      @if ($module->id == $m_user->module_id && Auth::user()->id == $m_user->user_id)
                            @if (count($practicals)>0)
                            <div class="card">
                              <div class="card-header">
                                {{ $module->module_name }}
                              </div>
                            <div class="card-body">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Practical Files</th>                     
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Solution Files</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                            
                                  @foreach ($module->practicals as $practical)
                                      <tr>
                                        <th scope="row"><a href={{ asset("storage/assets/practicals/$practical->practical_filename") }} class="font-weight-normal text-reset" >{{$practical->practical_name}}</a></th>
                                        <td>{{$practical->due_date}}</td>
                                        
                                          @if ($practical->solution_filename)
                                            <th scope="row"><a target="_blank" href={{ asset("storage/assets/practicals/$practical->solution_filename") }} class="font-weight-normal text-reset">solution</a></th>
                                          @else
                                            <th scope="row"><a target="_blank" href="" class="font-weight-normal">No solution available yet</a></th>
                                          @endif
                                        <td>
                                          
                                          <form method="POST" action="/practicals/{{$practical->id}}" class="">
                                          
                                            <a href="/practicals/{{$practical->id}}/edit" class="fa fa-pencil-square-o fa-lg mr-2 text-warning" ></a>
                                          
                                            @csrf
                                            @method('DELETE')
                                            <button class="fa fa-trash fa-lg text-danger" onclick="return confirm('Do you want to remove this practical?')"></button>
                                        </form>
                                        </td>
                
                                      </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                            </div>
                            @else
                            <div class="alert alert-info">No practicals yet</div>
                            @endif
                      @endif
                  @endforeach
            @endcan


            @can('isStudent')

                  @foreach ($module_user as $m_user)
                      @if ($module->id == $m_user->module_id && Auth::user()->id == $m_user->user_id)
                            @if (count($practicals)>0)
                            <div class="card">
                              <div class="card-header">
                                {{ $module->module_name }}
                              </div>
                            <div class="card-body font-weight-light">
                              <table class="table">
                                <thead>
                                  <tr class="font-weight-light">
                                    <th scope="col">Practical</th>                     
                                    <th scope="col">Due</th>
                                    <th scope="col">Submit</th>
                                    <th scope="col">Time submitted</th>
                                    <th scope="col">Status</th>
                                    <th>Mark</th>
                                  </tr>
                                </thead>
                                <tbody>
                            
                                  @foreach ($module->practicals as $practical)
                                      <tr>
                                        <th scope="row"><a target="_blank" href={{ asset("storage/assets/practicals/$practical->practical_filename") }} class="font-weight-normal text-reset" >{{$practical->practical_name}}</a></th>
                                        <td>{{$practical->due_date}}</td>
                                         <td>
                                           <form action="POST" action="{{ route('practical_submission.index') }}">
                                            @csrf
                                            <input type="hidden" name="practical_id" id="practical_id" value="{{ $practical->id }}">
                                            <button class="btn btn-primary">test</button>
                                          </form>
                                          
                                          
                                          </a></td>
                                        <td>2020-07-24 18:38:00</td>
                                        <td><p class="text text-danger">not late</p></td>
                                        <td>
                                          
                                          100/100
                                          
                                        </td>
                
                                      </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                            </div>
                            @else
                            <div class="alert alert-info">No practicals yet</div>
                            @endif
                      @endif
                  @endforeach
            @endcan

                 
                 

                


                  

                  <br>

              @endforeach
            @else
                <div class="alert alert-info">no modules</div>
            @endif
        </div>
        
    </div>
</div>
@endsection
<br>

