@extends('layaouts.plantilla')

@section('contenido')
<div class="row justify-content-center">
  <divm class="col-6">
     <h1>Usuario Logeado: {{Auth::user()->name}}</h1>
     <ul>
        @foreach ($camiones as $c)
         <li>Tipo De Camion: {{$c->tipodecamion}}</li>
         @endforeach
     </ul>
  </div>

</div>
@stop 