@extends('layaouts.plantilla')

@section('contenido')
<div class="container col-md-5">
        @if($resp ?? '' == "si")
         <p>Registro Guardado Correctamente!!</p>
        @endif
        <h3>Registro De Usuarios</h3>
  <form method="POST" action="{{route('admin.store')}}">
   @csrf
   
   <div class="mb-3">
     <label for="name" class="form-label">Nombre:</label>
     <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   </div>

   <div class="mb-3">
     <label for="email" class="form-label">Email:</label>
     <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   </div>

   <div class="mb-3">
     <label for="password" class="form-label">Password:</label>
     <input type="password" name="password" class="form-control" id="exampleInputPassword1">
   </div>

   <button type="submit" class="btn btn-primary">Guardar</button>

  </form>
</div>

@stop