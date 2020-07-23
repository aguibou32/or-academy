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
                    <h2>Edit User information </h2>
                </div>
                <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}" class="p-5 bg-light">
                   
                        @csrf
                        @method('PUT')    
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Surname</label>
                            <input type="text" name="surname" id="surname" class="form-control" value="{{ $user->surname }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <select name="profile_type" id="profile_type" class="form-control" data-dependant="state">
                                <option value="Student">Student</option>
                                <option value="Lecturer">Lecturer</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <a href="{{ route('users.index') }}" class="btn btn-warning rounded-0">Discard Changes</a>
                            <button class="btn btn-primary rounded-0">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


