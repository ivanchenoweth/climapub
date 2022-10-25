<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilclimasSeeder extends Seeder
{    
    public function run()
    {
        DB::table('perfilclimas')->insert([
            'cve_perfil_clima'  => '010',
            'descripcion'       => 'Calidad de VIda Laboral',
            'pregunta_inicio'   => '1',
            'pregunta_fin'      => '20',
        ]);
        DB::table('perfilclimas')->insert([
            'cve_perfil_clima'  => '020',
            'descripcion'       => 'Autonomía',
            'pregunta_inicio'   => '21',
            'pregunta_fin'      => '25',
        ]);
        DB::table('perfilclimas')->insert([            
            'cve_perfil_clima'  => '030',
            'descripcion'       => 'Trabajo en equipo',
            'pregunta_inicio'   => '26',
            'pregunta_fin'      => '33',
        ]);
        DB::table('perfilclimas')->insert([
            'cve_perfil_clima'  => '040',
            'descripcion'       => 'Trato de mi jefe inmediato',
            'pregunta_inicio'   => '34',
            'pregunta_fin'      => '53',
        ]);
        DB::table('perfilclimas')->insert([
            'cve_perfil_clima'  => '050',            
            'descripcion'       => 'Comunicación',
            'pregunta_inicio'   => '54',
            'pregunta_fin'      => '62',
        ]);
        DB::table('perfilclimas')->insert([
            'cve_perfil_clima'  => '060',
            'descripcion'       => 'Presión',
            'pregunta_inicio'   => '63',
            'pregunta_fin'      => '68',
        ]);
        DB::table('perfilclimas')->insert([
            'cve_perfil_clima'  => '070',
            'descripcion'       => 'Apoyo',
            'pregunta_inicio'   => '69',
            'pregunta_fin'      => '76',
        ]);
        DB::table('perfilclimas')->insert([
            'cve_perfil_clima'  => '080',
            'descripcion'       => 'Reconocimiento',
            'pregunta_inicio'   => '77',
            'pregunta_fin'      => '87',
        ]);
        DB::table('perfilclimas')->insert([
            'cve_perfil_clima'  => '090',
            'descripcion'       => 'Equidad y NO discriminación',
            'pregunta_inicio'   => '88',
            'pregunta_fin'      => '97',
        ]);
        DB::table('perfilclimas')->insert([
            'cve_perfil_clima'  => '100',
            'descripcion'       => 'Innovación',
            'pregunta_inicio'   => '98',
            'pregunta_fin'      => '104',
        ]);
    }
}