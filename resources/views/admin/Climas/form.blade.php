<h1> {{$modo}} Formato de Clima Organizacional</h1>
@include('include.formerrors')
<?php
//dd($climas);
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
    
    $climas['fk_id_plantillas'] = $oldd['fk_id_plantillas'];
    $climas['fk_cve_periodo']   = $oldd['fk_cve_periodo'];
    $climas['fecha']            = $oldd['fecha'];
    $climas['area']             = $oldd['area'];
    $climas['r1']               = $oldd['r1'];
    $climas['r2']               = $oldd['r2'];
    $climas['r3']               = $oldd['r3'];
    $climas['r4']               = $oldd['r4'];
    $climas['r5']               = $oldd['r5'];
    $climas['r6']               = $oldd['r6'];
    $climas['r7']               = $oldd['r7'];
    $climas['r8']               = $oldd['r8'];
    $climas['r9']               = $oldd['r9'];
    $climas['r10']              = $oldd['r10'];
    $climas['r11']              = $oldd['r11'];
    $climas['r12']              = $oldd['r12'];
    $climas['r13']              = $oldd['r13'];
    $climas['r14']              = $oldd['r14'];
    $climas['r15']              = $oldd['r15'];
    $climas['r16']              = $oldd['r16'];
    $climas['r17']              = $oldd['r17'];
    $climas['r18']              = $oldd['r18'];
    $climas['r19']              = $oldd['r19'];
    $climas['r20']              = $oldd['r20'];
    $climas['r21']              = $oldd['r21'];
    $climas['r22']              = $oldd['r22'];
    $climas['r23']              = $oldd['r23'];
    $climas['r24']              = $oldd['r24'];
    $climas['r25']              = $oldd['r25'];
    $climas['r26']              = $oldd['r26'];
    $climas['r27']              = $oldd['r27'];
    $climas['r28']              = $oldd['r28'];
    $climas['r29']              = $oldd['r29'];
    $climas['r30']              = $oldd['r30'];
    $climas['r31']              = $oldd['r31'];
    $climas['r32']              = $oldd['r32'];
    $climas['r33']              = $oldd['r33'];
    $climas['r34']              = $oldd['r34'];
    $climas['r35']              = $oldd['r35'];
    $climas['r36']              = $oldd['r36'];
    $climas['r37']              = $oldd['r37'];
    $climas['r38']              = $oldd['r38'];
    $climas['r39']              = $oldd['r39'];
    $climas['r40']              = $oldd['r40'];
    $climas['r41']              = $oldd['r41'];
    $climas['r42']              = $oldd['r42'];
    $climas['r43']              = $oldd['r43'];
    $climas['r44']              = $oldd['r44'];
    $climas['r45']              = $oldd['r45'];
    $climas['r46']              = $oldd['r46'];
    $climas['r47']              = $oldd['r47'];
    $climas['r48']              = $oldd['r48'];
    $climas['r49']              = $oldd['r49'];
    $climas['r50']              = $oldd['r50'];
    $climas['r51']              = $oldd['r51'];
    $climas['r52']              = $oldd['r52'];
    $climas['r53']              = $oldd['r53'];
    $climas['r54']              = $oldd['r54'];
    $climas['r55']              = $oldd['r55'];
    $climas['r56']              = $oldd['r56'];
    $climas['r57']              = $oldd['r57'];
    $climas['r58']              = $oldd['r58'];
    $climas['r59']              = $oldd['r59'];
    $climas['r60']              = $oldd['r60'];
    $climas['r61']              = $oldd['r61'];
    $climas['r62']              = $oldd['r62'];
    $climas['r63']              = $oldd['r63'];
    $climas['r64']              = $oldd['r64'];
    $climas['r65']              = $oldd['r65'];
    $climas['r66']              = $oldd['r66'];
    $climas['r67']              = $oldd['r67'];
    $climas['r68']              = $oldd['r68'];
    $climas['r69']              = $oldd['r69'];
    $climas['r70']              = $oldd['r70'];
    $climas['r71']              = $oldd['r71'];
    $climas['r72']              = $oldd['r72'];
    $climas['r73']              = $oldd['r73'];
    $climas['r74']              = $oldd['r74'];
    $climas['r75']              = $oldd['r75'];
    $climas['r76']              = $oldd['r76'];
    $climas['r77']              = $oldd['r77'];
    $climas['r78']              = $oldd['r78'];
    $climas['r79']              = $oldd['r79'];
    $climas['r80']              = $oldd['r80'];
    $climas['r81']              = $oldd['r81'];
    $climas['r82']              = $oldd['r82'];
    $climas['r83']              = $oldd['r83'];
    $climas['r84']              = $oldd['r84'];
    $climas['r85']              = $oldd['r85'];
    $climas['r86']              = $oldd['r86'];
    $climas['r87']              = $oldd['r87'];
    $climas['r88']              = $oldd['r88'];
    $climas['r89']              = $oldd['r89'];
    $climas['r90']              = $oldd['r90'];
    $climas['r91']              = $oldd['r91'];
    $climas['r92']              = $oldd['r92'];
    $climas['r93']              = $oldd['r93'];
    $climas['r94']              = $oldd['r94'];
    $climas['r95']              = $oldd['r95'];
    $climas['r96']              = $oldd['r96'];
    $climas['r97']              = $oldd['r97'];
    $climas['r98']              = $oldd['r98'];
    $climas['r99']              = $oldd['r99'];
    $climas['r100']             = $oldd['r100'];
    $climas['r101']             = $oldd['r101'];
    $climas['r102']             = $oldd['r102'];
    $climas['r103']             = $oldd['r103'];
    $climas['r104']             = $oldd['r104'];
    $climas['activo']           = $oldd['activo'];
    
}
?>
<div class="form-group">
<label  class="d-inline" for="cve_plantilla"> ID de la Plantilla:</label>
<input  class="d-inline" type="text" id="fk_id_plantillas"  name= "fk_id_plantillas"    value="{{ $climas->fk_id_plantillas }}">
<?php
/*
<label  class="d-inline" for="num_emp">,   Número de Empleado: {{ $plantilla[0]->num_emp }} </label>
<br>
<label  class="d-inline" for="numbre_completo">Nombre completo del Empleado: {{ $plantilla[0]->nombre_completo }} </label>
<br>
<label class="d-inline" for="dep_o_ent"> Dependencia o Entidad: {{ $plantilla[0]->dependencia }}</label
<br>
*/
?>
<br>
@include('include.climas_preguntas')
<br>
<label for="activo"> Activo </label>
<input onInput="jsactiva();" type="checkbox" id="activa" name="activa" 
    value="{{ $climas->activo }}"
    <?php
        //$habilitado= "No";
        $habilitado= "Si";
        if ($climas->activo)   echo " checked " ;
    ?>
>
<br>
@include('include.grabarbtn')
<a 
    href="{{ url('/admin/Climas') }}"     
    style="border:none" >
    <img 
        src="{{URL::asset('/images/boton_regresar.png')}}" 
        style="border:none"
    >
</a>
<br>
<input type="hidden" id="activao" name= "activao" value="{{ $climas->activo }}">
</div>
@include('include.jsactiva')
