<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        
        return view('profe.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //devolver las materias que va impartir el docente
        $id = session("id");
        $profeMateria = DB::table('materias')
        ->join('profeMateria', 'profeMateria.idMateria', '=', 'materias.id')
        ->where('profeMateria.idUser', '=', $id)->get();
        //dump($profeMateria);

        if(isset($_GET['cuatri']) && $_GET['cuatri'] !=0 && $_GET['busca'] == "si"){
            //dump('muestra');
            $alumno = DB::table('alumnoMateria')
            ->join('users', 'alumnoMateria.idAlumno', '=', 'users.id')
            ->where('alumnoMateria.idSemestre', '=', $_GET['cuatri'])->paginate(10);
            //dump($alumno);
        }else{
            $alumno[]=0;
        }

        return view('profe.create', compact('profeMateria', 'alumno'));
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
        $calif = $request->input('calif');
        $id = $request->input('id');
        foreach($id as $key => $eva){
            if($calif[$key] != null){
                DB::table('alumnoMateria')
                ->where('idAlumno', '=', $eva)
                ->update(['calif' => $calif[$key]]);
            }
        }
        dump($calif,$id);

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
        //mostrar las materia a cursar
        $camiones = DB::table('camiones')->get(); 

         //crear un join para verificacion de las materia que se le asignan al profesor
         $usCamion = DB::table('camiones')
         ->join('usCamion', 'usCamion.idCamion', '=', 'camiones.id')
         ->where('usCamion.idUsuario', '=', $id)->get();

         dump($camiones,$usCamion);

        //validamos que exista la variable guardar y que tenga el valor de si
        //validar el arreglo que no venga solo
        if(isset($_GET['guardar']) && $_GET["guardar"] =="si" && !empty($_GET['idMat'])){
            foreach($_GET['idMat'] as $val){
                //verificacion de las materias que ya se lleavan
                $resp = $usCamion->where('idCamion', $val)->first();
                //verificacion de que no se encuentre registrada una materia
                if(!$resp){
                 //verificacion de que el arreglo no esta vacio
                 if(!empty($_GET['idMat'])){
                     DB::table('usCamion')->insert([
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
                    DB::table('usCamion')
                    ->where('id', '=', $val)
                    ->delete();
               }
           }
       }
       return view('profe.edit', compact('camiones', 'usCamion'));
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
