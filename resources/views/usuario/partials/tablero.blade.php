<div class="row">
    <!--usuarios del sistema
    <div  onclick="dirigeme('enlaceingresovale')" class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #009900">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-plus-circle fa-5x" aria-hidden="true"></i>

                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">26</div>
                        <div>Ingreso Vale Consumo</div>
                    </div>
                </div>
            </div>
            <a id="enlaceingresovale" href="{{route("user.vales.index")}}">
                <div class="panel-footer">
                    <span class="pull-left">Ingresar</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- fin usuarios del sistema -->
    <!--Vales Ingresados -->
    <div onclick="dirigeme('enlacevalesingresados')" class="col-lg-4 col-md-6">
        <div class="panel" style=" border-color: blue">
            <div class="panel-heading" style="background-color: #ffa500; color: #fff ">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-location-arrow fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">12</div>
                        <div>Vales de consumo ingresados</div>
                    </div>
                </div>
            </div>
            <a id="enlacevalesingresados" href="{{route("user.vales.index")}}">
                <div class="panel-footer">
                    <span class="pull-left">Ingresar</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- fin de las empresas del sistema -->
    <!-- departamentos del sistema
    <div onclick="dirigeme('enlacedepartamento')" class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-building fa-5x" aria-hidden="true"></i>

                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">124</div>
                        <div>Departamentos del sistema</div>
                    </div>
                </div>
            </div>
            <a id="enlacedepartamento" href="{{route("admin.departamentos.index")}}">
                <div class="panel-footer">
                    <span class="pull-left">Ingresar</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- fin departamentos-->
    <!--<div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">13</div>
                        <div>Support Tickets!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>-->
</div>
<input id="valeingresados" value="{{route("user.vales.valeingresados")}} " style="display: none">
