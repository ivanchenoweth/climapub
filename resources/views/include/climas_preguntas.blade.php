<label  class="d-inline" for="fk_cve_periodo"> Periodo: </label>
<select onclick="myFunc()" disabled class="d-inline" lenght="40" class="form-control" 
     name="cve_periodo" id="cve_periodo">
     @foreach( $periodos as $periodo)
     <option size="40" value="{{ $periodo->cve_periodo }}" 
       <?php   
           if (isset($climas->fk_cve_periodo)) {
               $climas->fk_cve_periodo = trim( $climas->fk_cve_periodo); }
            else {               
               $climas->fk_cve_periodo = old('cve_periodo');
            }                
            if( $periodo->cve_periodo == $climas->fk_cve_periodo) 
                echo 'selected="selected"'
        ?>                     
       > 
       {{ $periodo->descripcion }}
     </option>
     @endforeach
</select>
<label for="fecha">,  Fecha del Formato: </label>
<input onclick="myFunc()" type="date" size="10" class="d-inline" name="fecha" id="fecha" 
    value="{{ \Carbon\Carbon::createFromDate($climas->fecha)->format('Y-m-d') }}">
<br>
<label class="d-inline" for="area"> Captura el Area a la que perteneces: </label>
<input onclick="myFunc()" disabled size="60" type="text" class="d-inline" class="form-control"     
    name="area" id="area" 
    value="{{ $climas->area }}">
<br>
<style>
table, th, td {
  border:1px solid black;
}
.rotated {
        writing-mode: tb-rl;
        transform: rotate(-180deg);
}
</style>
<table style="width:70%">
<tr>
<th>CALIDAD DE VIDA LABORAL</th>
<th class="rotated"> Siempre </th>
<th class="rotated"> Con Frecuencia</th>
<th class="rotated"> Algunas Veces</th>
<th class="rotated"> Nunca</th>
</tr>
<tr>
<td>1.- Me siento satisfecho con mi ambiente de trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r001_1" name="r001_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r001_2" name="r001_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r001_3" name="r001_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r001_4" name="r001_4" > </td>
</tr> 
<tr>
<td>2.- En mi Dependencia está claramente definido  el Objetivo del trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r002_1" name="r002_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r002_2" name="r002_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r002_3" name="r002_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r002_4" name="r002_4" > </td>
</tr>
<tr>
<td>3.- La Dirección manifiesta sus Objetivos de tal forma que se crea un sentido común de misión e identidad entre los Servidores Públicos.</td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r003_1" name="r003_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r003_2" name="r003_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r003_3" name="r003_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r003_4" name="r003_4" > </td>
</tr>
<tr>
<td>4.- Existe un Plan para lograr los Objetivos de la Dependencia.</td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r004_1" name="r004_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r004_2" name="r004_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r004_3" name="r004_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r004_4" name="r004_4" > </td>
</tr>
<tr>
<td>5.- Yo aporto al Proceso de planificación en mi área de trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r005_1" name="r005_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r005_2" name="r005_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r005_3" name="r005_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r005_4" name="r005_4" > </td>
</tr>
<tr>
<td>6.- En esta Institución, la gente planifica cuidadosamente antes de tomar acción.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r006_1" name="r006_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r006_2" name="r006_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r006_3" name="r006_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r006_4" name="r006_4" > </td>
</tr>
<tr>
<td>7.- Si hay un nuevo plan estratégico, estoy dispuesto a servir de voluntario para iniciar los  cambios.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r007_1" name="r007_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r007_2" name="r007_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r007_3" name="r007_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r007_4" name="r007_4" > </td>
</tr>
<tr>
<td>8.- Esta conforme con la limpieza, higiene y salubridad en su lugar de trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r008_1" name="r008_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r008_2" name="r008_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r008_3" name="r008_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r008_4" name="r008_4" > </td>
</tr>
<tr>
<td>9.- Cuento con los materiales y equipos necesarios para realizar mi trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r009_1" name="r009_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r009_2" name="r009_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r009_3" name="r009_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r009_4" name="r009_4" > </td>
</tr>
<tr>
<td>10.-Me gusta mi trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r010_1" name="r010_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r010_2" name="r010_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r010_3" name="r010_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r010_4" name="r010_4" > </td>
</tr>
<tr>
<td>11.-Las herramientas y equipos que utilizo (computadora, teléfono, etc.) son mantenidos en forma adecuada.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r011_1" name="r011_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r011_2" name="r011_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r011_3" name="r011_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r011_4" name="r011_4" > </td>
</tr>
<tr>
<td>12.-El trabajo que hago es importante para el Estado de Sonora.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r012_1" name="r012_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r012_2" name="r012_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r012_3" name="r012_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r012_4" name="r012_4" > </td>
</tr>
<tr>
<td>13.-Nuestros clientes externos (ciudadanía) están recibiendo el servicio que demandan de nosotros.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r013_1" name="r013_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r013_2" name="r013_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r013_3" name="r013_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r013_4" name="r013_4" > </td>
</tr>
<tr>
<td>14.-Nuestros clientes internos (servidores públicos) están recibiendo el servicio que demandan de nosotros.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r014_1" name="r014_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r014_2" name="r014_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r014_3" name="r014_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r014_4" name="r014_4" > </td>
</tr>
<tr>
<td>15.-En esta Dependencia valoran mi trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r015_1" name="r015_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r015_2" name="r015_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r015_3" name="r015_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r015_4" name="r015_4" > </td>
</tr>
<tr>
<td>16.-Conosco mi cliente final.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r016_1" name="r016_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r016_2" name="r016_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r016_3" name="r016_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r016_4" name="r016_4" > </td>
</tr>
<tr>
<td>17.-Me siento orgulloso trabajar en esta Dependencia.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r017_1" name="r017_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r017_2" name="r017_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r017_3" name="r017_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r017_4" name="r017_4" > </td>
</tr>
<tr>
<td>18.-Considero que me pagan lo justo por mi trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r018_1" name="r018_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r018_2" name="r018_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r018_3" name="r018_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r018_4" name="r018_4" > </td>
</tr>
<tr>
<td>19.-Estoy satisfecho con los beneficios que recibo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r019_1" name="r019_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r019_2" name="r019_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r019_3" name="r019_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r019_4" name="r019_4" > </td>
</tr>
<tr>
<td>20.-Considero que necesito capacitación en alguna de mi área de interés y que forma parte de mi desarrollo.            </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r020_1" name="r020_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r020_2" name="r020_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r020_3" name="r020_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r020_4" name="r020_4" > </td>
</tr>
<tr>
<th>AUTONOMIA</th>
<th class="rotated"> Siempre </th>
<th class="rotated"> Con Frecuencia</th>
<th class="rotated"> Algunas Veces</th>
<th class="rotated"> Nunca</th>
</tr>
<tr>
<td>21.-Mi superior me motiva a cumplir con mi trabajo de la manera que yo considere mejor.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r021_1" name="r021_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r021_2" name="r021_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r021_3" name="r021_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r021_4" name="r021_4" > </td>
</tr>
<tr>
<td>22.-Soy responsable del trabajo que realizo</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r022_1" name="r022_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r022_2" name="r022_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r022_3" name="r022_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r022_4" name="r022_4" > </td>
</tr>
<tr>
<td>23.-Soy responsable de cumplir los estándares de desempeño y/o rendimiento.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r023_1" name="r023_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r023_2" name="r023_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r023_3" name="r023_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r023_4" name="r023_4" > </td></tr>
<tr>
<td>24.-Me siento comprometido para alcanzar las metas establecidas.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r024_1" name="r024_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r024_2" name="r024_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r024_3" name="r024_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r024_4" name="r024_4" > </td>
</tr>
<tr>
<td>25.-El horario de trabajo me permite atender mis necesidades personales.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r025_1" name="r025_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r025_2" name="r025_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r025_3" name="r025_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r025_4" name="r025_4" > </td>
</tr>
<tr>
<th>TRABAJO EN EQUIPO</th>
<th class="rotated"> Siempre </th>
<th class="rotated"> Con Frecuencia</th>
<th class="rotated"> Algunas Veces</th>
<th class="rotated"> Nunca</th>
</tr>
<tr>
<td>26.-Mis compañeros y yo trabajamos juntos de manera efectiva</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r026_1" name="r026_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r026_2" name="r026_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r026_3" name="r026_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r026_4" name="r026_4" > </td>
</tr>
<tr>
<td>27.-En mi grupo de trabajo, solucionar el problema es más importante que encontrar algún culpable.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r027_1" name="r027_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r027_2" name="r027_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r027_3" name="r027_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r027_4" name="r027_4" > </td>
</tr>
<tr>
<td>28.-En mi Institución existe un espíritu o mística de que “estamos todos juntos en esto”.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r028_1" name="r028_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r028_2" name="r028_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r028_3" name="r028_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r028_4" name="r028_4" > </td>
</tr>
<tr>
<td>29.-Siento que formo parte de un equipo que trabaja hacia una meta común.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r029_1" name="r029_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r029_2" name="r029_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r029_3" name="r029_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r029_4" name="r029_4" > </td>
</tr>
<tr>
<td>30.-Mi grupo trabaja de manera eficiente y enfocada.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r030_1" name="r030_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r030_2" name="r030_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r030_3" name="r030_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r030_4" name="r030_4" > </td>
</tr>
<tr>
<td>31.-Mi superior inmediato toma acciones que refuerzan el objetivo común de la Dependencia.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r031_1" name="r031_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r031_2" name="r031_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r031_3" name="r031_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r031_4" name="r031_4" > </td>
</tr>
<tr>
<td>32.-Puedo confiar en mis compañeros de trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r032_1" name="r032_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r032_2" name="r032_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r032_3" name="r032_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r032_4" name="r032_4" > </td>
</tr>
<tr>
<td>33.-En el trabajo tengo un buen amigo con quien hablar.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r033_1" name="r033_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r033_2" name="r033_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r033_3" name="r033_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r033_4" name="r033_4" > </td>
</tr>
<tr>
<th>TRATO DEL JEFE INMEDIATO</th>
<th class="rotated"> Siempre </th>
<th class="rotated"> Con Frecuencia</th>
<th class="rotated"> Algunas Veces</th>
<th class="rotated"> Nunca</th>
</tr>
<tr>
<td>34.-Mi superior inmediato pide mis opiniones para ayudarle a tomar decisiones.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r034_1" name="r034_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r034_2" name="r034_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r034_3" name="r034_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r034_4" name="r034_4" > </td>
</tr>
<tr>
<td>35.-Mi superior inmediato escucha lo que dice su personal.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r035_1" name="r035_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r035_2" name="r035_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r035_3" name="r035_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r035_4" name="r035_4" > </td>
</tr>
<tr>
<td>36.-Mi superior inmediato busca los aportes del equipo para que se puedan comprender y dar solucion a las actitudes complejas que se presentan.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r036_1" name="r036_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r036_2" name="r036_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r036_3" name="r036_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r036_4" name="r036_4" > </td>
</tr>
<tr>
<td>37.-Mi superior inmediato maneja mis asuntos laborales de manera satisfactoria.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r037_1" name="r037_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r037_2" name="r037_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r037_3" name="r037_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r037_4" name="r037_4" > </td>
</tr>
<tr>
<td>38.-Misuperior inmediato da un buen ejemplo</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r038_1" name="r038_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r038_2" name="r038_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r038_3" name="r038_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r038_4" name="r038_4" > </td>
</tr>
<tr>
<td>39.-Mi superior inmediato está disponible cuando lo requiero.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r039_1" name="r039_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r039_2" name="r039_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r039_3" name="r039_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r039_4" name="r039_4" > </td>
</tr>
<tr>
<td>40.-Mi superior inmediato posee las capacidades para supervisarme.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r040_1" name="r040_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r040_2" name="r040_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r040_3" name="r040_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r040_4" name="r040_4" > </td>
</tr>
<tr>
<td>41.-Mi superior inmediato respeta la confidencialidad de los temas que comparto con él.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r041_1" name="r041_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r041_2" name="r041_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r041_3" name="r041_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r041_4" name="r041_4" > </td>
</tr>
<tr>
<td>42.-Mi superior inmediato me exhorta a mejorar mis capacidades o educación.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r042_1" name="r042_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r042_2" name="r042_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r042_3" name="r042_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r042_4" name="r042_4" > </td>
</tr>
<tr>
<td>43.-Mi superior inmediato nos ha dicho sobre las funciones de algún departamento ha provocado quedar mal con con los clientes. </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r043_1" name="r043_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r043_2" name="r043_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r043_3" name="r043_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r043_4" name="r043_4" > </td>
</tr>
<tr>
<td>44.-Mi superior inmediato se enfoca en hacer bien las actividades indicadas. </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r044_1" name="r044_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r044_2" name="r044_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r044_3" name="r044_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r044_4" name="r044_4" > </td>
</tr>
<tr>
<td>45.-Mi superior inmediato posee una clara visión de la dirección de nuestro grupo de trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r045_1" name="r045_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r045_2" name="r045_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r045_3" name="r045_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r045_4" name="r045_4" > </td>
</tr>
<tr>
<td>46.-Cuento una descripción de puesto por escrito y actualizada.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r046_1" name="r046_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r046_2" name="r046_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r046_3" name="r046_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r046_4" name="r046_4" > </td>
</tr>
<tr>
<td>47.-Mi superior inmediato garantiza que yo tenga una idea clara de las metas de nuestro grupo de trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r047_1" name="r047_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r047_2" name="r047_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r047_3" name="r047_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r047_4" name="r047_4" > </td>
</tr>
<tr>
<td>48.-Mi superior inmediato me orienta y comunica sobre las políticas y formas de trabajo de mí área.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r048_1" name="r048_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r048_2" name="r048_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r048_3" name="r048_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r048_4" name="r048_4" > </td>
</tr>
<tr>
<td>49.-Mi superior inmediato me hace revisiones/evaluaciones regulares de trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r049_1" name="r049_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r049_2" name="r049_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r049_3" name="r049_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r049_4" name="r049_4" > </td>
</tr>
<tr>
<td>50.-Mi superior inmediato me dice cuando debo mejorar mi trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r050_1" name="r050_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r050_2" name="r050_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r050_3" name="r050_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r050_4" name="r050_4" > </td>
</tr>
<tr>
<td>51.-Mi superior inmediato me informa cuando hago bien  mi trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r051_1" name="r051_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r051_2" name="r051_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r051_3" name="r051_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r051_4" name="r051_4" > </td>
</tr>
<tr>
<td>52.-Mi superior inmediato me exhorta a crecer y aprender.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r052_1" name="r052_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r052_2" name="r052_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r052_3" name="r052_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r052_4" name="r052_4" > </td>
</tr>
<tr>
<td>53.-Mi superior inmediato me da retroalimentación tanto positiva como negativa sobre el desempeño de trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r053_1" name="r053_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r053_2" name="r053_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r053_3" name="r053_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r053_4" name="r053_4" > </td>
</tr>
<tr>
<th>COMUNICACION</th>
<th class="rotated"> Siempre </th>
<th class="rotated"> Con Frecuencia</th>
<th class="rotated"> Algunas Veces</th>
<th class="rotated"> Nunca</th>
</tr>
<tr>
<td>54.-Estan definidas las características de la información esperada en términos de calidad, cantidad, oportunidad y forma de presentación.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r054_1" name="r054_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r054_2" name="r054_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r054_3" name="r054_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r054_4" name="r054_4" > </td>
</tr>
<tr>
<td>55.-Recibo en forma oportuna la información que requiero para mí trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r055_1" name="r055_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r055_2" name="r055_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r055_3" name="r055_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r055_4" name="r055_4" > </td>
</tr>
<tr>
<td>56.-Estan establecidos los canales de comunicación entre la Dirección y las diferente áreas.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r056_1" name="r056_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r056_2" name="r056_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r056_3" name="r056_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r056_4" name="r056_4" > </td>
</tr>
<tr>
<td>57.-Se donde dirigirme cuando tengo un problema.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r057_1" name="r057_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r057_2" name="r057_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r057_3" name="r057_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r057_4" name="r057_4" > </td>
</tr>
<tr>
<td>58.-Recibo información con regularidad que me permite conocer lo que sucede en mí dependencia.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r058_1" name="r058_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r058_2" name="r058_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r058_3" name="r058_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r058_4" name="r058_4" > </td>
</tr>
<tr>
<td>59.-Existe muy buena comunicación entre los compañeros de trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r059_1" name="r059_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r059_2" name="r059_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r059_3" name="r059_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r059_4" name="r059_4" > </td>
</tr>
<tr>
<td>60.-Existe muy buena comunicación con mi superior inmediato.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r060_1" name="r060_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r060_2" name="r060_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r060_3" name="r060_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r060_4" name="r060_4" > </td>
</tr>
<tr>
<td>61.-Mi superior inmediato elaboro conmigo el Plan Anual de Capacitación.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r061_1" name="r061_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r061_2" name="r061_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r061_3" name="r061_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r061_4" name="r061_4" > </td>
</tr>
<tr>
<td>62.-Mi superior inmediato me programo la capacitación de acuerdo al Programa Anual de Capacitacion. </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r062_1" name="r062_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r062_2" name="r062_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r062_3" name="r062_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r062_4" name="r062_4" > </td>
</tr>
<tr>
<th>PRESION</th>
<th class="rotated"> Siempre </th>
<th class="rotated"> Con Frecuencia</th>
<th class="rotated"> Algunas Veces</th>
<th class="rotated"> Nunca</th>
</tr>
<tr>
<td>63.- Tengo mucho trabajo y poco tiempo para realizarlo. </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r063_1" name="r063_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r063_2" name="r063_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r063_3" name="r063_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r063_4" name="r063_4" > </td>
</tr>
<tr>
<td>64.-Mi institución es un lugar relajado para trabajar. </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r064_1" name="r064_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r064_2" name="r064_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r064_3" name="r064_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r064_4" name="r064_4" > </td>
</tr>
<tr>
<td>65.-En mi tiempo libre, a veces temo oír sonar mi teléfono (casa o Cel.) Porque pudiera tratarse de alguien que llama sobre un problema en el trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r065_1" name="r065_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r065_2" name="r065_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r065_3" name="r065_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r065_4" name="r065_4" > </td>
</tr>
<tr>
<td>66.-Me siento como si nunca tuviese  un día libre.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r066_1" name="r066_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r066_2" name="r066_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r066_3" name="r066_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r066_4" name="r066_4" > </td>
</tr>
<tr>
<td>67.-Muchos de los trabajadores de mi Dependencia en mi nivel, sufren de un alto estrés, debido a la eexigencia de trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r067_1" name="r067_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r067_2" name="r067_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r067_3" name="r067_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r067_4" name="r067_4" > </td>
</tr>
<tr>
<td>68.-Para desempeñar las funciones de mi puesto tengo que hacer un esfuerzo adicional y retador en el trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r068_1" name="r068_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r068_2" name="r068_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r068_3" name="r068_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r068_4" name="r068_4" > </td>
</tr>
<tr>
<th>APOYO</th>
<th class="rotated"> Siempre </th>
<th class="rotated"> Con Frecuencia</th>
<th class="rotated"> Algunas Veces</th>
<th class="rotated"> Nunca</th>
</tr>
<tr>
<td>69.-Hay evidencias de que mi jefe apoya utilizando mis ideas o propuestas para mejorar el trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r069_1" name="r069_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r069_2" name="r069_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r069_3" name="r069_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r069_4" name="r069_4" > </td>
</tr>
<tr>
<td>70.-Considero que mi jefe es flexible y justo ante las peticiones que solicito.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r070_1" name="r070_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r070_2" name="r070_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r070_3" name="r070_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r070_4" name="r070_4" > </td>
</tr>
<tr>
<td>71.-Puedo contar con la ayuda de mi jefe cuando la necesito.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r071_1" name="r071_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r071_2" name="r071_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r071_3" name="r071_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r071_4" name="r071_4" > </td>
</tr>
<tr>
<td>72.-A mi jefe le interesa que me desarrollo profesionalmente.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r072_1" name="r072_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r072_2" name="r072_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r072_3" name="r072_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r072_4" name="r072_4" > </td>
</tr>
<tr>
<td>73.-Mi jefe me respalda el 100%</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r073_1" name="r073_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r073_2" name="r073_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r073_3" name="r073_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r073_4" name="r073_4" > </td>
</tr>
<tr>
<td>74.-Es fácil hablar con mi jefe sobre los problemas relacionados con el trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r074_1" name="r074_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r074_2" name="r074_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r074_3" name="r074_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r074_4" name="r074_4" > </td>
</tr>
<tr>
<td>75.-Mi jefe me respalda y deja que yo aprenda de mis propios errores.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r075_1" name="r075_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r075_2" name="r075_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r075_3" name="r075_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r075_4" name="r075_4" > </td>
</tr>
<tr>
<td>76.-La dirección se interesa por mi futuro profesional al definir oportunidades de desarrollo,  (Capacitación, plan de carrera, etc.).</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r076_1" name="r076_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r076_2" name="r076_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r076_3" name="r076_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r076_4" name="r076_4" > </td>
</tr>
<tr>
<th>RECONOCIMIENTO</th>
<th class="rotated"> Siempre </th>
<th class="rotated"> Con Frecuencia</th>
<th class="rotated"> Algunas Veces</th>
<th class="rotated"> Nunca</th>
</tr>
<tr>
<td>77.-Cuando hay una vacante, primero se busca dentro de la misma Dependencia al posible candidato.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r077_1" name="r077_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r077_2" name="r077_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r077_3" name="r077_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r077_4" name="r077_4" > </td>
</tr>
<tr>
<td>78.-Puedo contar con una felicitación cuando realizo bien mi trabajo.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r078_1" name="r078_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r078_2" name="r078_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r078_3" name="r078_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r078_4" name="r078_4" > </td>
</tr>
<tr>
<td>79.-La única vez que se habla sobre mi rendimiento es cuando he cometido un error.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r079_1" name="r079_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r079_2" name="r079_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r079_3" name="r079_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r079_4" name="r079_4" > </td>
</tr>
<tr>
<td>80.-Mi jefe conoce mis puntos fuertes y me los hace notar.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r080_1" name="r080_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r080_2" name="r080_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r080_3" name="r080_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r080_4" name="r080_4" > </td>
</tr>
<tr>
<td>81.-Dentro de la dirección se reconoce la trayectoria del personal de mi departamento para ser promovido.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r081_1" name="r081_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r081_2" name="r081_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r081_3" name="r081_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r081_4" name="r081_4" > </td>
</tr>
<tr>
<td>82.-Las promociones se las dan a quienes se las merecen.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r082_1" name="r082_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r082_2" name="r082_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r082_3" name="r082_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r082_4" name="r082_4" > </td>
</tr>
<tr>
<td>83.-Mi jefe es rápido para reconocer una buena ejecución.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r083_1" name="r083_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r083_2" name="r083_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r083_3" name="r083_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r083_4" name="r083_4" > </td>
</tr>
<tr>
<td>84.-Mi jefe me utiliza como ejemplo de lo que se debe de hacer.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r084_1" name="r084_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r084_2" name="r084_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r084_3" name="r084_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r084_4" name="r084_4" > </td>
</tr>
<tr>
<td>85.-Existe reconocimiento de dirección para el personal por sus esfuerzos y aportaciones al logro de los objetivos y metas de la institucion.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r085_1" name="r085_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r085_2" name="r085_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r085_3" name="r085_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r085_4" name="r085_4" > </td>
</tr>
<tr>
<td>86.-Mi jefe me hace saber que valora mis esfuerzos y aportaciones en mi trabajo, aun cuando por causas ajenas no se alcance el objetivo deseado.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r086_1" name="r086_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r086_2" name="r086_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r086_3" name="r086_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r086_4" name="r086_4" > </td>
</tr>
<tr>
<td>87.-El instrumento de medición utilizado para evaluar al personal, arroja conclusiones justas sobre mi desempeño.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r087_1" name="r087_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r087_2" name="r087_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r087_3" name="r087_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r087_4" name="r087_4" > </td>
</tr>
<tr>
<th>EQUIDAD Y NO DISCRIMINACION</th>
<th class="rotated"> Siempre </th>
<th class="rotated"> Con Frecuencia</th>
<th class="rotated"> Algunas Veces</th>
<th class="rotated"> Nunca</th>
</tr>
<tr>
<td>88.-Es poco probables que mi jefe me halague sin motivos.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r088_1" name="r088_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r088_2" name="r088_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r088_3" name="r088_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r088_4" name="r088_4" > </td>
</tr>
<tr>
<td>89.-Mi jefe no tiene favoritos.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r089_1" name="r089_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r089_2" name="r089_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r089_3" name="r089_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r089_4" name="r089_4" > </td>
</tr>
<tr>
<td>90.-En mi área se proporciona el servicio requerido de manera cordial, respetuosa y con los principios de igualdad y NO discriminación.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r090_1" name="r090_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r090_2" name="r090_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r090_3" name="r090_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r090_4" name="r090_4" > </td>
</tr>
<tr>
<td>91.-Mi Institución cuenta con códigos  de ética y conducta actualizado, que explican los principios de derechos humanos, igualdad y NO discriminación.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r091_1" name="r091_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r091_2" name="r091_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r091_3" name="r091_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r091_4" name="r091_4" > </td>
</tr>
<tr>
<td>92.-Mi jefe me trata con respeto, confianza y NO discriminación.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r092_1" name="r092_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r092_2" name="r092_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r092_3" name="r092_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r092_4" name="r092_4" > </td>
</tr>
<tr>
<td>93.-En mi área el hostigamiento es inaceptable y sancionable</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r093_1" name="r093_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r093_2" name="r093_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r093_3" name="r093_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r093_4" name="r093_4" > </td>
</tr>
<tr>
<td>94.-En mi Institución los mecanismos de la evaluación del desempeño se aplican con igualdad  y NO discriminación.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r094_1" name="r094_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r094_2" name="r094_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r094_3" name="r094_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r094_4" name="r094_4" > </td>
</tr>
<tr>
<td>95.-Mi jefe distribuye el trabajo de acuerdo a nuestras responsabilidades, capacidades y competencias.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r095_1" name="r095_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r095_2" name="r095_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r095_3" name="r095_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r095_4" name="r095_4" > </td>
</tr>
<tr>
<td>96.-En mi área operan mecanismos de reconocimiento al personal, con igualdad y NO discriminacion.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r096_1" name="r096_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r096_2" name="r096_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r096_3" name="r096_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r096_4" name="r096_4" > </td>
</tr>
<tr>
<td>97.- En mi área se dan las oportunidades de acenso y promoción de acuerdo a los principios de  igualdad y NO discriminación.</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r097_1" name="r097_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r097_2" name="r097_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r097_3" name="r097_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r097_4" name="r097_4" > </td>
</tr>
<tr>
<th>INNOVACION</th>
<th class="rotated"> Siempre </th>
<th class="rotated"> Con Frecuencia</th>
<th class="rotated"> Algunas Veces</th>
<th class="rotated"> Nunca</th>
</tr>
<tr>
<td>98.-  Mi jefe me anima a desarrollar mis propias ideas</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r098_1" name="r098_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r098_2" name="r098_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r098_3" name="r098_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r098_4" name="r098_4" > </td>
</tr>
<tr>
<td>99.-  A mi jefe le agrada que yo intente hacer mi trabajo de distintas formas</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r099_1" name="r099_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r099_2" name="r099_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r099_3" name="r099_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r099_4" name="r099_4" > </td>
</tr>
<tr>
<td>100.-Mi jefe “valora “nuevas formas de hacer las cosas</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r100_1" name="r100_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r100_2" name="r100_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r100_3" name="r100_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r100_4" name="r100_4" > </td>
</tr>
<tr>
<td>101.-Se me exhorta a encontrar nuevas y mejores maneras de hacer el trabajo</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r101_1" name="r101_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r101_2" name="r101_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r101_3" name="r101_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r101_4" name="r101_4" > </td>
</tr>
<tr>
<td>102.-Cuando algo sale mal, nosotros corregimos el error de manera que el problema no vuelva</td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r102_1" name="r102_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r102_2" name="r102_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r102_3" name="r102_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled  type="radio" id="r102_4" name="r102_4" > </td>
</tr>
<tr>
<td>103.-Nuestro ambiente laboral apoya la innovación</td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r103_1" name="r103_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r103_2" name="r103_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r103_3" name="r103_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r103_4" name="r103_4" > </td>
</tr>
<tr>
<td>104.-Los directores Generales y Titulares de las Dependencias reaccionan de manera positiva ante nuestras nuevas ideas.</td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r104_1" name="r104_1" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r104_2" name="r104_2" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r104_3" name="r104_3" > </td>
<td align="center"> <input onclick="myFunc()" disabled type="radio" id="r104_4" name="r104_4" > </td>
</tr>
</table>
<p hidden>
<input type="hidden" id="fk_cve_periodo" name= "fk_cve_periodo" value="0">
<input type="hidden" id="r1" name= "r1" value="{{$climas->r1}}">
<input type="hidden" id="r2" name= "r2" value="{{$climas->r2}}">
<input type="hidden" id="r3" name= "r3" value="{{$climas->r3}}">
<input type="hidden" id="r4" name= "r4" value="{{$climas->r4}}">
<input type="hidden" id="r5" name= "r5" value="{{$climas->r5}}">
<input type="hidden" id="r6" name= "r6" value="{{$climas->r6}}">
<input type="hidden" id="r7" name= "r7" value="{{$climas->r7}}">
<input type="hidden" id="r8" name= "r8" value="{{$climas->r8}}">
<input type="hidden" id="r9" name= "r9" value="{{$climas->r9}}">
<input type="hidden" id="r10" name= "r10" value="{{$climas->r10}}">
<input type="hidden" id="r11" name= "r11" value="{{$climas->r11}}">
<input type="hidden" id="r12" name= "r12" value="{{$climas->r12}}">
<input type="hidden" id="r13" name= "r13" value="{{$climas->r13}}">
<input type="hidden" id="r14" name= "r14" value="{{$climas->r14}}">
<input type="hidden" id="r15" name= "r15" value="{{$climas->r15}}">
<input type="hidden" id="r16" name= "r16" value="{{$climas->r16}}">
<input type="hidden" id="r17" name= "r17" value="{{$climas->r17}}">
<input type="hidden" id="r18" name= "r18" value="{{$climas->r18}}">
<input type="hidden" id="r19" name= "r19" value="{{$climas->r19}}">
<input type="hidden" id="r20" name= "r20" value="{{$climas->r20}}">
<input type="hidden" id="r21" name= "r21" value="{{$climas->r21}}">
<input type="hidden" id="r22" name= "r22" value="{{$climas->r22}}">
<input type="hidden" id="r23" name= "r23" value="{{$climas->r23}}">
<input type="hidden" id="r24" name= "r24" value="{{$climas->r24}}">
<input type="hidden" id="r25" name= "r25" value="{{$climas->r25}}">
<input type="hidden" id="r26" name= "r26" value="{{$climas->r26}}">
<input type="hidden" id="r27" name= "r27" value="{{$climas->r27}}">
<input type="hidden" id="r28" name= "r28" value="{{$climas->r28}}">
<input type="hidden" id="r29" name= "r29" value="{{$climas->r29}}">
<input type="hidden" id="r30" name= "r30" value="{{$climas->r30}}">
<input type="hidden" id="r31" name= "r31" value="{{$climas->r31}}">
<input type="hidden" id="r32" name= "r32" value="{{$climas->r32}}">
<input type="hidden" id="r33" name= "r33" value="{{$climas->r33}}">
<input type="hidden" id="r34" name= "r34" value="{{$climas->r34}}">
<input type="hidden" id="r35" name= "r35" value="{{$climas->r35}}">
<input type="hidden" id="r36" name= "r36" value="{{$climas->r36}}">
<input type="hidden" id="r37" name= "r37" value="{{$climas->r37}}">
<input type="hidden" id="r38" name= "r38" value="{{$climas->r38}}">
<input type="hidden" id="r39" name= "r39" value="{{$climas->r39}}">
<input type="hidden" id="r40" name= "r40" value="{{$climas->r40}}">
<input type="hidden" id="r41" name= "r41" value="{{$climas->r41}}">
<input type="hidden" id="r42" name= "r42" value="{{$climas->r42}}">
<input type="hidden" id="r43" name= "r43" value="{{$climas->r43}}">
<input type="hidden" id="r44" name= "r44" value="{{$climas->r44}}">
<input type="hidden" id="r45" name= "r45" value="{{$climas->r45}}">
<input type="hidden" id="r46" name= "r46" value="{{$climas->r46}}">
<input type="hidden" id="r47" name= "r47" value="{{$climas->r47}}">
<input type="hidden" id="r48" name= "r48" value="{{$climas->r48}}">
<input type="hidden" id="r49" name= "r49" value="{{$climas->r49}}">
<input type="hidden" id="r50" name= "r50" value="{{$climas->r50}}">
<input type="hidden" id="r51" name= "r51" value="{{$climas->r51}}">
<input type="hidden" id="r52" name= "r52" value="{{$climas->r52}}">
<input type="hidden" id="r53" name= "r53" value="{{$climas->r53}}">
<input type="hidden" id="r54" name= "r54" value="{{$climas->r54}}">
<input type="hidden" id="r55" name= "r55" value="{{$climas->r55}}">
<input type="hidden" id="r56" name= "r56" value="{{$climas->r56}}">
<input type="hidden" id="r57" name= "r57" value="{{$climas->r57}}">
<input type="hidden" id="r58" name= "r58" value="{{$climas->r58}}">
<input type="hidden" id="r59" name= "r59" value="{{$climas->r59}}">
<input type="hidden" id="r60" name= "r60" value="{{$climas->r60}}">
<input type="hidden" id="r61" name= "r61" value="{{$climas->r61}}">
<input type="hidden" id="r62" name= "r62" value="{{$climas->r62}}">
<input type="hidden" id="r63" name= "r63" value="{{$climas->r63}}">
<input type="hidden" id="r64" name= "r64" value="{{$climas->r64}}">
<input type="hidden" id="r65" name= "r65" value="{{$climas->r65}}">
<input type="hidden" id="r66" name= "r66" value="{{$climas->r66}}">
<input type="hidden" id="r67" name= "r67" value="{{$climas->r67}}">
<input type="hidden" id="r68" name= "r68" value="{{$climas->r68}}">
<input type="hidden" id="r69" name= "r69" value="{{$climas->r69}}">
<input type="hidden" id="r70" name= "r70" value="{{$climas->r70}}">
<input type="hidden" id="r71" name= "r71" value="{{$climas->r71}}">
<input type="hidden" id="r72" name= "r72" value="{{$climas->r72}}">
<input type="hidden" id="r73" name= "r73" value="{{$climas->r73}}">
<input type="hidden" id="r74" name= "r74" value="{{$climas->r74}}">
<input type="hidden" id="r75" name= "r75" value="{{$climas->r75}}">
<input type="hidden" id="r76" name= "r76" value="{{$climas->r76}}">
<input type="hidden" id="r77" name= "r77" value="{{$climas->r77}}">
<input type="hidden" id="r78" name= "r78" value="{{$climas->r78}}">
<input type="hidden" id="r79" name= "r79" value="{{$climas->r79}}">
<input type="hidden" id="r80" name= "r80" value="{{$climas->r80}}">
<input type="hidden" id="r81" name= "r81" value="{{$climas->r81}}">
<input type="hidden" id="r82" name= "r82" value="{{$climas->r82}}">
<input type="hidden" id="r83" name= "r83" value="{{$climas->r83}}">
<input type="hidden" id="r84" name= "r84" value="{{$climas->r84}}">
<input type="hidden" id="r85" name= "r85" value="{{$climas->r85}}">
<input type="hidden" id="r86" name= "r86" value="{{$climas->r86}}">
<input type="hidden" id="r87" name= "r87" value="{{$climas->r87}}">
<input type="hidden" id="r88" name= "r88" value="{{$climas->r88}}">
<input type="hidden" id="r89" name= "r89" value="{{$climas->r89}}">
<input type="hidden" id="r90" name= "r90" value="{{$climas->r90}}">
<input type="hidden" id="r91" name= "r91" value="{{$climas->r91}}">
<input type="hidden" id="r92" name= "r92" value="{{$climas->r92}}">
<input type="hidden" id="r93" name= "r93" value="{{$climas->r93}}">
<input type="hidden" id="r94" name= "r94" value="{{$climas->r94}}">
<input type="hidden" id="r95" name= "r95" value="{{$climas->r95}}">
<input type="hidden" id="r96" name= "r96" value="{{$climas->r96}}">
<input type="hidden" id="r97" name= "r97" value="{{$climas->r97}}">
<input type="hidden" id="r98" name= "r98" value="{{$climas->r98}}">
<input type="hidden" id="r99" name= "r99" value="{{$climas->r99}}">
<input type="hidden" id="r100" name= "r100" value="{{$climas->r100}}">
<input type="hidden" id="r101" name= "r101" value="{{$climas->r101}}">
<input type="hidden" id="r102" name= "r102" value="{{$climas->r102}}">
<input type="hidden" id="r103" name= "r103" value="{{$climas->r103}}">
<input type="hidden" id="r104" name= "r104" value="{{$climas->r104}}">
</p>
<script>
function myFunc() 
{
    /* obtiene el elemento activo (objeti) y su ID (string)
    
     get the active elemente en actEle (object) and its ID in actEleID (string)  */
    var actEle = document.activeElement;     
    var actEleID = actEle.id;    
    //alert("actEleID="+actEleID);
    /*
    if (actEleID == "fk_cve_periodo") 
    {
      document.getElementById("fecha").disabled = false;      
      return;
    }
    */
    /* si el elemento activo es fecha abre el campo siguiente que es area
    
    if the active element is "fecha" (date), the next element in de form is enables witch is "area"
    */
    //alert("actEleID="+actEleID);
    if (actEleID == "fecha") 
    {
      document.getElementById("area").disabled = false;
      //alert("IDr2.disabled=");
      //alert(IDr2.id);
      var i_str = "";
      var i_fix = "";
      var i_fix2 = "";
      var val = "";
      var i = 0;
      var IDr1 = document.getElementById( "r001_1");

      for (i = 1; i < 105; i ++)
      {   
        //alert("fecha");
        i_str = i.toString();
        i_fix = "r"+ i_str;
        //alert(i_fix);
        val = document.getElementById( i_fix).value;
        i_fix2 = myFunc_fixn( i);
        //alert(ele2);
        if (val == "1") 
        {
            IDr1 = document.getElementById( "r" + i_fix2 + "_1");
            IDr1.checked = true;
            myFunc_enable( "r" + i_fix2 + "_");
        }
        if (val == "2") 
        {
          IDr1 = document.getElementById( "r" + i_fix2 + "_2");
          IDr1.checked = true;
          myFunc_enable( "r" + i_fix2 + "_");
        }
        if (val == "3") 
        {
          IDr1 = document.getElementById( "r" + i_fix2 + "_3");
          IDr1.checked = true;
          myFunc_enable( "r" + i_fix2 + "_");
        }
        if (val == "4") 
        {
          IDr1 = document.getElementById( "r" + i_fix2 + "_4");
          IDr1.checked = true;
          myFunc_enable( "r" + i_fix2 + "_");
        }
        //alert(val); 
      }
      return;
    }
    /* si el elemento activo es "area" abre el campo siguiente que es r001_1, r001_2, r001_3, r001_4
    lo cuales pertenecen a la primera pregunta

    if the active element is "area* then enable the next 4 elements r001_1, r001_2, r001_3, r001_4
    those are 4 radio buttons of the first question */
    if (actEleID == "area") 
    {
      myFunc_enable("r001_");
      return;
    } 
    /* si el elemento activo es la primera pregunta entonces valida que area tenga al menos 10 caracteres 
      y regresa el cursor al campo area

    if the active element is the first question then checks if "area" contains at least 10 characters    
    */
    if (actEleID.substring(0,5) == "r001_") 
    {
      var areao = document.getElementById("area");
      var tarea = areao.value.length;      
      if  (tarea < 5)
      {
        // menos de 5 caracteres pone una ventana con el mensaje y cambia al campo "area" par aintentar de nuevo
        //debe arreflar el boton radio de la 1ra pregunta

        //less than 5 characters, pop up a windows with message, and focus on the "area" field to try again  
        //mst fix the radio button on the 1sr question

        alert( "El area debe contener al menos 5 caracteres");
        myFunc_radio( actEleID, "r001_", 1) ;
        areao.focus();
        return;
      } 
    }
    //alert("actEleID="+actEleID);
    /* 
      en esta rutina revisa desde la pregunta 1 hasta la 103, exepto la ultima
      valida que solo 1 boton radio este activo parra cada una y habilita la pregunta siguiente 
      
      in this loop checks from question 1 to 103, (not the last one)
      only one radio button anabled for each question, and enable next field
    */
    for (let i = 1; i < 104; i ++)
    {        
        var ele  = "r" + myFunc_fixn( i) + "_";
        var nele = "r" + myFunc_fixn( i + 1) + "_";     
        var elea = actEleID.substring(0,5);
        if ( elea == ele)
        {
          //alert(elea);
          //alert("actEleID="+actEleID);
          myFunc_radio( actEleID, ele, i) ;
          myFunc_enable( nele);
          return;
        }
    }
    //alert("actEleID="+actEleID);
    
    if (actEleID.substring(0,5) == "r104_") 
    {
      myFunc_radio( actEleID, "r104_", 104) ;
      document.getElementById("btn_ok").disabled = false;       
      var IDr1 = document.getElementById( "cve_periodo");   
      var IDr2 = document.getElementById( "fk_cve_periodo");   
      //alert("IDr1.value=" + IDr1.value);
      IDr2.value = IDr1.value;
      return;
    }       
}
function myFunc_fixn( i) 
{
  var ele = i.toString();
  if (ele.length==1) {  ele = "00" + ele; }
  if (ele.length==2) {  ele = "0" + ele; }
  return ele;
}
function myFunc_enable( par) 
{
      document.getElementById( par + "1").disabled = false;
      document.getElementById( par + "2").disabled = false;
      document.getElementById( par + "3").disabled = false;
      document.getElementById( par + "4").disabled = false;
}
function myFunc_radio( actEleID, par, i) 
{  
  var IDr2 = document.getElementById( "r" + i.toString() );  
  if (actEleID == par + "1")
    {
      IDr2.value = "1";
      document.getElementById( par + "1").checked = true;
      document.getElementById( par + "2").checked = false;
      document.getElementById( par + "3").checked = false;
      document.getElementById( par + "4").checked = false;
      return;
    } 
    if (actEleID == par + "2")
    {
      IDr2.value = "2";
      document.getElementById( par + "1").checked = false;
      document.getElementById( par + "2").checked = true;
      document.getElementById( par + "3").checked = false;
      document.getElementById( par + "4").checked = false;
      return;
    } 
    if (actEleID ==  par + "3")
    {
      IDr2.value = "3";
      document.getElementById( par + "1").checked = false;
      document.getElementById( par + "2").checked = false;
      document.getElementById( par + "3").checked = true;
      document.getElementById( par + "4").checked = false;
      return;
    } 
    if (actEleID ==  par + "4")
    {
      IDr2.value = "4";
      document.getElementById( par + "1").checked = false;
      document.getElementById( par + "2").checked = false;
      document.getElementById( par + "3").checked = false;
      document.getElementById( par + "4").checked = true;
      return;
    } 
}
</script>