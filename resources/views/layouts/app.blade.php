<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:title" content="Armenian Sea Battle"/>
    <meta property="og:description" content="Join to Sea Battle and have fun with your friends"/>
    <meta property="og:image" content="{{ asset('img/logo.png') }}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/677fcbda09.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('head-scripts')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;z-index: 1000;">
        <a class="navbar-brand" id="header-logo-link" href="{{ url('/') }}">
            <img id="header-logo-img" src="{{ asset('img/logo_transparent.png') }}" alt="{{ config('app.name', 'Sea-Battle') }}">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <div class="navbar-nav-container" id="navbar">
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i>
                                {{ __('Login') }}
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus"></i>
                                    {{ __('Register') }}
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-home"></i>
                                Home
                            </a>
                        </li>
                    @endguest
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('instructions') }}">
                            <i class="fa fa-chalkboard-teacher icon"></i>
                            Instructions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sea-battle-team') }}">
                            <i class="fas fa-users icon"></i>
                            Sea Battle Team
                        </a>
                    </li>
                    @if(Auth::user())
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="fa fa-envelope icon"></i>
                                Messages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt icon"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</div>
<div id="site-footer" class="card-footer">
    <div class="d-flex flex-row justify-content-around align-items-center">
        Made for fun <br>
        <a href="{{route('sea-battle-team')}}">Sea Battle Team</a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('assets/js/toastr-init.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script>
    @if(session('error'))
        toastr["error"](session('error')['header'], session('error')['message'], {'progressBar': true});
    @endif
        @if(session('success'))
        toastr["success"](session('success')['header'], session('success')['message'], {'progressBar': true});
    @endif
</script>
@stack('js')
<script>
    $(window).ready(function () {
        $('#navbar').find('a[href="{{ \URL::current() }}"]').parent().addClass('active');
    });
</script>
</body>
</html>
