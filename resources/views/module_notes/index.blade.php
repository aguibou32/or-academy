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
            <h3>Course Notes</h3>
             
            @if (count($modules)>0)
              @foreach ($modules as $module)

                  @can('isAdmin')
                      @if (count($notes)>0)
                      <div class="card">
                        <div class="card-header">
                          {{ $module->module_name }}
                        </div>
                      <div class="card-body">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Lecture file</th>
                              <th scope="col">Video Link</th>
                              @cannot('isStudent')
                              <th scope="col">Action</th>
                              @endcannot
                            </tr>
                          </thead>
                          <tbody>
                      
                            @foreach ($module->notes as $note)
                              <tr>
                                @if ($note->file_name != null)
                                    <td scope="row"><a href="{{ asset("storage/" . $note->file_name) }}" target="_blank" class="font-weight-normal text-reset" ><p class="lecturer_name">{{$note->lecture_name}}</p></a></td>
                                @else 
                                <td scope="row"><a href="#" class="font-weight-normal text-reset" ><p class="lecturer_name">{{$note->lecture_name}}</p></a></td>
                                @endif
                                <td>
                                    @if ($note->link != null)
                                        <a href="{{ $note->link }}" target="_blank" >{{ $note->link }}</a>
                                    @endif
                                </td>
                              
                                <td>
                                  <form method="POST" action="{{ route('notes.destroy', $note->id) }}" class="">
                                    @csrf
                                    @method('DELETE')
                                    <button class="fa fa-trash fa-lg text-danger" onclick="return confirm('Do you want to remove this lecture note?')"></button>
                                  </form>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      </div>
                      @else
                      <div class="alert alert-info">No notes yet</div>
                      @endif
                  @endcan

                 
                  @can('isLecturer')

                        @foreach ($module_user as $m_user)
                            @if ($module->id == $m_user->module_id && Auth::user()->id == $m_user->user_id)
                                  @if (count($notes)>0)
                                  <div class="card">
                                    <div class="card-header">
                                      {{ $module->module_name }}
                                    </div>
                                  <div class="card-body">
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th scope="col">Lecture file</th>
                                          <th scope="col">Video Link</th>
                                          @cannot('isStudent')
                                          <th scope="col">Action</th>
                                          @endcannot
                                        </tr>
                                      </thead>
                                      <tbody>
                                  
                                        @foreach ($module->notes as $note)
                                        <tr>
                                          @if ($note->file_name != null)
                                              <td scope="row"><a href="{{ asset("storage/" . $note->file_name) }}" target="_blank" class="font-weight-normal text-reset" ><p class="lecturer_name">{{$note->lecture_name}}</p></a></td>
                                          @else 
                                          <td scope="row"><a href="#" class="font-weight-normal text-reset" ><p class="lecturer_name">{{$note->lecture_name}}</p></a></td>
                                          @endif
                                          <td>
                                              @if ($note->link != null)
                                                  <a href="{{ $note->link }}" target="_blank" >{{ $note->link }}</a>
                                              @endif
                                          </td>
                                        
                                          <td>
                                            <form method="POST" action="{{ route('notes.destroy', $note->id) }}" class="">
                                              @csrf
                                              @method('DELETE')
                                              <button class="fa fa-trash fa-lg text-danger" onclick="return confirm('Do you want to remove this lecture note?')"></button>
                                            </form>
                                          </td>
                                        
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                  </div>
                                  @else
                                  <div class="alert alert-info">No notes yet</div>
                                  @endif
                            @endif
                        @endforeach
                  @endcan

                  @can('isStudent')
                        @foreach ($module_user as $m_user)
                            @if ($module->id == $m_user->module_id && Auth::user()->id == $m_user->user_id)

                            @if (count($notes)>0)
                            <div class="card">
                              <div class="card-header">
                                {{ $module->module_name }}
                              </div>
                            <div class="card-body">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Lecture file</th>
                                    <th scope="col">Video Link</th>
                                    @cannot('isStudent')
                                    <th scope="col">Action</th>
                                    @endcannot
                                  </tr>
                                </thead>
                                <tbody>
                            
                                  @foreach ($module->notes as $note)
                                  <tr>
                                    @if ($note->file_name != null)
                                        <td scope="row"><a href="{{ asset("storage/" . $note->file_name) }}" target="_blank" class="font-weight-normal text-reset" ><p class="lecturer_name">{{$note->lecture_name}}</p></a></td>
                                    @else 
                                    <td scope="row"><a href="#" class="font-weight-normal text-reset" ><p class="lecturer_name">{{$note->lecture_name}}</p></a></td>
                                    @endif
                                    <td>
                                        @if ($note->link != null)
                                            <a href="{{ $note->link }}" target="_blank" >{{ $note->link }}</a>
                                        @endif
                                    </td>
                                  
                                  
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                            </div>
                            @else
                            <div class="alert alert-info">No notes yet</div>
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

