<h1> {{$modo}} Plantillas</h1>
@include('include.formerrors')
<?php
if (count($errors)>0) 
{
    //dd($errors);
    unset( $errors); 
    $data = $request->session()->all();
    $oldd = $data['_old_input'];
    if (! isset($oldd['activo']))
    {
        $oldd['activo'] = false;
    }
    $plantillas['num_emp']              = $oldd['num_emp'];
    $plantillas['nombre_completo']      = $oldd['nombre_completo'];
    $plantillas['sexo']                 = $oldd['sexo'];
    $plantillas['nivel']                = $oldd['nivel'];
    $plantillas['dependencia']          = $oldd['dependencia'];
    $plantillas['unidad_admva']         = $oldd['unidad_admva'];
    $plantillas['puesto']               = $oldd['puesto'];
    $plantillas['municipio']            = $oldd['municipio'];
    $plantillas['plaza']                = $oldd['plaza'];
    $plantillas['tipo_plaza']           = $oldd['tipo_plaza'];
    $plantillas['fuente']               = $oldd['fuente'];
    $plantillas['plantilla']            = $oldd['plantilla'];
    $plantillas['tipo_org']             = $oldd['tipo_org'];
    $plantillas['num_plaza']            = $oldd['num_plaza'];
    $plantillas['activo']               = $oldd['activo'];
}
?>
<br>
<div class="form-group">
<label  class="d-inline" for="num_emp"> Número de Empleado: </label>
<input size="10" type="text"  class="d-inline" class="form-control" name="num_emp" id="num_emp" 
    value="{{ $plantillas->num_emp }}">
<br>
<label  class="d-inline" for="nombre_completo"> Nombre Completo del Empleado (primero los apellidos): </label>
<input size="40" type="text"  class="d-inline" class="form-control"
    name="nombre_completo" id="nombre_completo" 
    value="{{ $plantillas->nombre_completo }}">
<br>
<label  class="d-inline" for="sexo"> Sexo: </label>
<input size="10" type="text"  class="d-inline" class="form-control"
    name="sexo" id="sexo" 
    value="{{ $plantillas->sexo }}">
<br>
<label  class="d-inline" for="nivel"> Nivel: </label>
<input size="5" type="text"  class="d-inline" class="form-control"
    name="nivel" id="nivel" 
    value="{{ $plantillas->nivel }}">
<br>
<label  class="d-inline" for="dependencia"> Dependencia o Entidad: </label>
<input size="80" type="text"  class="d-inline" class="form-control"
    name="dependencia" id="dependencia" 
    value="{{ $plantillas->dependencia }}">
<br>
<label  class="d-inline" for="unidad_admva"> Unidad Administrativa: </label>
<input size="80" type="text"  class="d-inline" class="form-control"
    name="unidad_admva" id="unidad_admva" 
    value="{{ $plantillas->unidad_admva }}">
<br>
<label  class="d-inline" for="puesto"> Puesto: </label>
<input size="80" type="text"  class="d-inline" class="form-control"
    name="puesto" id="puesto" 
    value="{{ $plantillas->puesto }}">
<br>
<label  class="d-inline" for="municipio"> Municipio: </label>
<input size="80" type="text"  class="d-inline" class="form-control"
    name="municipio" id="municipio" 
    value="{{ $plantillas->municipio }}">
<br>
<label  class="d-inline" for="plaza"> Plaza: </label>
<input size="10" type="text"  class="d-inline" class="form-control"
    name="plaza" id="plaza" 
    value="{{ $plantillas->plaza }}">
<br>
<label  class="d-inline" for="tipo_plaza"> Tipo de Plaza: </label>
<input size="60" type="text"  class="d-inline" class="form-control"
    name="tipo_plaza" id="tipo_plaza" 
    value="{{ $plantillas->tipo_plaza }}">
<br>
<label  class="d-inline" for="fuente"> Fuente: </label>
<input size="10" type="text"  class="d-inline" class="form-control"
    name="fuente" id="fuente" 
    value="{{ $plantillas->fuente }}">
<br>
<label  class="d-inline" for="plantilla"> Plantilla: </label>
<input size="10" type="text"  class="d-inline" class="form-control"
    name="plantilla" id="plantilla" 
    value="{{ $plantillas->plantilla }}">
<br>
<label  class="d-inline" for="tipo_org"> Tipo de Organismo: </label>
<input size="20" type="text"  class="d-inline" class="form-control"
    name="tipo_org" id="tipo_org" 
    value="{{ $plantillas->tipo_org }}">
<br>
<label  class="d-inline" for="num_plaza"> Número de Plaza: </label>
<input size="5" type="text"  class="d-inline" class="form-control"
    name="num_plaza" id="num_plaza" 
    value="{{ $plantillas->num_plaza }}">
<br>
<label for="activo"> Activo </label>
<input onInput="jsactiva();" type="checkbox" id="activa" name="activa" 
    value="{{ $plantillas->activo }}"
<?php
    if ($plantillas->activo) echo " checked "
?>
> 
<br>
@include('include.grabarbtn')
<a href="{{ url('/admin/Plantillas') }}" 
    style='background-color:#DC7F37;border:none' 
    class="btn btn-primary"  > Regresar </a>
<br>
<input type="hidden" id="activao" name= "activao" value="{{ $plantillas->activa }}">
</div>
@include('include.jsactiva')