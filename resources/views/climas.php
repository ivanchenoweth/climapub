@extends('layouts.app')
@section('content')
<?php
    use App\Http\Controllers\ClimasController;
?>
  <div class="container">
     @if($success)
          <div class="alert alert-success alert-block">
               <button type="button" class="close" data-dismiss="alert">×</button>
               <strong>{{ $success }}</strong>
          </div>
     @endif
    <div>Datos del Usuario=>Nombre: {{$usuario}} , Correo: {{$email}}
    </div>
    <table class="table table-bordered table-striped">
    <tr>
        <th>No.</th>
        <th>Periodo</th>
	   <th>Num.Emp</th>
        <th>Nombre</th>
        <th>Dependencia o Entidad</th>
        <th>Unidad Administrativa</th>
        <th>Area</th>
    </tr>
    @foreach($climas as $clima)
    <tr> 
         <td>{!! $climas->id !!}</td>
         <td>      
         <?php
            foreach ($periodos as $periodo) 
            {
              if ($periodo->cve_periodo == $clima->fk_cve_periodo) 
               {
                   echo $periodo->descripcion;
              };
            };
        ?>
        </td>   
        <td>{{ $clima->plantilla_num_emp}}</td>
        <td>{{ $clima->plantilla_nombre_completo}}</td>
        <td>{{ $clima->plantilla_dependencia}}</td>
        <td>{{ $clima->plantilla_unidad_admva}}</td>
        <td>{{ $clima->area}}</td>
         </tr>
    @endforeach    
    </table>
  </div>
 @endsection