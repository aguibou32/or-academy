<style>
    .small li:hover {background-color: #D3D3D3; cursor: pointer;}
</style>

<div class="col-md-3" onload="realTimeClock()">            
    <div class="small">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">

                    <div class="row font-weight-bolder">
                        <div class="col">Server Time:</div>
                        <div class="col"><div id="clock"></div></div>
                    </div>
            </div>
            <div class="card-body bg-light">                      
                
                <ul class="list-unstyled ">
                    <li><a href="{{ route('logout') }} class=""
                    
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <span class="fa fa-power-off"></span> <strong>Logout</strong> 
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        </a></li>
                            @csrf
                    </form>
                    <p class="font-weight-bold text-dark">Menu</p>
                                      
                    @can('isAdmin')
                       
                        <li><a href="{{route('pages.welcome')}}" class="text text-dark">Website</a></li>
                        <li><a href="{{route('users.index')}}" class="text text-dark">Users</a></li>
                        <li><a href="{{route('application.index')}}" class="text text-dark">Applications</a></li>
                        <li><a href="{{route('callback.index')}}" class="text text-dark">Callbacks</a></li>
                        <li><a href="{{route('general_notice.index')}}" class="text text-dark">General notices</a></li>
                        <li><a href="{{route('general_notice.create')}}" class="text text-dark">Post General notice</a></li>
                        <li><a href="{{route('module.index')}}" class="text text-dark">Modules</a></li>                            
                                        
                        <hr>
                    @endcan
                    
                    @cannot('isStudent')
                        
                        <li><a href="{{route('notices.create')}}" class="text text-dark">Post Module Notice</a></li> 
                        <li><a href="{{route('notes.create')}}" class="text text-dark">Post Lecture notes</a></li>
                        <li><a href="{{route('practicals.create')}}" class="text text-dark">Post Practical</a></li> 
                        <li><a href="{{route('practicals.create')}}" class="text text-dark">Post Practicals marks</a></li> 
                        <hr>       
                    @endcannot
                    
                    <li><a href="{{route('notices.index')}}" class="text text-dark">Notices board</a></li>
                    <li><a href="{{route('notes.index')}}" class="text text-dark">Lecture notes</a></li>
                    <li><a href="{{ route('practicals.index') }}" class="text text-dark">Practicals</a></li>
                    <li><a class="text text-dark" href="{{ route('password.request')}}">Change password </a></li>
                    
                    {{-- <li><a href="{{route('module.index')}}" class="text text-dark">Show modules</a></li>                             --}}
                    {{-- <li><a href="{{route('notices.index')}}" class="text text-dark">Show Notices</a></li>                             --}}
                    {{-- <li><a href="{{route('courses.create')}}" class="text text-dark">Add Course on website</a></li> --}}
                    {{-- <li><a href="{{route('notices.create')}}" class="text text-dark">Post Notice</a></li>                             --}}
                    {{-- <li><a href="{{route('practicals.index')}}" class="text text-dark">Practicals</a></li> --}}
                    {{-- <li><a href="{{route('practicals.create')}}" class="text text-dark">Add Practical</a></li>                             --}}
                    {{-- <li><a href="{{route('notices.create')}}" class="text text-dark">Post Notice</a></li>                             --}}
                    {{-- <li><a href="" class="text text-dark">Marks</a></li>                             --}}
                    {{-- <li><a href="" class="text text-dark">Notice boards</a></li>                         --}}
                    {{-- <li><a href="" class="text text-dark">Lectures notes</a></li> --}}
                    {{-- <li><a href="" class="text text-dark">Online Exercises</a></li> --}}
                    {{-- <li><a href="" class="text text-dark">Online Exercises</a></li> --}}
                    {{-- <li><a href="" class="text text-dark">Change your details</a></li> --}}
                    {{-- <li><a href="" class="text text-dark">Change your password</a></li> --}}
                    {{-- <li><p class="font-weight-bold">Other</p></li> --}}
                    <hr>
                    <a href=""></a>
                </ul>
            </div>
          </div>    
    </div>   
</div>


<script>
    function realTimeClock(){
        var rtClock = new Date();
        var hours = rtClock.getHours();
        var minutes = rtClock.getMinutes();
        var seconds = rtClock.getSeconds();

        document.getElementById('clock').innerHTML = hours + ":" + minutes + ":" + seconds ;

        var t = setTimeout (realTimeClock, 500);
    }

</script>