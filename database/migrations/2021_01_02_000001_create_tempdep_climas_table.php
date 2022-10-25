<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateTempdepclimasTable extends Migration
{
    public function up()
    {
        Schema::create('tempdep_climas', function (Blueprint $table) {            
            $table->string('dependencia',120)->default("");
            $table->string('cve_perfil_clima',3)->default("010");
            $table->string('descripcion_clima',40)->default("");
            $table->float('porcentaje', 8, 2);   
            $table->tinyInteger('pregunta_inicio')->default("1");
            $table->tinyInteger('pregunta_fin')->default("104");
            $table->tinyInteger('ponderacion_1')->default("100");
            $table->tinyInteger('ponderacion_2')->default("75");
            $table->tinyInteger('ponderacion_3')->default("50");
            $table->tinyInteger('ponderacion_4')->default("25");
            $table->tinyInteger('porcentaje_minimo')->default("70");         
            });
    }
    public function down()
    {
        Schema::dropIfExists('tempdep_climas');
    }
}