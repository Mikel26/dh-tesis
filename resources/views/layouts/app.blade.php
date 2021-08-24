<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('/images/imagenes/logo-lg.png') }}">

    <!-- CSS para DataTable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <script src="sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>David's Hamburgers</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/images/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">
    <link href="{{ asset('/images/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet">

    <!-- Optional - Adds useful class to manipulate icon font display -->
    <link rel="stylesheet" href="{{ asset('/images/pe-icon-7-stroke/css/helper.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        
        img.logo{
                width: 54px; 
                height: 41px;
            }

            table.dataTable {
                width: 100%;
                margin: 0 auto;
                clear: both;
                border-collapse: separate;
                border-spacing: 0;
            }

        i.icono{
            width: 22px; 
            height: 40px;
        }

        .navbar, .dropdown-menu{
            /*background-color: #e1e1e1;*/
            position: fixed-top;
        }


        .bg-image {
                background: linear-gradient(rgba(255,255,255,.6), rgba(255,255,255,.6)), url({{ asset('/images/imagenes/carbon.jpg') }});
                /*background-image: url();*/
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
                /*opacity: 0.4;*/
            }
            body { padding-top: 89px; }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top navbar-light bg-warning shadow-sm" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h4>Inicio <img class="logo" src="{{ asset('/images/imagenes/logo-lg.png') }}"></h4>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <h4>
                                        <i class="pe-7s-user"></i>
                                        {{ Auth::user()->name }}<span class="caret"></span>
                                    </h4>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                        <i class="pe-7s-close-circle"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
     $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

        <main class="py-4 bg-image">
            @yield('content')
        </main>
    </div>
</body>
</html>
