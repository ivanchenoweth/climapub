@extends('layouts.app')
@section('content')
<style>
.center {
text-align: center
}
</style>
<div class="container">
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;page-break-inside:avoid;
         height:18.6pt'>  
<H1>         
<strong>
<p class="center" style="color:orange;">
        LA ENCUESTA DEL CLIMA ORGANIZACIONAL
        <br>
        SE ADAPTA
        <br>
        A LAS CIRCUNSTANCIAS ACTUALES
        <br>
        ¡PARTICIPA!
        <br>
        QUEREMOS SABER COMO TE SIENTES.
</p>
</H1>
</strong>
<div class="center">
        <img src="{{URL::asset('/images/Iconos_Slogan_ME.jpg')}}" 
        alt="profile Pic" height="100" width="400">
</div>
<div>
<strong>INSTRUCCIONES:</strong>
<br>
<br>Está usted a punto de llenar el formato de Clima Organizacional para el ejercicio 2022, 
para lo cual deberá seguir los siguientes pasos:
<br>
<br>&nbsp&nbsp&nbsp&nbsp1.&nbsp&nbsp<strong>Seleccionar</strong>&nbsp el Organismo o Dependencia a la cual esta adscrito a cada trabajador
<br>&nbsp&nbsp&nbsp&nbsp2.&nbsp&nbsp<strong>Escribir</strong>&nbsp el número de empleado en el espacio correspondiente.
<br>&nbsp&nbsp&nbsp&nbsp3.&nbsp&nbsp<strong>Dar clic</u></strong>&nbsp en el botón buscar, tome en cuenta que solo se permite capturar un formulario por empleado.
<br>&nbsp&nbsp&nbsp&nbsp5.&nbsp&nbsp<strong>Llenar</strong>&nbsp el formulario campo por campo, empezando por la Fecha.
<br>&nbsp&nbsp&nbsp&nbsp7.&nbsp&nbsp<strong>Dar clic</strong> al botón verde de "Agregar Datos", el cual se activa al responder la útima pregunta para grabar el formulario.
<br>&nbsp&nbsp&nbsp&nbsp8.&nbsp&nbspUna vez enviado, le mostrará una ventana, copie el <strong>Folio</strong>
,anote en lugar seguro el folio generado.
</div>
<br>
<td width=570 style='width:1.0cm;border:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
               mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
               mso-border-bottom-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;                         
               height:17.35pt'>
        <a href='/cons1'>
                <button 
                        class="btn btn-default" 
                        style='background-color:#FFFFFF;border:none'>
                        <img src="{{URL::asset('/images/boton_continuar.png')}}">
                </button>        
        </a>
</td>
</tr>
</div>
</div>
@endsection