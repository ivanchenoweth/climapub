@extends('layouts.appcatalogos')
@section('content')
<div class="container">
<form action="{{ url('/admin/Climas/search') }}" 
    method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('POST')}}
    @include('include.formmensajes')
    <?php
        if( Session::has('num_emp')) {
            $clima->plantilla->first()->num_emp = Session::get('num_emp');
            //dd($clima->plantilla->first()->num_emp);        
        }
        if( Session::has('dependencia')) {
            $clima->plantilla->first()->dependencia = Session::get('dependencia');
        }
    ?>
<br>
<div class="form-group">
<label  class="d-inline" for="dependencia"> Dependencia: </label>
<select  class="d-inline" lenght="40" class="form-control" name="dependencia" id="dependencia">
     @foreach( $dependencias as $dep)
     <option size="40" value="{{ $dep->dependencia }}" 
       <?php   
           //dd($clima->plantilla);
           if (isset($clima->plantilla->first()->dependencia)) {
                $clima->plantilla->first()->dependencia = trim( $clima->plantilla->first()->dependencia); }
            else {           
                $clima->plantilla->first()->dependencia = old('dependencia');                
            }
            if( $dep->dependencia == $clima->plantilla->first()->dependencia) 
                echo 'selected="selected"'
        ?>
       > 
       {{ $dep->dependencia }}
     </option>
     @endforeach
</select>
<br>
<label  class="d-inline" for="num_emp"> Número de Empleado: </label>
<input onInput="jsemp_dep()" size="10" type="text"  class="d-inline" class="form-control" name="num_emp" id="num_emp" 
    value="{{ $clima->plantilla->first()->num_emp }}">
<br>
<input 
    type="image" 
    src= "{{URL::asset('/images/boton_buscar.png')}}" 
    class="btn btn-success"
    style='background-color:#FFFFFF;border:none'
    >
<br>
</form>
</div>
@endsection