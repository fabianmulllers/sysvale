<?php

namespace sysvale\Http\Controllers\Admin;

use Illuminate\Http\Request as Valores;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;
use sysvale\Empresa;
use sysvale\Http\Controllers\Controller;
use sysvale\Http\Requests;
use sysvale\User;
use sysvale\Http\Requests\EditUserRequest;
use sysvale\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Request ;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        // el index de la administracion de usuario
        $users= User::orderBy('id','DES')
            ->paginate(9);



       return view('admin.usuarios.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {


       $type= $request->type;
        if($type==='user' || $type ==='approver') {
            $this->validate($request, [
                'empresas' => 'required',
                'departamentos' => 'required',
            ]);
            //
            $user= User::create($request->all());
            $request->empresas;
            $date=\Carbon\Carbon::now();

            if (!empty($request->departamentos) && !empty($request->empresas)) {
                foreach ($request->departamentos as $departamento) {
                    $user->user_empresas()->attach($request->empresas, ['departamento_id' => $departamento, 'fecha' => $date]);
                }
            }
        }else{
            $user= User::create($request->all());

        }


        if(request::ajax()){
            // return $message;
            return response()->json([
                'id'  => $user->id,
                'name'=> $user->full_name

            ]);

        }

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // tomamos el id del usuario a editar
        $user= User::findOrFail($id);
        $empre=array();
        $depto=array();

        foreach($user->user_empresas as $empresa){
            $empre[]=$empresa->id;

        }
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

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {

        $type= $request->type;
        if($type==='user' || $type ==='approver') {
            $this->validate($request, [
                'empresas' => 'required',
                'departamentos' => 'required',
            ]);
            //
            //
            $user = User::findOrFail($id);
            $user->fill(Request::all());
            $user->save();
            //$user->fill($request->all());
            $dept_array = array();

            $date = \Carbon\Carbon::now();


            if (!empty($request->request) && !empty($request->empresas)) {
                foreach ($request->departamentos as $departamento) {

//collect all inserted record IDs
                    $dept_array[$departamento] = ['empresa_id' => $request->empresas, 'fecha' => $date];

                }
                $user->user_departamentos()->sync($dept_array);
            }
        }else{
            $user = User::findOrFail($id);
            $user->fill(Request::all());
            $user->save();
        }

            //$user->tasks()->attach('Aquí id task',['menu_id'=>'id menu', 'status'=>true]);

       /* $request->empresas;
        $date=\Carbon\Carbon::now();
        foreach ($request->departamentos as $departamento){
            $user->user_empresas()->sync($request->empresas,['departamento_id'=>$departamento, 'fecha'=>$date]);
        }*/





         return response()->json([
             'name'  => $user->full_name,

         ]);
        // return view('admin.users.edit',compact('user'));
        /*$validador=Validator::make($request->all());

        if($validador->fails()){

            return $validador;
        }

       */
        //$user=fill($request->all());
       // return $request->errors()->all();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return $id;
        $user= User::findOrFail($id);
        //User::destroy($id);
        $user->delete();

        $message=$user->fullname.' fue eliminado';
        if(request::ajax()){
            // return $message;
            return response()->json([
                'id'  => $id,
                'message' => $message,
                'name' => $user->full_name
            ]);

        }
        Session::flash('message',$message);
        return redirect()->route('admin.users.index');

    }
    public function updatePaneles(){
// recarga el div del paneles para actualizar los datos con ajax
        $users= User::orderBy('id','DES')
            ->paginate(9);


        return view('admin.usuarios.partials.paneles',compact('users'));

    }

    public function select_type(Valores $request){

          $valor= $request->valor;
          $tipo=$request->tipo;
          $empresa=Empresa::all();
          $opciones='';
          $selectdepartamneto= " select_tipo('departamento')";
          


     switch ($tipo){

         case 'empresa':
             $opciones.="<option value=''>Selecciona Empresa</option>";
             foreach ($empresa as $empr){
                 $opciones.="<option value=".$empr->id.">".$empr->name_empresa."</option>";

             }

            if($valor==='user' || $valor ==='approver') {
                return '
            <div id="diverror_empresas" class="form-group row ">
                    <div class="col-md-3">
                      <label class="control-label col-sm-2" for="nameempresa" onchange="">Empresa</label>
                    </div>
                    <div class="col-md-6">
                        <select id="select_empresa"  name="empresas" class="selectpicker"  onchange="   ' .$selectdepartamneto.' " >
                       ' . $opciones . '
                       
                         </select>
                        <span id="error_empresas"class="help-block" style="display: none;"></span>
                    </div>

                </div>
            ';
            }
             break;
         case 'departamento':
             if(!empty($valor)) {

                 $empresa = Empresa::find($valor);
                 foreach ($empresa->departamentos as $empr) {
                     $opciones .= "<option value=" . $empr->id . ">" . $empr->name_departamento . "</option>";

                 }


                 return '
            <div id="diverror_departamentos" class="form-group row ">
                    <div class="col-md-3">
                      <label class="control-label col-sm-2" for="namedepartamento" >Departamento</label>
                    </div>
                    <div class="col-md-6">
                        <select id="select_departamento" name="departamentos[]" class="selectpicker" multiple data-actions-box="true" multiple data-selected-text-format="count > 2" >
                 ' . $opciones . '
                       
                         </select>
                        <span id="error_departamentos"class="help-block" style="display: none;"></span>
                    </div>

                </div>
            ';
             }
             break;


     }
    }
}


