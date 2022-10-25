<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodosSeeder extends Seeder
{
    public function run()
    {   
        DB::table('periodos')->insert([            
            'cve_periodo' => '221',
            'descripcion' => 'EJERCICIO 2022',
            'fecha_ini' => '20220101',
            'fecha_fin' => '20221231',
        ]);        
    }
}