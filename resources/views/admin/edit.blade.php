@extends('layaouts.plantilla')
@section('contenido')

<h3 class="h1">El Usuario A Asignar Es: {{$data->name}}</h3>
<div class="container col-md-7">
    <div class="card">
        <div class="card-body">
             <form method="GET" action="">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th>Tipo De Camiones</th>
                            
                         </tr>
                         <tbody>
                             @foreach($camiones as $c)
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="idMat[]" value="{{$c->id}}" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$c->tipodecamion}}
                                            </label>
                                        </div>
                                    </th>
                                    
                                </tr>
                             @endforeach
                         </tbody>
                     </thead>
                 </table>
                 <button type="submit" class="btn btn-primary" name="guardar" value="si">Guardar Camion</button>
             </form>
        </div>
    </div>
    <hr>
    <div class="card">
       <div class="card-body">
           <form method="GET" action="">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th>Camiones Asignados</th>
                             
                         </tr>
                         <tbody>
                             @foreach($usca as $uc)
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="idMat[]" value="{{$uc->id}}" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$uc->tipodecamion}}
                                            </label>
                                        </div>
                                    </th>
                                    
                                </tr>
                             @endforeach
                         </tbody>
                     </thead>
                 </table>
                 <button type="submit" class="btn btn-danger" name="eliminar" value="eliminar">Eliminar Camion</button>
             </form>
        </div>
    </div>

</div>
 
@stop