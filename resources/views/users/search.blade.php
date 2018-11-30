@extends('partials.nav')

@section('body')
    <div class="container">
        <h3 class="text-center">Search Result</h3>
        <hr>
        <h3 class="text-center">Users:</h3>
        @if(count($users) > 0)
            <div class="row">
                @foreach($users as $user)
                    <div class="col-sm-3">
                        <p class="lead-details">{{$user->name}}</p>
                        <p class="details">{{$user->email}}</p>
                        @if($user->privilage == 0)
                            <p class="details">Super Admin</p>
                        @endif

                        @if($user->privilage == 1)
                            <p class="details">Manager</p>
                        @endif

                        @if($user->privilage == 2)
                            <p class="details">Employee</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <h4>No Users found</h4>
        @endif
        <hr>
        <h3 class="text-center">Projects:</h3>
        @if(count($projects) > 0)
            <div class="row">
                <br>
                @foreach($projects as $project)
                    <div class="col-sm-3">
                        <a class="lead-details" href="/projects/{{$project->id}}">{{$project->name}}</a>
                        <p class="details">Start Date: {{$project->created_at}}</p>
                    </div>
                @endforeach
            </div>
        @else
            <h4>No Projects found</h4>
        @endif
    </div>
@stop

