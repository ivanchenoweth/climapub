<h1> {{$modo}} Perfil de Usuario</h1>
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
    $perfilusers['cve_perfil_usuario'] = $oldd['cve_perfil_usuario'];
    $perfilusers['descripcion'] = $oldd['descripcion'];    
    //$perfilusers['activo'] = $oldd['activo'];
    $perfilusers['activo'] = $oldd['activao'];
}
?>
<br>
<div class="form-group">
<label> Perfil de Usuario:</label>
<input type="text" size="3" class="form-control" class="d-inline" name="cve_perfil_usuario" id="cve_perfil_usuario" 
    value="{{ $perfilusers->cve_perfil_usuario }}">
<br>
<label> Descripcion del Perfil </label>
<input type="text" size="40" class="form-control" class="d-inline" name="descripcion" id="descripcion" 
    value="{{ $perfilusers->descripcion }}">
<br>
<label for="activo"> Activo </label>
<input onInput="jsactiva();" type="checkbox" id="activa" name="activa" 
    value="{{ $perfilusers->activo }}"
<?php
    if ($perfilusers->activo) echo " checked "
?>
> 
<br>
@include('include.grabarbtn')
<a href="{{ url('/admin/Perfilusers') }}" 
    style='background-color:#DC7F37;border:none' 
    class="btn btn-primary"  > Regresar </a>
<br>
<input type="hidden" id="activao" name= "activao" 
    value="{{ $perfilusers->activo }}">
</div>
@include('include.jsactiva')