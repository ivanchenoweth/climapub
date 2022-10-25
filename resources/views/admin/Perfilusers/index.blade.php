@extends('layouts.appcatalogos')
@section('content')
<div class="container">
@include('include.formmensajes')
<a href="{{ url('/admin/Perfilusers/create') }}" 
    style='background-color:#DC7F37;border:none' 
    class="btn btn-success"> Agregar Nuevo Perfil de Usuario </a>
<br>
<br>
<table class="table table-light">
  <thead class="thead-light">
	<tr>
		<th>ID</th>
		<th>Cve de Perfil</th>
    <th>Descripción</th>
    <th>Activo</th>		
	</tr>
  </thead>
  <tbody>
  @foreach ($Perfilusers as $Perfiluser)
	<tr>
		<td>{{ $Perfiluser->id}}</td>
		<td>{{ $Perfiluser->cve_perfil_usuario}}</td>
    <td>{{ $Perfiluser->descripcion}}</td>    
    <td>
    <?php
        if ($Perfiluser->activo) 
        {echo " &#10004 ";
        } else 
        { 
          echo " x ";
        };
      ?>
    </td>
		<td>
        <a href="{{ url('/admin/Perfilusers/'.$Perfiluser->id.'/edit') }}" class="btn btn-warning"> Editar
        </a>
        |
        <form action="{{ url('/admin/Perfilusers/'.$Perfiluser->id)}}" class="d-inline" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('DELETE') }}
            <input type="submit" onclick="return confirm('¿Quieres borrar el registro con ID={{$Perfiluser->id}}?')" 
	        value="Borrar" class="btn btn-danger">
        </form>
        </td>
	</tr>
  @endforeach
  </tbody>
</table>
{!! $Perfilusers->links() !!}
</div>
@endsection