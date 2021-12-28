@extends('layaouts.plantilla')
@section('contenido')

<div class="container col-md-7">
     <div class="card">
         <div class="card-body">
             <h1>Las Calificaciones</h1>
             <form action="" method="get">
                 <select class="form-select" name="cuatri" aria-label="Default select example">
                     <option selected value=0>Selecciona Una Materia</option>
                     @foreach($profeMateria as $mat)
                     <option value={{$mat->idMateria}}>{{$mat->materia}}</option>
                     @endforeach
                 </select>
                 <hr>
                 <button type="submit" class="btn btn-success" name="busca" value="si">Buscar</button>
             </form>
         </div>
     </div>
     <hr>
     <div class="card">
         <div class="card-body">
              <form action="{{route('docente.store')}}" method="post">
                  @csrf
                  <table class="table table-striped table-hover">
                      <thead>
                          <tr>
                              <th>Nombre</th>
                              <th>Calificacion</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(!empty($alumno[0]))
                             @foreach($alumno as $a)
                                 <tr>
                                     <th>{{$a->name}}</th>
                                     <th>
                                         <input type="text" name="id[]" value="{{$a->id}}">
                                         <input type="text" name="calif[]">
                                     </th>
                                 </tr>
                             @endforeach
                          @endif
                      </tbody>
                  </table>
                  <button type="submit" class="btn btn-success">Calificar</button>
              </form>
         </div>
     </div>
</div>

@stop