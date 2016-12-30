<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>
        @hasSection('page_title')
            @yield('page_title') | Liege Hackerspace
        @else
            Liege Hackerspace | Learn / Make / Share
        @endif
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="auth-pages">
    <header id="page-header">
        <h1>@yield('title')</h1>
    </header>

    <main id="content">
        @yield('before_content')

        <div class="panel panel-default">
            <h2>
                <a href="{{ url('/') }}" title="Accueil"> <img src="{{ asset('svg/logo.svg') }}" alt="Liege Hackerspace"></a>
            </h2>
            <div class="panel-body">
                @yield('content')
            </div>
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
</body>
</html>
