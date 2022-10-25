@extends('layouts.appcatalogos')
@section('content')
<div class="container">
@include('include.formmensajes')
<a href="{{ url('/admin/Perfilclimas/create') }}" 
    style='background-color:#DC7F37;border:none' 
    class="btn btn-success"> Agregar Nuevo Perfil de Clima </a>
<br>
<br>
<table class="table table-light">
  <thead class="thead-light">
	<tr>
		<th>ID</th>		
    <th>Cve.</th>
    <th>Descripción</th>
    <th>P. Inicial</th>
    <th>P. Final</th>
    <th>Pond.1</th>
    <th>Pond.2</th>
    <th>Pond.3</th>
    <th>Pond.4</th>
    <th>% Mín.</th>
    <th>Activo</th>		
	</tr>
  </thead>
  <tbody>
  @foreach ($Perfilclimas as $Perfilclima)
	<tr>
		<td>{{ $Perfilclima->id}}</td>		
    <td>{{ $Perfilclima->cve_perfil_clima}}</td>
    <td>{{ $Perfilclima->descripcion}}</td>
    <td>{{ $Perfilclima->pregunta_inicio}}</td>
    <td>{{ $Perfilclima->pregunta_fin}}</td>
    <td>{{ $Perfilclima->ponderacion_1}}</td>
    <td>{{ $Perfilclima->ponderacion_2}}</td>
    <td>{{ $Perfilclima->ponderacion_3}}</td>
    <td>{{ $Perfilclima->ponderacion_4}}</td>
    <td>{{ $Perfilclima->porcentaje_minimo}}</td>
    <td>
    <?php
        if ($Perfilclima->activo) 
        {echo " &#10004 ";
        } else 
        { 
          echo " x ";
        };
      ?>
    </td>
		<td>
        <a href="{{ url('/admin/Perfilclimas/'.$Perfilclima->id.'/edit') }}" class="btn btn-warning"> Editar
        </a>
        |
        <form action="{{ url('/admin/Perfilclimas/'.$Perfilclima->id)}}" class="d-inline" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('DELETE') }}
            <input type="submit" 
            onclick="return confirm('¿Quieres borrar el registro con ID={{$Perfilclima->id}}?')" 
	        value="Borrar" class="btn btn-danger">
        </form>
        </td>
	</tr>
  @endforeach
  </tbody>
</table>
{!! $Perfilclimas->links() !!}
</div>
@endsection