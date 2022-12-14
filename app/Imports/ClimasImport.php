<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Climas;

class ClimasImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Climas([            
            'fk_id_plantillas'  => $row['id_plantillas'],
            'fk_cve_periodo'    => $row['cve_periodo'],
            'fecha'             => $row['fecha'],
            'area'              => $row['area'],
            /*
            'calidad_de_vida'   => $row['calidad_de_vida_laboral'],
            'autonomia'         => $row['autonomia'],
            'trabajo_en_equipo' => $row['trabajo_en_equipo'],
            'trato_del_jefe'    => $row['trato_del_jefe_inmediato'],
            'comunicacion'      => $row['comunicacion'],
            'presion'           => $row['presion'],
            'apoyo'             => $row['apoyo'],
            'reconocimiento'    => $row['reconocimiento'],
            'equidad'           => $row['equidad_y_no_discriminacion'],
            'inovacion'         => $row['innovacion'],
            */
            'r1'               => $row['r1'],
            'r2'               => $row['r2'],
            'r3'               => $row['r3'],
            'r4'               => $row['r4'],
            'r5'               => $row['r5'],
            'r6'               => $row['r6'],
            'r7'               => $row['r7'],
            'r8'               => $row['r8'],
            'r9'               => $row['r9'],
            'r10'              => $row['r10'],
            'r11'              => $row['r11'],
            'r12'              => $row['r12'],
            'r13'              => $row['r13'],
            'r14'              => $row['r14'],
            'r15'              => $row['r15'],
            'r16'              => $row['r16'],
            'r17'              => $row['r17'],
            'r18'              => $row['r18'],
            'r19'              => $row['r19'],
            'r20'              => $row['r20'],
            'r21'              => $row['r21'],
            'r22'              => $row['r22'],
            'r23'              => $row['r23'],
            'r24'              => $row['r24'],
            'r25'              => $row['r25'],
            'r26'              => $row['r26'],
            'r27'              => $row['r27'],
            'r28'              => $row['r28'],
            'r29'              => $row['r29'],
            'r30'              => $row['r30'],
            'r31'              => $row['r31'],
            'r32'              => $row['r32'],
            'r33'              => $row['r33'],
            'r34'              => $row['r34'],
            'r35'              => $row['r35'],
            'r36'              => $row['r36'],
            'r37'              => $row['r37'],
            'r38'              => $row['r38'],
            'r39'              => $row['r39'],
            'r40'              => $row['r40'],
            'r41'              => $row['r41'],
            'r42'              => $row['r42'],
            'r43'              => $row['r43'],
            'r44'              => $row['r44'],
            'r45'              => $row['r45'],
            'r46'              => $row['r46'],
            'r47'              => $row['r47'],
            'r48'              => $row['r48'],
            'r49'              => $row['r49'],
            'r50'              => $row['r50'],
            'r51'              => $row['r51'],
            'r52'              => $row['r52'],
            'r53'              => $row['r53'],
            'r54'              => $row['r54'],
            'r55'              => $row['r55'],
            'r56'              => $row['r56'],
            'r57'              => $row['r57'],
            'r58'              => $row['r58'],
            'r59'              => $row['r59'],
            'r60'              => $row['r60'],
            'r61'              => $row['r61'],
            'r62'              => $row['r62'],
            'r63'              => $row['r63'],
            'r64'              => $row['r64'],
            'r65'              => $row['r65'],
            'r66'              => $row['r66'],
            'r67'              => $row['r67'],
            'r68'              => $row['r68'],
            'r69'              => $row['r69'],
            'r70'              => $row['r70'],
            'r71'              => $row['r71'],
            'r72'              => $row['r72'],
            'r73'              => $row['r73'],
            'r74'              => $row['r74'],
            'r75'              => $row['r75'],
            'r76'              => $row['r76'],
            'r77'              => $row['r77'],
            'r78'              => $row['r78'],
            'r79'              => $row['r79'],
            'r80'              => $row['r80'],
            'r81'              => $row['r81'],
            'r82'              => $row['r82'],
            'r83'              => $row['r83'],
            'r84'              => $row['r84'],
            'r85'              => $row['r85'],
            'r86'              => $row['r86'],
            'r87'              => $row['r87'],
            'r88'              => $row['r88'],
            'r89'              => $row['r89'],
            'r90'              => $row['r90'],
            'r91'              => $row['r91'],
            'r92'              => $row['r92'],
            'r93'              => $row['r93'],
            'r94'              => $row['r94'],
            'r95'              => $row['r95'],
            'r96'              => $row['r96'],
            'r97'              => $row['r97'],
            'r98'              => $row['r98'],
            'r99'              => $row['r99'],
            'r100'             => $row['r100'],
            'r101'             => $row['r101'],
            'r102'             => $row['r102'],
            'r103'             => $row['r103'],
            'r104'             => $row['r104'],
            'activo'            => true
        ]);
    }
}