<?php

namespace sysvale\Http\Controllers\Admin;

//use Illuminate\Http\Request;

use sysvale\Departamento;
use sysvale\Http\Controllers\Controller;
use sysvale\Http\Requests;
use Illuminate\Support\Facades\Request;
use sysvale\Http\Requests\CreateDepartamentoRequest;
use sysvale\Http\Requests\EditDepartamentoRequest;

class DepartamentoController extends Controller
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
        $departamentos=Departamento::orderBy('id','des')
        ->paginate('9');

        return view("admin.departamentos.index",compact("departamentos"));

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
    public function store(CreateDepartamentoRequest $request)
    {
        //
        $departamento = Departamento::create($request->all());
         if(request::ajax()){

             return response()->json([
               'name_departamento'=>$departamento->name_departamento,

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
        $departamento= Departamento::findOrFail($id);

        //return view('admin.edit',compact('user'));
        return response()->json([

            'name_departamento' => $departamento->name_departamento,


        ]);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditDepartamentoRequest $request, $id)
    {
        //
        $departamento= Departamento::findOrFail($id);
        $departamento->fill(Request::all());
        //$user->fill($request->all());
        $departamento->save();
        return response()->json([
            'name_departamento'  => $departamento->name_departamento,

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
        $departamento= Departamento::findOrFail($id);
        //User::destroy($id);
        $departamento->delete();


        if(request::ajax()){
            // return $message;
            return response()->json([

                'name_departamento' => $departamento->name_departamento
            ]);

        }

        //return redirect()->route('admin.users.index');
    }

    public function updatePaneles(){

        $departamentos= Departamento::orderBy('id','DES')
            ->paginate(9);


        return view('admin.departamentos.partials.paneles',compact('departamentos'));
    }
}
