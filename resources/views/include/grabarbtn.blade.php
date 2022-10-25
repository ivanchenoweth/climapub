<?php
    $mod= "Agregar Datos";
    if ($modo == "Editar")
    {
       $mod = "Grabar Datos";
    }
    $hab = " enabled ";
    if (!isset($habilitado))
    {
        $habilitado= "Si";
    }
    if ($habilitado == "No")
    {
        $hab= " disabled ";
    }
?>
<input 
    oninput="myFunc()" 
    id="btn_ok" 
    name="btn_ok" <?php echo $hab; ?> 
    type="submit" 
    style='background-color:#DC7F37;border:none'
    class="btn btn-success" 
    value=" <?php echo $mod; ?>"
    >&nbsp&nbsp