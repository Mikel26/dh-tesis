<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('/images/imagenes/logo-lg.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/images/imagenes/logo-lg.png') }}">
    {{-- <link rel="icon" type="image/png" href="{{ asset('/images/imagenes/Carbon2.png') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/images/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">
    <link rel="stylesheet" href="{{ asset('/images/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">

    <!-- Optional - Adds useful class to manipulate icon font display -->
    <link rel="stylesheet" href="{{ asset('/images/pe-icon-7-stroke/css/helper.css') }}">

    <title>David's Hamburgers</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #E31521;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            font-weight: bold;
        }

        .bg-image {
            background: linear-gradient(rgba(255, 255, 255, .6), rgba(255, 255, 255, .6)),
            url({{ asset('/images/imagenes/davids.jpg') }});

        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        img.mediana {
            width: 222px;
            height: 177px;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #E31521;
            padding: 0 25px;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;

        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body class="bg-image">
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            @if(Auth::user()->id_tipo_usuario == 1)
            <a href="{{ route('register') }}">Registrar <i class="pe-7s-add-user"></i>
            </a>


            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Cerrar Sesión <i class="pe-7s-close-circle"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            @else
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                Cerrar Sesión <i class="pe-7s-close-circle"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endif
            @else
            <a href="{{ route('login') }}">Iniciar Sesión</a>
            @endauth
        </div>
        @endif

        <div class="content">
            <img class="mediana" src="{{ asset('/images/imagenes/logo-lg.png') }}">
            <div class="title m-b-md">
                @auth
                Bienvenido
                <br>
                {{ Auth::user()->name }}
                <br>
                @else
                Bienvenido
                @endauth

            </div>

            <div class="links">
                @auth
                <a href="clientes">Clientes <i class="pe-7s-users"></i></a>|
                <a href="productos">Productos <i class="pe-7s-note2"></i></a>|
                <a href="categorias">Categorias <i class="pe-7s-note2"></i></a>|
                <a href="pedidos">Pedidos <i class="pe-7s-shopbag"></i></a>|
                <a href="reportes">Reportes <i class="pe-7s-graph2"></i></a>
                @endauth
            </div>
        </div>
    </div>
</body>

</html>