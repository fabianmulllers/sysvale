<?php

namespace sysvale\Http\Controllers\Admin;

use Illuminate\Http\Request as reque;


use sysvale\Departamento;
use sysvale\Empresa;
use sysvale\Http\Controllers\Controller;
use sysvale\Http\Requests;
use sysvale\Http\Requests\CreateEmpresaRequest;
use Illuminate\Support\Facades\Request ;
use sysvale\Http\Requests\EditEmpresaRequest;

class EmpresaController extends Controller
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
        //
        $departamentos=Departamento::lists('name_departamento','id')->toArray();
        $empresas= Empresa::orderBy('id','DES')
            ->paginate(9);
        //$empre=$empresas->departamentos()->paginate(9);
        //$pivote = Empresa::find('5');

        //$empresas= Empresa::orderBy('id','DES')->get();

        /*$empresas = Departamento::whereHas('empresas', function ($q) {
            $q->current()->orderBy('empresas.id','DES');
        })->paginate(9);*/


       return view("admin.empresas.index")
            ->with(compact("departamentos"))
            ->with(compact("empresas"));
           //->with(compact("pivote"));
        /*foreach ($empresas as $empr){
            foreach ($empr->departamentos as $dep){
               echo $dep;
            }

        }*/
      return dd($empresas->departamentos);
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
    public function store(CreateEmpresaRequest $request)
    {
        //
        $input = $request->except(['name_departamento']);
       $empresa= Empresa::create($input);

        $name_departamentos=$request->name_departamento;

        foreach ($name_departamentos as $departamento)
        {
            if(!empty($departamento)) {
                $empresa->departamentos()->attach($departamento);
            }
        }


       /*  echo $idempresa;
        var_dump($name_departamentos);
*/
        if(request::ajax()){
            // return $message;
            return response()->json([
                'id'  => $empresa->id,
                'name_empresa'=> $empresa->name_empresa

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
        //
        $empresa= Empresa::findOrFail($id);

        $dep=array();
        foreach($empresa->departamentos as $departamento){
            $dep[]=$departamento->id;

        }
        //return view('admin.edit',compact('user'));
        return response()->json([
            'id'  => $empresa->id,
            'name_empresa' => $empresa->name_empresa,
            'rut_empresa' => $empresa->rut_empresa,
            'direccion'=>$empresa->direccion,
            'departamentos'=>$dep,




        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditEmpresaRequest $request, $id)
    {
        //
        $input = $request->except(['name_departamento']);
        $empresa= Empresa::findOrFail($id);
        $empresa->fill($input);

        $empresa->save();
        if(!empty($request->name_departamento)){
            $empresa->departamentos()->sync($request->name_departamento);

        }else{
            $empresa->departamentos()->detach();
        }

        //var_dump($request->name_departamento);
        return response()->json([
            'name_empresa'  => $empresa->name_empresa,

        ]);
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
        $empresa= Empresa::findOrFail($id);
        //User::destroy($id);
        $empresa->delete();

        $message=$empresa->name_empresa.' fue eliminado';
        if(request::ajax()){
            // return $message;
            return response()->json([
                'id'  => $id,
                'message' => $message,
                'name_empresa' => $empresa->name_empresa
            ]);

        }
        Session::flash('message',$message);
        //return redirect()->route('admin.users.index');
    }

    public function updatePaneles(){
// recarga el div del paneles para actualizar los datos con ajax
        $empresas= Empresa::orderBy('id','DES')
            ->paginate(9);


        return view('admin.empresas.partials.paneles',compact('empresas'));

    }
}
