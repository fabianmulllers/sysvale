
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Sistema de vales
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">

                <li><a href="{{ url('/home') }}">Inicio</a></li>

                @if (!Auth::guest())
                 <?php $type = Auth::user()->type ?>
                 <!-- Menu de administrador-->
                        @if($type=='admin')
                            <li><a href= "{{URL::route('admin.users.index')}}">Usuarios</a></li>
                       @endif

           <!-- fin Menu Administrador-->
            <!-- Menu usuario -->
                        @if($type=='user')
                            <li><a href="{{URL::route('user.vales.index')}}">Ingresar vale</a></li>
                        @endif
            <!-- fin Menu usuario-->
                <!--Menu Aprobador -->
                        @if($type=='approver')
                            <li><a href="{{URL::route('approver.approver.index')}}">Aprobar vale</a></li>
                        @endif
                       <!-- fin Meny aprobador-->
                            @endif

                                </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
