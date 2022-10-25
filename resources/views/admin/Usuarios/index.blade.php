@extends('layouts.appcatalogos')
@section('content')
<div class="container">
@include('include.formmensajes')
<a href="{{ url('/admin/Usuarios/create') }}"
   style='background-color:#DC7F37;border:none'  
   class="btn btn-success"> Agregar Nuevo Usuario </a>
<br>
<br>
<table class="table table-light">
  <thead class="thead-light">
	<tr>
		<th>ID</th>
		<th>Perfil</th>
    <th>Nombre</th>
    <th>Correo</th>    
    <th>Activo</th>
	</tr>
  </thead>
  <tbody>
  @foreach ($usuarios as $usuario)
	<tr>
		<td>{{ $usuario->id}}</td>
		<td>      
      <?php
        foreach ($perfil_usuarios as $perfil) {
           if ($perfil->cve_perfil_usuario == $usuario->fk_cve_perfil_usuario) 
           {
             echo $perfil->descripcion;
           };
          };
      ?>
    </td>
    <td>{{ $usuario->name}}</td>
    <td>{{ $usuario->email}}</td>
    <td>
    <?php
        if ($usuario->activo) 
        {echo " &#10004 ";
        } else 
        { 
          echo " x ";
        };
      ?>
    </td>
		<td>
        <a href="{{ url('/admin/Usuarios/'.$usuario->id.'/edit') }}" class="btn btn-warning"> Editar
        </a>
        <form action="{{ url('/admin/Usuarios/'.$usuario->id)}}" class="d-inline" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('DELETE') }}
            <input type="submit" onclick="return confirm('¿Quieres borrar el registro con ID={{$usuario->id}}?')" 
	        value="Borrar" class="btn btn-danger">
        </form>
        </td>
	</tr>
  @endforeach
  </tbody>
</table>
{!! $usuarios->links() !!}
</div>
@endsection