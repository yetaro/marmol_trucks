@extends('layaouts.plantilla')
@section('contenido')

<h1>Nombre: {{Auth::user()->name}}</h1>
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
                 <button type="submit" class="btn btn-primary" name="guardar" value="si">Guardar</button>
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
                             <th>Tipo De Camiones</th>
                             
                         </tr>
                         <tbody>
                             @foreach($usCamion as $uc)
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
                 <button type="submit" class="btn btn-danger" name="eliminar" value="eliminar">Eliminar</button>
             </form>
        </div>
    </div>

</div>
@stop