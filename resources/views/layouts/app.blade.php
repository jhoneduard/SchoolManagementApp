<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="/img/x-icon" href="img/libro.jpg">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/admin.css')}} ">

    <script src="https://kit.fontawesome.com/c3a6c2f3b7.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/libro.jpg')}}" width="30" height="30"> Sistema Notas
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if(Auth::check())
                            <!---Administrador-->
                            @if(Auth::user()->id_category == 1)
                            <li @click="menu=1" class="nav-item active">
                                <a class="nav-link text-white" href="#"> <i class="fas fa-user-graduate"></i> Usuarios</a>
                            </li>

                            <li @click="menu=2" class="nav-item active">
                                <a class="nav-link text-white" href="#"> <i class="fa fa-book"></i></i>Cursos</a>
                            </li>
                            @endif
                            <!---END Administrador-->

                            @if(Auth::user()->id_category == 2)
                            <!--- Estudiantes --->
                            <li @click="menu=3" class="nav-item active">
                                <a class="nav-link text-white" href="#"> <i class="fa fa-book"></i></i>Inscripcion de cursos</a>
                            </li>
                            <!--- END Estudiantes --->
                            @endif
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-user-alt"></i> {{ Auth::user()->names }} {{ Auth::user()->surnames }}
                                <br>
                                <i class="fas fa-envelope"></i> {{ Auth::user()->email }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-door-open"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(Auth::check())
                <!---Administrador-->
                @if(Auth::user()->id_category == 1)
                <template v-if="menu==1">
                    <usuarios></usuarios>
                </template>

                <template v-if="menu==2">
                    <asignaturas></asignaturas>
                </template>
                @endif
                <!---END Administrador-->

                @if(Auth::user()->id_category == 2)
                <!--- Estudiantes ---->
                <template v-if="menu==3">
                    <course-registration></course-registration>
                </template>

                <template v-if="menu==4">
                    <course-recommendations></course-recommendations>
                </template>
                <!----- End estudiantes ----->
                @endif
            @endif
        </main>
    </div>

    <div class="footer footer-sm-md-lg-xl">
        <p class="bg-info text-white">
            <strong class="text-center">© Copyright <?php echo date("Y"); ?> SchoolManagementApp </strong>
        </p>
    </div>

</body>

</html>