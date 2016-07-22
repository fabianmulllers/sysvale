<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <!-- Tablero -->
            <li>
                <a href="{{ url('/home') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <!-- fin Tablero-->
            <!-- ingreso del sistema-->
            <li>
                <a href="{{route('approver.approver.index')}}"><i aria-hidden="true" class="fa fa-plus-circle"></i> Solicitudes Vale Consumo<span class="fa arrow"></span></a>
                <!-- /.nav-second-level -->
            </li>
            <!-- fin ingreso del sistema -->


        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>