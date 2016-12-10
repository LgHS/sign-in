<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>
        @hasSection('page_title')
            @yield('page_title') | Liege Hackerspace
        @else
            Bienvenue | Liege Hackerspace
        @endif
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('/dist/css/main.css') }}">
</head>
<body class="app">
    <div class="container">
        <header id="page-header">
            <a href="{{ url('/') }}" title="Accueil">
                <img src="/dist/svg/logo.svg" alt="Liege Hackerspace">
            </a>
        </header>

        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#main-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">LgHS</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="main-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ active('app.home') }}"><a href="{{ route('app.home') }}" >Accueil</a></li>
                    {{--<li class="{{ active('app.profils') }}"><a href="{{ route('app.profils') }}" >Profil</a></li>--}}
                    {{--<li class="{{ active('totp.home') }}"><a href="{{ route('totp.home') }}" >Double auth</a></li>--}}
                    {{--<li class="{{ active('app.apps') }}"><a href="{{ route('app.apps') }}" >Application</a></li>--}}
                    {{--<li class="{{ active('dev.home') }}"><a href="{{ route('dev.home') }}" >Dev</a></li>--}}
                    {{--<li class="{{ active('admin.home') }}"><a href="{{ route('admin.home') }}" >Admin</a></li>--}}
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ url('/logout') }}" title="Déconnectez-vous">
                            <i class="fa fa-sign-out"></i>
                            Déconnexion
                            ({{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}})
                        </a>
                    </li>
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">--}}
                            {{--<i class="fa fa-user"></i>--}}
                            {{--{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}--}}

                            {{--<span class="caret"></span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li>--}}
                                {{--<a href="{{ url('/logout') }}">--}}
                                    {{--<i class="fa fa-sign-out"></i>--}}
                                    {{--Déconnexion--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>

        <main id="content">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer id="page-footer">
            <p>
                MAIL: ping[at]lghs.be
            </p>
            <p>
                IRC: #LgHS @ Freenode
            </p>
            <ul>
                <li>
                    <a href="https://github.com/LgHS" title="Our Github repos">
                        <i class="fa fa-github"></i>
                        Github
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/liegehackerspace/" title="Our Facebook page">
                        <i class="fa fa-facebook"></i>
                        Facebook
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/LgHackerSpace" title="Our Twitter feed">
                        <i class="fa fa-twitter"></i>
                        Twitter
                    </a>
                </li>
                <li>
                    <a href="https://chat.lghs.be" title="Our Chat">
                        <i class="fa fa-comment"></i>
                        Chat
                    </a>
                </li>
            </ul>
        </footer>
    </div>
</body>
</html>
