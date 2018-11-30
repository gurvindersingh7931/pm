@extends('layout')
@section('content')
<!-- background-color: #00D1B2; -->
<!-- Navigation -->
<nav class="navbar is-fixed-top navbar-static-top is-primary" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <a class="navbar-brand" href="/" style="">
        <p>Project-man</p>    
    </a>

    @if(Auth::check())
    <div class="navbar-item has-dropdown is-hoverable">
        <!-- {{count(Auth::user()->unreadNotifications->where('type', 'App\Notifications\Appointment'))}} -->
        <a class="navbar-item" href="#">
            <span class="icon">
                <i class="fa fa-bell" style="color: green">{{count(Auth::user()->unreadNotifications->where('type', 'App\Notifications\IssueAdded'))}}</i>
            </span>
        </a>
        <div class="navbar-dropdown is-boxed">
            @if(count(Auth::user()->unreadNotifications->where('type', 'App\Notifications\IssueAdded')) > 0)

            @foreach(Auth::user()->unreadNotifications as $notification)

            <!-- For issue added notification -->
            @if($notification->type == App\Notifications\IssueAdded::class)

            {{--href="/tasks/{{$notification['data']['task_id']}}/issues"--}}

            <form method="get" action="/issue/notifications/read/{{ $notification['notifiable_id'] }}/{{$notification['data']['task_id']}}">

                {{ csrf_field() }}

                <input type="submit" class="form-control submitLink" value="New Issue Added: {{$notification['data']['message']}}" style="color: black; border: none">

            </form>

            @endif


            <!-- For comment added notification -->
            @if($notification->type == App\Notifications\CommentAdded::class)

            {{--href="/tasks/{{$notification['data']['task_id']}}/issues"--}}

            <form method="get" action="/comment/notifications/read/{{ $notification['notifiable_id'] }}/{{$notification['data']['issue_id']}}/{{$notification['data']['task_id']}}">

                {{ csrf_field() }}

                <input type="submit" class="navbar-item submitLink form-control" value="Comment added on Issue: {{$notification['data']['issue_title']}} by {{$notification['data']['user_name']}}">

            </form>

            @endif

            @endforeach

            @else
            <a  class="navbar-item" href="#"><p class="h6" style="color: black">No new notifications</p></a>
            @endif
        </div>
    </div>
    @endif

    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <form method="get" action="/search">

                        <div class="input-group custom-search-form">

                            <input type="text" class="form-control" placeholder="Search Users or Projects.." name="q" id="q">
                            <!-- <span class="input-group-btn"> -->
                                <br><br>
                                <button class="button is-primary form-control" type="submit" name="Search">
                                    <i class="fa fa-search"> Search</i>
                                </button>
                                <!-- </span> -->
                                
                            </div>
                        </form>
                        <!-- /input-group -->
                    </li>
                    <li>
<!--                             @if(Auth::user()->privilage == 2)
                                <div class="navbar-item has-dropdown is-hoverable">
                                    <a class="navbar-item" href="/tasks">My Tasks</a>
                                    <div class="navbar-dropdown is-boxed">
                                        <a class="navbar-item" href="/task/create">New Task</a>
                                    </div>
                                </div>
                                @endif -->
                                @if(Auth::user()->privilage == 2)
                                <a class="navbar-item" href="/tasks">My Tasks</a>
                                @endif
                            </li>

                            <li >
                                @if(Auth::user()->privilage == 2)
                                <a class="navbar-item" href="/task/create">Create Task</a>
                                @endif
                            </li>

                            <li >
                                @if(Auth::user()->privilage == 1)
                                <a class="navbar-item" href="/reminders">Create Reminders</a>
                                @endif
                            </li>

                            <li >
                                @if(Auth::user()->privilage == 1)
                                <a class="navbar-item" href="/appointment">Create Appointments</a>
                                @endif
                            </li>

                            <li>
                                @can('create', App\User::class)
                                <a class="navbar-item" href="/users">Manage Users</a>
                                @endcan
                            </li>
                            @if(Auth::user()->privilage != 2 && Auth::user()->privilage != 3 )
                                <li >
                                    <div class="navbar-item has-dropdown is-hoverable">
                                        <a class="navbar-link">Projects</a>
                                        <div class="navbar-dropdown is-boxed">
                                            <a class="navbar-item" href="/projects/create">Create a Project</a>
                                            <a class="navbar-item" href="/projects">All Projects</a>
                                        </div>
                                    </div>
                                </li>

                                <li >
                                    <div class="navbar-item has-dropdown is-hoverable">
                                        <a class="navbar-link">Past Tasks</a>
                                        <div class="navbar-dropdown is-boxed">
                                            <a class="navbar-item" href="/appointments/done">Appointments</a>
                                            <a class="navbar-item" href="/reminders/done">Reminders</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <a class="navbar-item" href="/password">Reset Password</a>
                            </li>
                            <li>
                                <a class="navbar-item" href="/logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>



            <div id="page-wrapper">
                <div class="row has-navbar-fixed-top has-navbar-fixed-bottom">
                    <br><br><br>
                @if(Auth::user()->privilage == 3)
                    <div class="jumbotron jumbotron-fluid">
                      <div class="container">
                        <center><h1 class="display-4 blockedText">You are blocked.</h1>
                        <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> --></center>
                      </div>
                    </div>
                @else
                @yield('body')
                @endif

            </div>
            <!-- /#page-wrapper -->
        </div>

        <style type="text/css">
        li div div a{
            font-size: 150%;
        }
    </style>
