@extends('layouts.app')
@section('content')
<style>
.center {
text-align: center
}
.just { text-align: justify; }
</style>
<div class="container">
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;page-break-inside:avoid;
         height:18.6pt'>  
<strong>
<p class="center">      
        CLIMA ORGANIZACIONAL
        <br>
</p>
</strong>
<div class="just">
<strong>Objetivo</strong>
<br>
<br>
Con la Nueva Ética de la cuarta transformación, se retoma el mandato de mejorar el <strong>Clima Organizacional</strong> de las Dependencias y Organismos Públicos Descentralizados de la Estructura Estatal Gubernamental, con mucho énfasis en desarrollar los procesos de cambio que incidan en garantizar la Austeridad, los Derechos Humanos, la Igualdad de géneros, la Inclusión y la Pertinencia Cultural, los cuales se concretan en las nuevas prácticas de la Transformación a partir de estos resultados. La Cultura Organizacional, es el conjunto de factores que afectan de manera positiva o negativa el Desempeño, la Productividad, la Calidad, el Desarrollo en los servicios, así como la Imagen Institucional,  trae como resultado en las Relaciones internas; las Actitudes, Percepciones y Conductas de las Personas que se derivan de las Motivaciones personales, las practicas al interior de la Institucion, el tipo de Liderazgo, la Evaluación, el Reconocimiento de resultados, la Equidad de Géneros, entre otros factores.
<br>
<br>
<strong>Marco Normativo</strong>
<br>
<br>
La aplicación del <strong>Clima Organizacional</strong>, se sustenta el el capítulo IV, Artículo 7, Fraccion VIII, del Reglamento interior de Oficialia Mayor del Gobierno del Estado de Sonora, donde señala que : Dentro de las atribuciones que tiene la Subsecretaría de Recursos Humanos, está la de, " Establecer y supervisar la operación de los sistemas de Reclutamiento, Selección, Evaluación, Ingreso, Remoción, Certificación, Capacitación y Promoción de los Servidores Públicos de la Administración Pública Estatal".
<br>
</div>
<br>
<td width=570 style='width:1.0cm;border:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
               mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
               mso-border-bottom-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;                         
               height:17.35pt'>
        <a 
               class="navbar-brand" 
               href="{{ url('/') }}">                               
               <button  
                   class="btn btn-default" 
                   style='background-color:#FFFFFF;border:none'>
                   <img src="{{URL::asset('/images/boton_inicio.png')}}" 
                        style="border:none">
               </button>
        </a>
        <a href='/cons2'>
             <button 
                class="btn btn-default" 
                style='background-color:#FFFFFF;border:none'>
                <img src="{{URL::asset('/images/boton_continuar.png')}}">
             </button>
        </a>
</td>
</tr>
</div>
@endsection