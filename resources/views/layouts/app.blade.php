<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="{{asset('css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha256-rByPlHULObEjJ6XQxW/flG2r+22R5dKiAoef+aXWfik=" crossorigin="anonymous" />--}}
    @yield('css')
    <!-- Scripts -->
    <!-- Latest compiled and minified JavaScript -->
    {{--<script--}}
            {{--src="http://code.jquery.com/jquery-2.2.4.min.js"--}}
            {{--integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="--}}
            {{--crossorigin="anonymous"></script>--}}
    <!-- Latest compiled and minified JavaScript -->
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.5.2/randomColor.min.js" integrity="sha256-wMQrtOX6Wcd+W3fOZ8JG6NGYqoZfAKZ6yH+DHd+yGwg=" crossorigin="anonymous"></script>
    <script src="{{asset('js/moment.js')}}"></script>
    <script src="{{asset('js/locale/fr.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


    @yield('js')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (!Auth::guest())
                            @can('list sensor')
                            <li><a class="nav-link" href="{{url('/sensors')}}">{{__('menu.my_sensors')}}</a></li>
                            @endcan
                            <li><a class="nav-link" href="{{url('/dashboard/create')}}">{{__('menu.add_dashboard')}}</a></li>
                            @can('create sensor')
                            <li><a class="nav-link" href="{{url('/sensor/add')}}">{{__('menu.add_sensor')}}</a></li>
                            @endcan
                            <li><a class="nav-link" href="{{url('/config')}}">{{__('menu.config')}}</a></li>
                            @role('admin')
                                <li><a class="nav-link" href="{{url('/message')}}">{{__('menu.message')}}</a></li>
                            @endrole
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="nav-item"><a href="{{ route('login') }}">Login</a></li>
                            {{--<li class="nav-item"><a href="{{ route('register') }}">Register</a></li>--}}
                        @else
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a class="dropdown-item" href="{{url('/user')}}">{{__('menu.user_settings')}}</a></li>
                                    @hasrole('admin')
                                    <li><a class="dropdown-item" href="{{url('/role')}}">{{__('menu.user_roles')}}</a></li>
                                    <li><a class="dropdown-item" href="{{url('/permission')}}">{{__('menu.user_permissions')}}</a></li>
                                    <li><a class="dropdown-item" href="{{url('/plugins')}}">{{__('common.plugins')}}</a></li>
                                    @endrole
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
