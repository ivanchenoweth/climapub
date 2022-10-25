@extends('layouts.appcatalogos')
@section('content')
<div class="container">
@include('include.formmensajes')
<a href="{{ url('/admin/Periodos/create') }}" 
  style='background-color:#DC7F37;border:none' 
  class="btn btn-success"> 
  Agregar Nuevo Periodo </a>
<br>
<br>
<table class="table table-light">
  <thead class="thead-light">
	<tr>
		<th>ID</th>
		<th>Cve de Periodo</th>
    <th>Descripción</th>
    <th>Fecha Inicial</th>
    <th>Fecha Final</th>
    <th>Activo</th>
		<th>Acciones</th>
	</tr>
  </thead>
  <tbody>
  @foreach ($Periodos as $Periodo)
	<tr>
		<td>{{ $Periodo->id}}</td>
		<td>{{ $Periodo->cve_periodo}}</td>
    <td>{{ $Periodo->descripcion}}</td>
    <td>{{ substr($Periodo->fecha_ini,0,10)}}</td>
    <td>{{ substr($Periodo->fecha_fin,0,10)}}</td>
    <td>
    <?php
        if ($Periodo->activo) 
        {echo " &#10004 ";
        } else 
        { 
          echo " x ";
        };
      ?>
    </td>
		<td>
        <a href="{{ url('/admin/Periodos/'.$Periodo->id.'/edit') }}" class="btn btn-warning"> Editar
        </a>        |
        <form action="{{ url('/admin/Periodos/'.$Periodo->id)}}" class="d-inline" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('DELETE') }}
            <input type="submit" onclick="return confirm('¿Quieres borrar el registro con ID={{$Periodo->id}}?')"
	        value="Borrar" class="btn btn-danger">
        </form>
        </td>
	</tr>
  @endforeach
  </tbody>
</table>
{!! $Periodos->links() !!}
</div>
@endsection