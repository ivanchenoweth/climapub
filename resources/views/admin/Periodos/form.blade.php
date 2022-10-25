<h1> {{$modo}} Periodo</h1>
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
    $Periodo['cve_periodo'] = $oldd['cve_periodo'];
    $Periodo['descripcion'] = $oldd['descripcion'];
    $Periodo['fecha_ini'] = $oldd['fecha_ini'];
    $Periodo['fecha_fin'] = $oldd['fecha_fin'];
    $Periodo['activo'] = $oldd['activo'];    
}
?>
<br>
<div class="form-group">
<label for="periodo"> Clave del Periodo (de 1 a 3 caracteres) </label>
<input type="text" class="form-control" name="cve_periodo" id="cve_periodo" 
    value="{{ $Periodo->cve_periodo }}">
<br>
<label for="periodo"> Descripción del Periodo </label>
<input type="text" class="form-control" name="descripcion" id="descripcion" 
    value="{{ $Periodo->descripcion }}">
<br>
<label for="periodo"> Fecha Inicial </label>
<input type="date" class="form-control" name="fecha_ini" id="fecha_ini" 
    value="{{ \Carbon\Carbon::createFromDate( $Periodo->fecha_ini )->format('Y-m-d') }}">
<br>
<label for="periodo"> Fecha Final </label>
<input type="date" class="form-control" name="fecha_fin" id="fecha_fin" 
    value="{{ \Carbon\Carbon::createFromDate( $Periodo->fecha_fin)->format('Y-m-d') }}">
<br>
<label for="activo"> Activo </label>
<!-- id y name deben ser "activa" para que funcione el java script jsactiva -->
<input onInput="jsactiva();" type="checkbox" id="activa" name="activa" value="{{ $Periodo->activo }}"
<?php
    if ($Periodo->activo) echo " checked "
?>
> 
<br>
@include('include.grabarbtn')
<a href="{{ url('/admin/Periodos') }}" 
    style='background-color:#DC7F37;border:none' 
    class="btn btn-primary"  > Regresar </a>
<br>
<input type="hidden" id="activao" name= "activao">
</div>
@include('include.jsactiva')