<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {  
       $this->call(PerfilclimasSeeder::class);
       $this->call(PerfilusersSeeder::class);
       $this->call(PeriodosSeeder::class);
       $this->call(UsersSeeder::class);
       $this->call(PlantillasSeeder::class);
       $this->call(ClimasSeeder::class);
       
    }
}