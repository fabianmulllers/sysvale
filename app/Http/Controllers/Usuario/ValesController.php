<?php

namespace sysvale\Http\Controllers\Usuario;

use Fenos\Notifynder\Facades\Notifynder;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use sysvale\EmpresaDepartamentoUser;
use sysvale\Http\Controllers\Controller;
use sysvale\Http\Requests;
use sysvale\Product;
use sysvale\User;
use Illuminate\Support\Facades\Request as Reque;

//use Illuminate\Support\Facades\Request ;



class ValesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user');
    }

    public function index()
    {
        //

        $id=Auth::user()->id;
        $users=User::find($id);
        $empresas=$users->vale_empresas();
        $departamentos=$users->vale_departamentos()->where('date_vale','>=','now()')->where('aprobacion_vale','=','espera')->orderby('empresa_departamento_users.id','des')->paginate(9);

        //$departamentos=$users->vale_departamentos();
        //$vales=EmpresaDepartamentoUser::orderBy('id','DES')->paginate(9);
        return view("usuario.vale.index",compact(['users','empresas','departamentos']));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $iduser=Auth::user()->id;
        $vale=EmpresaDepartamentoUser::findOrFail($id);
        if($vale->bloqueo ==0 || $vale->bloqueo ===$iduser) {
            $vale->bloqueo = $iduser;
            $vale->save();

            $products = $vale->details_product;
            //echo $vale;
            $tbody = '<tr></tr>';
            $i = 0;
            //  echo $products;
            foreach ($products as $product) {
                $tbody .= '<tr id="resultado' . $i . '">' .
                    '<td><div id="div_error_codproducto' . $i . '"><input id="codproducto' . $i . '" class="form-control" type="search" name="codproducto[]"  value="' . $product->pivot->product_id . '"praceholder ="EJ: 04008006" required onkeyup="buscarproductos(' . $i . ')" > <span id="error_codproducto' . $i . '" class="help-block" style="display: none;"></span> </div></td>' .
                    '<td><input id="nameproduct' . $i . '" class="form-control input-sm" OnFocus="this.blur()" name="nameproduct' . $i . '" value="' . $product->name_product . '"></td>' .
                    '<td class="col-md-1"><input id="stockproduct' . $i . '"    class="form-control input" OnFocus="this.blur()" name="stockproduct' . $i . '"   value= ' . $product->stock_product . ' ></div></td> ' .
                    '<td class="col-md-1"><input id="precioproduct' . $i . '"    class="form-control input-sm" OnFocus="this.blur()" name="precioproduct' . $i . '"   value= ' . $product->precio_product . ' ></div></td>' .
                    '<td class="col-md-1"><input id="cantidad' . $i . '"    class="form-control input-sm"  name="cantidad' . $i . '"  value="' . $product->pivot->cantidad . '" required ></div></td>' .
                    '<td class="col-md-1"><a class="btn btn-danger btn-xs"onclick="eliminarFila(' . $i . ')"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></td>' .
                    '</tr>';
                $i++;
            }
            //'<td><div id="diverror_codproducto'+i+'"><input id="codproducto'+i+'" class="form-control" type="search"   name="codproducto[]" placeholder="EJ: 04008006"  required    onkeyup="buscarproductos(' + i + ')" > <span id="error_codproducto'+i+'"class="help-block" style="display: none;"></span></div></td> ' +

            //<td><input id="nameproduct'+id+'"    class="form-control input-sm" OnFocus="this.blur()" name="nameproduct'+id+'"   value= '+response.name_product+' ></div></td>
            return response()->json([
                'id' => $vale->id,
                'namevale' => $vale->name_vale,
                'departamentos' => $vale->departamento_id,
                'totalproduct' => $vale->total_product,
                'tbody' => $tbody,

            ]);
        }else{
            $titulo='No se puede Editar ';
            $body='<h4>La solicitud '.$vale->name_vale.' no se puede editar por este momentos, esta siendo visualizada por otro usuario </h4>';
            return response()->json([

                'titulo' => $titulo,
                'body' => $body,
            ],422);

        }
        /* $iduser=Auth::user()->id;
          $user= User::findOrFail($iduser);
          $empre=array();
          $depto=array();

         foreach($user->vale_empresas as $empresa){
              $empre[]=$empresa->id;

          }
        var_dump($empre);*/
        /*
          foreach ($user->user_departamentos as $departamento){
              $depto[]=$departamento->id;
          }

          //return view('admin.edit',compact('user'));
          return response()->json([
              'id'  => $user->id,
              'name' => $user->name,
              'last_name' => $user->last_name,
              'email'=>$user->email,
              'type' => $user->type,
              'empresa'=>$empre,
              'departamento'=>$depto,

          ]);*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $vale = EmpresaDepartamentoUser::findOrFail($id);
        $departamento=$request->departamentos;
       $vale->departamento_id=$departamento;
        $vale->total_product=$request->totalproduct;
        $vale->fill(Reque::all());
        $vale->save();
        $details=array();
        $i=0;
        foreach($request->codproducto as $producto){
            $cantidad="cantidad".$i;
            $precioproduct="precioproduct".$i;
            $precio=$request->$cantidad*$request->$precioproduct;
           $details[$producto]=[
             'cantidad'=>$request->$cantidad,
               'precio'=>$precio,
           ];
        }
        $vale->details_product()->sync($details);

        $titulo='Se Actualizo con exito la Solicitud';
        $body= '</h4>La Solicitud ' .$vale->name_vale.' se actualizo con exito </h4>';
        return response()->json([
            'titulo'=>$titulo,
            'body'=>$body
        ]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //
        $vale= EmpresaDepartamentoUser::findOrFail($id);
        $userid=Auth::user()->id;
        if($vale->bloqueo ==0 || $vale->bloqueo ===$userid) {
            //User::destroy($id);
            $vale->delete();
            $titulo='Se Elimino con Exito';
            $body='<h4>hLa solicitud '.$vale->name_vale.' fue eliminada con exito</h4>';
            return response()->json([

                'titulo' =>$titulo,
                'body' => $body
            ]);
        }else{
            $titulo='No se puede eliminar ';
            $body='<h4>La solicitud '.$vale->name_vale.' no se puede eliminar por este momentos, esta siendo visualizada por otro usuario </h4>';
            return response()->json([

                'titulo' => $titulo,
                'body' => $body,
            ],422);

        }
        /*if(request::ajax()){
            // return $message;
            return response()->json([

                'name_departamento' => $departamento->name_departamento
            ]);

        }*/



    }

    public function buscarproducto(Request $id)
    {


        if(is_numeric($id->id)) {
            $product = Product::find($id->id);
            //return $id;

            //User::destroy($id);

            // $message=$product->name_product;
            //if($id::ajax()){
            // return $message;
            if (!is_null($product)) {


                if ($id->ajax()) {

                    return response()->json([
                        'message' => 'si',
                        'name_product' => $product->name_product,
                        'precio_product' => $product->precio_product,
                        'stock_product' => $product->stock_product
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'no'

                ]);

            }
        }else{
            return response()->json([
                'message' => 'no'

            ]);
        }

        //}
        // Session::flash('message',$message);
        //return redirect()->route('admin.users.index');

    }

    public function ingresarvale(Request $id)
    {

        $codproducto=$id->codproducto;
        $arrayrepetidos=array();

        $res = array_diff($codproducto, array_diff(array_unique($codproducto), array_diff_assoc($codproducto, array_unique($codproducto))));

        foreach(array_unique($res) as $v) {
           $repetidos=  array_keys($res,$v);
                foreach ($repetidos as $value){
                    $index="codproducto.".$value;
                    $arrayrepetidos[$index]="Este producto esta repetido";

                }

        }

        //var_dump ($arrayrepetidos);

      if(!empty($arrayrepetidos)) {
          return response()->json($arrayrepetidos, 422);
      }
      //  return $json;

        $iduser=Auth::user()->id;
        $empresas = Auth::user();
        $arrayemp=array();
        $idempresa=0;
        $date=\Carbon\Carbon::now();
        $this->validate($id, [
            'departamentos' => 'required',
            'name_vale'=>'required',
            'totalproduct'=>'required',
            'codproducto.*'=>'required|integer',
        ]);
            foreach ($empresas->user_empresas as $empresa){
                $arrayemp[] = $empresa->id;
            }
            foreach ($arrayemp as $empr){
                $idempresa=$empr;
            }
        
            $idvale=DB::table('empresa_departamento_users')->insertGetId([
                'user_id' => $iduser,
                'empresa_id'=>$idempresa,
                'departamento_id'=>$id->departamentos,
                'name_vale' =>$id->name_vale ,
                'date_vale' => $date,
                'total_product' =>$id->totalproduct ,
                'aprobacion_vale'=>'espera', 


            ]);
        $vale=EmpresaDepartamentoUser::find($idvale);

        $i=0;
            foreach ($id->codproducto as $value){
                if(!empty($value)) {
                    $this->validate($id, [
                        'precioproduct'.$i => 'required',
                        'cantidad'.$i=>'required',
                    ]);
                    $precioproduct = "precioproduct" . $i;
                    $cantidad = "cantidad" . $i;

                    $precio = $id->$precioproduct * $id->$cantidad;
                    $vale->details_product()->attach($value, ['cantidad' => $id->$cantidad, 'precio' => $precio]);
                    $i++;
                }
            }

        $titulo = "Se a Ingresado el Vale <strong>".$vale->name_vale."</strong>";
        $body="<h4>Se Ingreso con exito el Vale de Consumo debes esperar a que lo aprueben. Se enviara una notifiacion con la aprobacion </h4>";

        return response()->json([
        'titulo'=>$titulo,
        'body'=>$body,
        'id' => $vale->id,
        'name_vale'=>$vale->name_vale,

    ]);



    }

    public function valeingresados(){
        $id=Auth::user()->id;
        $users=User::find($id);
        $empresas=$users->vale_empresas();
        $departamentos=$users->vale_departamentos()->where('date_vale','>=','now()')->where('aprobacion_vale','=','espera')->orderby('empresa_departamento_users.id','des')->paginate(9);

        return view("usuario.vale.partials.paneles",compact(['users','empresas','departamentos']));


    }

    public function vernotificacion(){
       $iduser=Auth::user()->id;
       //$notificacion=  Notifynder::readAll($iduser);
        //if($notificacion > 0){


              $userNotified = User::find($iduser);

              $count= $userNotified->countNotificationsNotRead($category = null);
              $mensaje='';
              if($count >0){
                  $notinoread= $userNotified->getNotificationsNotRead();
                  foreach ($notinoread as $read){

                      $mensaje .=$read->body->name;
                      $mensaje .= " ".$read->body->text;
                  }
                  $notificacion=  Notifynder::readAll($iduser);
                  return response()->json([
                'mensaje' => $mensaje,

            ]);

              }else{
                  return response()->json([

                   'mensaje'=> 'no ahy mensaje',
                      'count'=>$count,
                  ]);


              }
            /*return response()->json([
                'mensaje' => $mensaje,

            ]);*/
        }




}