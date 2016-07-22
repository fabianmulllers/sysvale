<div class="modal fade" id="fields_modal" tabindex="-1"  data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="fields_modeal_header"class="modal-header" >
                <button type="button" class="close"   onclick="desbloquear({{$details->id}})"   data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="modal-title"  id="myModalLabel_fields"> <div class="row>">
                        <div class="col-xs-10">
                            <i class="fa fa-wpforms " aria-hidden="true"></i>  Detalle Solicitud
                            </div >
                        <div class="col-xs-2 text-right">
                            <a class="btn btn-circle btn-lg btn-info" onclick="mensajeAprobacion('{{$details->name_vale}}','{{$details->id}}','si')"><i class="fa fa-check" aria-hidden="true"></i> </a>
                            <a class="btn btn-circle btn-lg btn-danger" onclick="mensajeAprobacion('{{$details->name_vale}}','{{$details->id}}','no')"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> </a>
                            </div>
                        </div> </h1>
            </div>
            <div id="fields-modal_body"class="modal-body">
             @include('approver.solicitudes.partials.detail')
            </div>
            <div  id="fiels_modal_footer"class="modal-footer">
                <div class="col-md-12 text-left">
                      <div class="col-xs-4"><h4> <strong><u>Cantidad</u></strong></h4>{{$details->total_product}}</div>
                      <div class="col-xs-4"><h4><strong><u>Total</u></strong> </h4> {{$totalprecio}}</div>
                    <div class='col-xs-4 text-right'><a class="btn btn-default" onclick="desbloquear({{$details->id}})"> cancelar</a> </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>