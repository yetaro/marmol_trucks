<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index(){
        return view('index');//muestra el menu (login)
    }

    public function login(){
        return view('login');
    }

    public function datos(Request $request){
       $request->validate([
           'email'=>'required',
           'password'=>'required',
           'captcha'=>'required|captcha',
       ]);


        $credentials = $request->only('email', 'password');
        //dump($credentials); vereficar que realmente este devolviendo algo
        $usr = $request->only('email');
        $res = DB::table('users')->where('email', '=', $usr)->first();

        session(['id'=>$res->id]);

        if(Auth::attempt($credentials)){
           return redirect(route('menulog'))->with('nom',$res->name);
        }else{
            return redirect(route('login'));
        }
    }

    public function menulog(Request $request){
        //recupera el nombre de la url
        //$nom = $request->input('nom');
        $id = session('id');
        //recupera el id del nombre
        $id = DB::table('users')->where('id', '=', $id)->first();

        $camiones = DB::table('camiones')
        ->join('usca', 'usca.idCamion', 'camiones.id')
        ->where('usca.idUsuario', '=', $id->id)->get();
        //$materias = DB::table('materias')->get();
        return view('menulog',[
            'camiones'=>$camiones
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }

    public function layaout(){
        return view('layaouts.plantilla');
    }
}
