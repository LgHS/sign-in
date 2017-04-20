<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>LgHS Members Administration</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/css/skins/_all-skins.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    @yield('css')
</head>

<body class="skin-blue sidebar-mini">
    @if (!Auth::guest())
        <div class="wrapper">
            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="{{ route('admin.index') }}" class="logo">
                    <b>LgHS Members</b>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>{!! Auth::user()->username !!}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div>
                                            <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Déconnexion
                                            </a>
                                            {{--<a href="{!! route('app.home') !!}" class="btn btn-default btn-flat">--}}
                                                {{--Voir le site--}}
                                            {{--</a>--}}
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- Left side column. contains the logo and sidebar -->
            @include('admin.layouts.sidebar')
                    <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>

            <!-- Main Footer -->
            <footer class="main-footer" style="max-height: 100px;text-align: center">
                <strong>LgHS</strong>
                <img src="https://lghs.be/dist/images/unicorn.png" width="16" height="16" />
                We'll be free hackers, we'll be free.
            </footer>

        </div>
    @else
        Sign in
    @endif

    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>
    <script type="text/javascript" src="{{asset('/js/app.js')}}"></script>

    <!-- jQuery 2.1.4 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/js/app.min.js"></script>

    @yield('scripts')

    <script type="text/javascript">
        if ($('.select2').length) {
            $(".select2").select2();
        }
    </script>
</body>
</html>