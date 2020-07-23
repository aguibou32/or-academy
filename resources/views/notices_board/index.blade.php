@extends('layouts.app2')


@section('content')

{{-- d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm --}}

@include('inc.backend_navbar')

<div class="container">
    <div class="row">
        @include('inc.backend_menu')
        <div class="col-md-9">
            <h1>Notices board</h1>

            @if (count($modules)>0)
                     @foreach ($modules as $module)
                        <br>
                        @can('isAdmin')
                            <h3>{{ $module->module_name}}</h3>
                            @if (count($module->notices)>0)
                                @foreach ($module->notices as $notice)
                                    <div class="card">
                                        <div class="card-header">
                                            <span class="badge badge-secondary">{{$notice->created_at}}</span>
                                            <div class="panel-status pull-right">
                                                <span class=""><span class="fa fa-check text-info" style="color:add the color here;"></span> </span>
                                            </div>
                                                <h4>{{ $notice->notice_title }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <p>{!! $notice->notice_body !!}</p>
                                            <br>
                                            <br>
                                           
                                            {{-- <small class="font-italic"><a href="{{ route('notices.edit', $notice->id) }}">edit this notice</a></small> --}}
                                            <form method="POST" action="{{ route('notices.destroy', $notice->id) }}" class="">
                                                @csrf
                                                @method('DELETE')
                                                <button class="fa fa-trash text-danger pull-right" onclick="return confirm('Do you want to remove this notice ?')"></button>
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                            @else
                                <div class="alert alert-info">No notices yet</div>
                            @endif
                        @endcan

                        
                        @can('isLecturer')
                            @foreach ($module_user as $m_user)
                             @if ($module->id == $m_user->module_id && Auth::user()->id == $m_user->user_id)
                                <h3>{{ $module->module_name}}</h3>
                                    @if (count($module->notices)>0)
                                        @foreach ($module->notices as $notice)
                                            <div class="card">
                                                <div class="card-header">
                                                    <span class="badge badge-secondary">{{$notice->created_at}}</span>
                                                    <div class="panel-status pull-right">
                                                        <span class=""><span class="fa fa-check text-info" style="color:add the color here;"></span> </span>
                                                    </div>
                                                        <h4>{{ $notice->notice_title }}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p>{!! $notice->notice_body !!}</p>
                                                    <br>
                                                    <br>
                                                    
                                                    @cannot('isStudent')
                                                        {{-- <small class="font-italic"><a href="{{ route('notices.edit', $notice->id) }}">edit this notice</a></small> --}}
                                                        <form method="POST" action="{{ route('notices.destroy', $notice->id) }}" class="">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="fa fa-trash text-danger pull-right" onclick="return confirm('Do you want to remove this notice ?')"></button>
                                                        </form>
                                                    @endcannot
                                                </div>
                        
                                            </div>
                                            <br>
                                        @endforeach
                                    @else
                                        <div class="alert alert-info">No notices yet</div>
                                    @endif
                                 @endif
                            @endforeach
                        @endcan

                        @can('isStudent')
                            @foreach ($module_user as $m_user)
                            @if ($module->id == $m_user->module_id && Auth::user()->id == $m_user->user_id)
                            <h3>{{ $module->module_name}}</h3>
                                @if (count($module->notices)>0)
                                    @foreach ($module->notices as $notice)
                                        <div class="card">
                                            <div class="card-header">
                                                <span class="badge badge-secondary">{{$notice->created_at}}</span>
                                                <div class="panel-status pull-right">
                                                    <span class=""><span class="fa fa-check text-info" style="color:add the color here;"></span> </span>
                                                </div>
                                                    <h4>{{ $notice->notice_title }}</h4>
                                            </div>
                                            <div class="card-body">
                                                <p>{!! $notice->notice_body !!}</p>
                                                <br>
                                                <br>                                                
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                @else
                                    <div class="alert alert-info">No notices yet</div>
                                @endif
                                @endif
                            @endforeach
                        @endcan
                     @endforeach
            @else
                <div class="alert alert-info">No modules yet</div>                            
            @endif
        </div>
    </div>
</div>
@endsection
<br>

