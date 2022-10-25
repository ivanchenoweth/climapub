<h2> {{$modo}} Formato Clima Organizacional para el periodo {{$des_uper}}</h2>
@include('include.formerrors')
<br>
<div class="form-group">

<input type="hidden" id="fk_cve_periodo"    name= "fk_cve_periodo" value="{{ $climas->fk_cve_periodo }}">
<input type="hidden" id="activao"           name= "activao"             value="{{ $climas->activo }}">
<input type="hidden" id="fk_id_plantillas"  name= "fk_id_plantillas"    value="{{ $climas->fk_id_plantillas }}">
<input type="hidden" id="num_emp"           name= "num_emp" value="{{ $climas->plantilla->first()->num_emp }}">
<input type="hidden" id="nombre_completo"   name= "nombre_completo" value="{{ $climas->plantilla->first()->nombre_completo }}">
<input type="hidden" id="dep_o_ent"         name= "dep_o_ent" value="{{ $climas->plantilla->first()->dependencia }}">
<input type="hidden" id="unidad_admva"      name= "unidad_admva" value="{{ $climas->plantilla->first()->unidad_admva }}">
<?php
/*
<label  class="d-inline" for="num_emp"> Número de Empleado: {{ $climas->plantilla->first()->num_emp }}</label>
<br>
<label  class="d-inline" for="nombre_completo"> 
    Nombre del Empleado: 
    {{ $climas->plantilla->first()->nombre_completo }} </label>
<br>
<label class="d-inline" for="dep_o_ent"> Dependencia o Entidad: {{ $climas->plantilla->first()->dependencia }} </label>
*/
?>
<label class="d-inline" for="unidad_admva"> Unidad Administrativa: {{ $climas->plantilla->first()->unidad_admva }}</label>
<br>
@include('include.climas_preguntas')
<br>
@include('include.grabarbtn')
<a 
    href="{{ url('/cons1') }}"     
    style="border:none" >
    <img 
        src="{{URL::asset('/images/boton_regresar.png')}}" 
        style="border:none"
    >
</a>
</div>
@include('include.jsactiva')