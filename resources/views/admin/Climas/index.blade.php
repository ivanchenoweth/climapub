@extends('layouts.appcatalogos')
@section('content')
<div class="container">
@include('include.formmensajes')
<a href="{{ url('/admin/Climas/create') }}" 
  style='background-color:#DC7F37;border:none' 
  class="btn btn-success"> Agregar Nuevo Formato de Clima Organizacional </a>
<br>
<br>
<table class="table table-light">
  <thead class="thead-light">
	<tr>
		<th>ID</th>
    <th>Periodo</th>
    <th>ID Pla.</th>    
    <th>Num.Emp</th>
    <th>Nombre</th>
    <th>Dependencia o Entidad</th>
    <th>Unidad Administrativa</th>
    <th>Area</th>
    <th>Fecha</th>
    <th>Respuestas</th>
    <th>Activo</th>
	</tr>
  </thead>
  <tbody>
  @foreach ($climas as $clima)
	<tr>
		<td>{{ $clima->id}}</td>    
    <td>      
      <?php        
        foreach ($periodos as $periodo) {
           //dd($periodo);
           if ($periodo->cve_periodo == $clima->fk_cve_periodo) 
           {
             echo $periodo->descripcion;
           };
          };         
      ?>
    
    <td>{{ $clima->fk_id_plantillas }}</td></td>    
    
    <td>{{ $clima->plantilla->first()->num_emp}}</td>
    <td>{{ $clima->plantilla->first()->nombre_completo}}</td>
    <td>{{ $clima->plantilla->first()->dependencia}}</td>
    <td>{{ $clima->plantilla->first()->unidad_admva}}</td>


    <td>{{ $clima->area}}</td>
    <td>{{ substr($clima->fecha,0,10)}}</td>
    <td>{{ $clima->r1.$clima->r2.$clima->r3.$clima->r4.$clima->r5.$clima->r6.$clima->r7.$clima->r8.$clima->r9.
      $clima->r10.$clima->r11.$clima->r12.$clima->r13.$clima->r14.$clima->r15.$clima->r16.$clima->r17.$clima->r18.$clima->r19.
      $clima->r20.$clima->r21.$clima->r22.$clima->r23.$clima->r24.$clima->r25.$clima->r26.$clima->r27.$clima->r28.$clima->r29.
      $clima->r30.$clima->r31.$clima->r32.$clima->r33.$clima->r34.$clima->r35.$clima->r36.$clima->r37.$clima->r38.$clima->r39.
      $clima->r40.$clima->r41.$clima->r42.$clima->r43.$clima->r44.$clima->r45.$clima->r46.$clima->r47.$clima->r48.$clima->r49.
      $clima->r50.$clima->r51.$clima->r52.$clima->r53.$clima->r54.$clima->r55.$clima->r56.$clima->r57.$clima->r58.$clima->r59.
      $clima->r60.$clima->r61.$clima->r62.$clima->r63.$clima->r64.$clima->r65.$clima->r66.$clima->r67.$clima->r68.$clima->r69.
      $clima->r70.$clima->r71.$clima->r72.$clima->r73.$clima->r74.$clima->r75.$clima->r76.$clima->r77.$clima->r78.$clima->r79.
      $clima->r80.$clima->r81.$clima->r82.$clima->r83.$clima->r84.$clima->r85.$clima->r86.$clima->r87.$clima->r88.$clima->r89.
      $clima->r90.$clima->r91.$clima->r92.$clima->r93.$clima->r94.$clima->r95.$clima->r96.$clima->r97.$clima->r98.$clima->r99.
      $clima->r100.$clima->r101.$clima->r102.$clima->r103.$clima->r104
    }}</td>
    <td>
      <?php
        if ($clima->activo) 
        {echo " &#10004 ";
        } else 
        { 
          echo " x ";
        };
      ?>
    </td>
		<td>
        <a href="{{ url('/admin/Climas/'.$clima->id.'/edit') }}" class="btn btn-warning"> Editar
        </a>
        <form action="{{ url('/admin/Climas/'.$clima->id)}}" 
            class="d-inline" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('DELETE') }}
            <input type="submit" onclick="return confirm('¿Quieres borrar el registro con ID={{$clima->id}}?')" 
	        value="Borrar" class="btn btn-danger">
        </form>
        </td>
	</tr>
  @endforeach
  </tbody>
</table>
{!! $climas->links() !!}
</div>
@endsection