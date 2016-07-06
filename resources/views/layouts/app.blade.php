<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Sign in !</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('/dist/css/main.css') }}">
</head>
<body>
<header id="page-header">
    <h1>Sign in for some Hackerspace magic</h1>
</header>

<main id="content">
    @yield('content')
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
