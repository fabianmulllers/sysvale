<?php

namespace sysvale\Http\Controllers\Approver;



use Fenos\Notifynder\Facades\Notifynder;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use sysvale\Detail;
use sysvale\Empresa;
use sysvale\EmpresaDepartamentoUser;
use sysvale\Http\Controllers\Controller;
use sysvale\Http\Requests;
use sysvale\User;
use sysvale\Vale;


class ApproverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('approver');
    }
    public function index()
    {
       // buscamos el id del aprobador y consultamos sus datos
         $userid=Auth::user()->id;
         $users=User::find($userid);
       // buscamos el id de la empresa en cual pertenece en la tabla pivot user_empresa_departamentos
         $empresas=$users->user_empresas()->select('empresas.id')->get()->first();
         $idempresa=$empresas->id;
        // buscamos los datos de la empresa y los departamentos que se relaciona en la tabla pivot empresa_departamento_users
         $empresa=Empresa::find($idempresa);
         $vales=$empresa->vale_departamentos()->where('date_vale','>=','now()')->where('aprobacion_vale','=','espera')->paginate(9);


        // guardamos los id de los vales
       /*  $idvales=array();
        foreach ($departamentos as $departamento){
           $idvales[]=$departamento->pivot->id;
        }
// y consultamos en la tabla pivot las solicitudes que estean vigentes
        $vales=EmpresaDepartamentoUser::whereIn('id',$idvales)->where('date_vale','>=','now()')->paginate(9);*/

        return view('approver.solicitudes.index',compact('vales'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $iduser=Auth::user()->id;
       $details=EmpresaDepartamentoUser::FindOrFail($id);
        $idempresa=$details->empresa_id;
        $empresa=Empresa::find($idempresa);
        $departamentouser=$empresa->vale_departamentos;
        $departamento='';
        $nombreuser='';

        foreach ($departamentouser as $value){
          $departamento = $value->name_departamento;
            $nombreuser= $value->name.' '.$value->last_name;
        }
        $details->bloqueo=$iduser;
        $details->save();

        $totalprecio=0;
        foreach ($details->details_product as $detail){

            $totalprecio=$totalprecio + $detail->pivot->precio;
        }


        return view('approver.solicitudes.partials.viewvale',compact('details','totalprecio','empresa','departamento','nombreuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
      //$detail= Detail::findOrFail($id);
        $detail = Detail::select('details.*')->where('vale_id','=',$id)->get();

        //return $detail;
        Session::flash('id',$id);
       return view('approver.edit',compact('detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $vale= Vale::findOrFail($id);
        //$user->fill(Request::all());
        $vale->name_aprobador=$request->nombreapprover;
        $vale->aprobacion_vale='si';
        $vale->save();
        // return view('admin.users.edit',compact('user'));
        return Redirect::route('approver.approver.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function desbloquear($id){
        $vale=EmpresaDepartamentoUser::find($id);
        $vale->desbloquear();
      return  response()->json([
          'bloqueo'=>$vale->bloqueo,
      ]);
    }


    public function aprobarvale(Request $request){
        $aprobar= $request['request'];
        $idvale=$request['id'];

        if($aprobar === 'si' || $aprobar ==='no'){

            $vale=EmpresaDepartamentoUser::find($idvale);
            $vale->aprobacion_vale=$aprobar;
            $vale->save();
            switch ($aprobar){
                case 'si':
                    $titulo ="Se Aprobo con exito";
                    $body="Se Aprobo la solicitud ".$vale->name_vale ." con exito";
                    $this->enviarnotificacion($vale->user_id);
                    break;
                case 'no':
                    $titulo ="Se Desaprobo con exito";
                    $body="Se Desaprobo la solicitud ".$vale->name_vale ." con exito";

            }
        }

        return response()->json([
            'titulo'=>$titulo,
            'body'=>$body,
        ]);




    }

    public function updatePaneles(){

        $userid=Auth::user()->id;
        $users=User::find($userid);
        // buscamos el id de la empresa en cual pertenece en la tabla pivot user_empresa_departamentos
        $empresas=$users->user_empresas()->select('empresas.id')->get()->first();
        $idempresa=$empresas->id;
        // buscamos los datos de la empresa y los departamentos que se relaciona en la tabla pivot empresa_departamento_users
        $empresa=Empresa::find($idempresa);
        $vales=$empresa->vale_departamentos()->where('date_vale','>=','now()')->where('aprobacion_vale','=','espera')->paginate(9);



        return view('approver.solicitudes.partials.paneles',compact('vales'));
    }

    public function enviarnotificacion($id){

        $user_sender_id   = Auth::user()->id;; // User sender
        $user_receiver_id = $id; // User that receive the notification

        Notifynder::category('hello')
            ->from($user_sender_id)
            ->to($user_receiver_id)
            ->url('http://localhost')
            ->send();

// we sent the notification!
// now let's check it

        //$userNotified = User::find($user_receiver_id);

// Return Illuminate\Database\Eloquent\Collection
// with the notifications in it

          //  $texto= $userNotified->getNotificationsNotRead();

        //foreach ($texto as $tex){
        // echo    $tex->from->name;
        }

      //  echo  "no leidos ".$userNotified->getNotificationsNotRead();
     //   echo "leidos ". Notifynder::readAll($user_receiver_id);

}

