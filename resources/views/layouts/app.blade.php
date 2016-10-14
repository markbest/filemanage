<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.pjax.min.js') }}"></script>
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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
    <aside class="left-menu-aside">
        <div class="menu_dropdown">
            <ul>
                <li class="{{ active_class(if_uri_pattern(['pictures']), 'active', '') }}">
                    <i class="fa fa-picture-o menu_dropdown-text" aria-hidden="true"></i>
                    <a href="{{ url('/pictures') }}">图片管理</a>
                </li>
                <li class="{{ active_class(if_uri_pattern(['files']), 'active', '') }}">
                    <i class="fa fa-briefcase menu_dropdown-text" aria-hidden="true"></i>
                    <a href="{{ url('/files') }}">文件管理</a>
                </li>
            </ul>
        </div>
    </aside>
    <div class="dislpayArrow"><a href="javascript:void(0);" onclick="displaynavbar(this)"></a></div>
    <div id="right-content-box" class="right-content-box">
        @yield('content')
    </div>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
