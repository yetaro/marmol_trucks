@extends('layaouts.plantilla')

@section('contenido')
<div class="container col-md-5">
        @if($resp ?? '' == "si")
         <p>Registro Guardado Correctamente!!</p>
        @endif
        <h3>Registro De Camiones</h3>
  <form method="POST" action="{{route('adminc.store')}}">
   @csrf
   
   <div class="mb-3">
     <label for="tipodecamion" class="form-label">Tipo De Camion:</label>
     <input type="text" name="tipodecamion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   </div>


   <button type="submit" class="btn btn-primary">Guardar</button>

  </form>
</div>

@stop