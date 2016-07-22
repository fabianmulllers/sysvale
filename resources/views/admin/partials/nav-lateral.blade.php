<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <!-- Tablero -->
            <li>
                <a href="{{ url('/home') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <!-- fin Tablero-->
            <!-- Usuarios del sistema-->
            <li>
                <a href="{{route('admin.users.index')}}"><i class="fa fa-bar-chart-o fa-fw"></i> Usuarios del sistema<span class="fa arrow"></span></a>
                <!-- /.nav-second-level -->
            </li>
            <!-- fin Usuarios del sistema -->
            <!-- Empresas del sistema -->
            <li>
                <a href="{{route('admin.empresas.index')}}"><i class="fa fa-table fa-fw"></i> Empresas del Sistema</a>
            </li>
            <!-- fin empresas del sistema-->
            <!-- departamentos del sistema-->
            <li>
                <a href="{{route('admin.departamentos.index')}}"><i class="fa fa-edit fa-fw"></i> Departamentos del Sistema</a>
            </li>
            <!-- fin del sistema -->
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>

 <script>setInterval(vernotificacion, 3000);</script>