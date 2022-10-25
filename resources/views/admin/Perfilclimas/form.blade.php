<h1> {{$modo}} Perfil de Clima Organizacional</h1>
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
    $perfilclimas['descripcion']        = $oldd['descripcion'];    
    $perfilclimas['pregunta_inicio']    = $oldd['pregunta_inicio'];
    $perfilclimas['pregunta_fin']       = $oldd['pregunta_fin'];
    $perfilclimas['ponderacion_1']      = $oldd['ponderacion_1'];
    $perfilclimas['ponderacion_2']      = $oldd['ponderacion_2'];
    $perfilclimas['ponderacion_3']      = $oldd['ponderacion_3'];
    $perfilclimas['ponderacion_4']      = $oldd['ponderacion_4'];
    $perfilclimas['porcentaje_minimo']  = $oldd['porcentaje_minimo'];    
    $perfilclimas['activo'] = $oldd['activao'];
}
?>
<br>
<div class="form-group">
<label> Clave del Perfil de Clima Organizacional </label>
<input type="text" size="40" class="form-control" class="d-inline" 
    name="cve_perfil_clima" id="cve_perfil_clima" 
    value="{{ $perfilclimas->cve_perfil_clima }}">
<br>
<label> Descripcion del Perfil </label>
<input type="text" size="40" class="form-control" class="d-inline" 
    name="descripcion" id="descripcion" 
    value="{{ $perfilclimas->descripcion }}">
<br>
<label> Número de Pregunta Inicial </label>
<input type="text" size="3" class="form-control" class="d-inline" 
    name="pregunta_inicio" id="pregunta_inicio" 
    value="{{ $perfilclimas->pregunta_inicio }}">
<br>
<label> Número de Pregunta Final </label>
<input type="text" size="3" class="form-control" class="d-inline" 
    name="pregunta_fin" id="pregunta_fin" 
    value="{{ $perfilclimas->pregunta_fin }}">
<br>
<label> Ponderación 1 </label>
<input type="text" size="3" class="form-control" class="d-inline" 
    name="ponderacion_1" id="ponderacion_1" 
    value="{{ $perfilclimas->ponderacion_1 }}">
<br>
<label> Ponderación 2 </label>
<input type="text" size="3" class="form-control" class="d-inline" 
    name="ponderacion_2" id="ponderacion_2" 
    value="{{ $perfilclimas->ponderacion_2 }}">
<br>
<br>
<label> Ponderación 3 </label>
<input type="text" size="3" class="form-control" class="d-inline" 
    name="ponderacion_3" id="ponderacion_3" 
    value="{{ $perfilclimas->ponderacion_3 }}">
<br>
<br>
<label> Ponderación 4 </label>
<input type="text" size="3" class="form-control" class="d-inline" 
    name="ponderacion_4" id="ponderacion_4" 
    value="{{ $perfilclimas->ponderacion_4 }}">
<br>
<br>
<label> Porcentaje Mínimo </label>
<input type="text" size="3" class="form-control" class="d-inline" 
    name="porcentaje_minimo" id="porcentaje_minimo" 
    value="{{ $perfilclimas->porcentaje_minimo }}">
<br>
<label for="activo"> Activo </label>
<input onInput="jsactiva();" type="checkbox" id="activa" name="activa" 
    value="{{ $perfilclimas->activo }}"
<?php
    if ($perfilclimas->activo) echo " checked "
?>
> 
<br>
@include('include.grabarbtn')
<a href="{{ url('/admin/Perfilclimas') }}" 
    style='background-color:#DC7F37;border:none' 
    class="btn btn-primary"  > Regresar </a>
<br>
<input type="hidden" id="activao" name= "activao" 
    value="{{ $perfilclimas->activo }}">
</div>
@include('include.jsactiva')