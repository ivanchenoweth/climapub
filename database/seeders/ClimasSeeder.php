<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClimasSeeder extends Seeder
{
    public function run()
    {
        DB::table('climas')->insert([
            'fk_id_plantillas' => '1',
            'fk_cve_periodo' => '221',            
            'fecha' => '2022-01-01',
            'area' => 'DESARROLLO ORGANIZACIONAL',
            /*
            'calidad_de_vida' => '',
            'autonomia' => '',
            'trabajo_en_equipo' => '',
            'trato_del_jefe' => '',
            'comunicacion' => '',
            'presion' => '',
            'apoyo' => '',
            'reconocimiento' => '',
            'equidad' => '',
            'inovacion' => '',
            */            
            'activo' => true,
        ]); 
    }
}