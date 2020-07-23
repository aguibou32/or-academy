@extends('layouts.app2')


@section('content')

{{-- d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm --}}

@include('inc.backend_navbar')

<div class="container">
    <div class="row justify-content-center">
        @include('inc.backend_menu')
        <div class="col-md-9">
            @if (count($practicals)>0)
                @foreach ($practicals as $practical)
                    <div class="card">
                        <div class="card-header">
                            <h4> {{ $practical->practical_name }} ({{ $practical->module->module_name }})</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('practicals.store')}}" enctype="multipart/form-data" class="p-5 bg-light">
                        
                                @csrf
                                
                            </form>
                        </div>
                    </div>
                    <br>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection


