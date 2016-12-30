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

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="app {{str_replace('.', '-', Route::currentRouteName())}}">
    @if (session('message'))
        <div class="alert alert-{{session('status') ? session('status') : 'default'}}">
            {{ session('message') }}
        </div>
    @endif

    <div class="container">
        <header id="page-header">
            <a href="{{ url('/') }}" title="Accueil">
                <img src="{{ asset('svg/logo.svg') }}" alt="Liege Hackerspace">
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
                    @permission(('manage-account'))
                    <li class="{{ active('profile.index') }}">
                        <a href="/profile">
                            Mon profil
                        </a>
                    </li>
                    @endpermission

                    @permission(('manage-members'))
                        <li class="{{ active('members.index') }}">
                            <a href="/members">Membres</a>
                        </li>
                        <li class="{{ active('members.add') }}">
                            <a href="/members/add">Ajouter un membre</a>
                        </li>
                    @endpermission

                    @permission(('manage-oauth-clients'))
                    <li class="{{ active('oauth.clients') }}">
                        <a href="{{ route('clients') }}">Clients oauth</a>
                    </li>
                    @endpermission
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ url('/logout') }}" title="Déconnectez-vous">
                            <i class="fa fa-sign-out"></i>
                            Déconnexion
                            ({{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}})
                        </a>
                    </li>
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

    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>
    <script type="text/javascript" src="{{asset('/js/app.js')}}"></script>
</body>
</html>
