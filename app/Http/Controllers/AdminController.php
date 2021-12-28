<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Primera ruta, esta en la carpeta
        return view('admin.index');
        
        
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(isset($_GET['buscar'])){
            $users= DB::table('users')
            ->select('id','name','email')
            ->where('name','LIKE', '%'.trim($_GET['buscar']).'%')
            ->orWhere('id','LIKE', '%'.trim($_GET['buscar']).'%')
            ->orWhere('email','LIKE', '%'.trim($_GET['buscar']).'%')
            ->paginate(7);
        }else{
            $users = DB::table('users')->paginate(7);
        }
        
        //buscar todas los usuarios
        
        return view('admin.create', compact('users'));
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
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        
        DB::table('users')->insert([
          'name'=>$name,
          'email'=>$email,
          'password'=>Hash::make($password)
        ]);
        return view('admin.index')->with('resp', 'si');
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
        $data = DB::table('users')->where('id', '=', $id)->first();
         //mostrar las materia a cursar
        $camiones = DB::table('camiones')->get(); 

         //crear un join para verificacion de las materia que se le asignan al profesor
         $usca = DB::table('camiones')
         ->join('usca', 'usca.idCamion', '=', 'camiones.id')
         ->where('usca.idUsuario', '=', $id)->get();

         //dump($camiones,$usca);

        //validamos que exista la variable guardar y que tenga el valor de si
        //validar el arreglo que no venga solo
        if(isset($_GET['guardar']) && $_GET["guardar"] =="si" && !empty($_GET['idMat'])){
            foreach($_GET['idMat'] as $val){
                //verificacion de las materias que ya se lleavan
                $resp = $usca->where('idCamion', $val)->first();
                //verificacion de que no se encuentre registrada una materia
                if(!$resp){
                 //verificacion de que el arreglo no esta vacio
                 if(!empty($_GET['idMat'])){
                     DB::table('usca')->insert([
                        'idUsuario' => $id,
                        'idCamion' => $val
                     ]);
                   } 
                 }
                }

       }
       //verificar que se activo el boton eliminar
       //verificar que sea igual a eliminar
       //verificar que no venga vacio
       if(isset($_GET['eliminar']) && $_GET['eliminar'] == "eliminar" && !empty($_GET['idMat'])){
           //dump("Dato Eliminado");
           if(!empty($_GET['idMat'])){
               foreach($_GET['idMat'] as $val){
                    DB::table('usca')
                    ->where('id', '=', $val)
                    ->delete();
               }
           }
       }
       return view('admin.edit',['data' => $data],compact('camiones', 'usca'));
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
}
