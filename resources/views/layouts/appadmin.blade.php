<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">                    
                    <button  
                        class="btn btn-default" 
                        style='background-color:#FFFFFF;border:none'>
                        <img src="{{URL::asset('/images/boton_inicio.png')}}" 
                             style="border:none">
                    </button>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="center">                    
                    <img align:middle src="{{URL::asset('/images/Logtipo_mas_EscudoColor_MD.png')}}" 
                    alt="profile Pic" height="100" width="250">                    
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->                   
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Cat??logos
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="nav-link" href="{{ url('/admin/Periodos')}}" > {{ __('Periodos') }}</a>
                                <a class="nav-link" href="{{ url('/admin/Perfilusers')}}" > {{ __('Periles de Usuarios') }}</a>
                                <a class="nav-link" href="{{ url('/admin/Usuarios')}}" > {{ __('Usuarios') }}</a>
                                <a class="nav-link" href="{{ url('/admin/Perfilclimas')}}" >{{ __('Perfiles de Clima') }}</a>
                                <a class="nav-link" href="{{ url('/admin/Climas')}}" >{{ __('Clima Org.') }}</a>
                                <a class="nav-link" href="{{ url('/admin/Plantillas')}}" >{{ __('Plantillas') }}</a>
                                
                             </div>
                        </li>                         
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Importar
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="nav-link" href="{{ url('/admin/importUsuarios') }}" > {{ __('Usuarios') }}</a>
                                <a class="nav-link" href="{{ url('/admin/importClimas') }}" >{{ __('Formato Clima Org.') }}</a>
                                <a class="nav-link" href="{{ url('/admin/importPlantillas')}}" >{{ __('Plantillas') }}</a>
                             </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Exportar
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="nav-link" href="{{ url('/admin/exp/1') }}" > {{ __('Usuarios') }}</a>
                                <a class="nav-link" href="{{ url('/admin/exp/2') }}" >{{ __('Formato Clima Org.') }}</a>
                                <a class="nav-link" href="{{ url('/admin/exp/3') }}" >{{ __('Plantilas') }}</a>
                             </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Reportes
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="nav-link" href="{{ url('/admin/repo/2') }}" > {{ __('Clima Org.') }}</a>
                                <a class="nav-link" href="{{ url('/admin/repo/3') }}" > {{ __('Plantillas') }}</a>
                             </div>
                        </li>                        
                    </ul>                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <!--
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Acceso') }}</a>
                                </li>
                            @endif                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                            -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesi??n') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>