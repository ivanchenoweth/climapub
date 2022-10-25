<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreatePerfilclimasTable extends Migration
{
    public function up()
    {
        Schema::create('perfilclimas', function (Blueprint $table) {
            $table->id();
            $table->string('cve_perfil_clima',3)->unique()->default("010");
            $table->string('descripcion',40)->default("");
            $table->tinyInteger('pregunta_inicio')->default("1");
            $table->tinyInteger('pregunta_fin')->default("104");
            $table->tinyInteger('ponderacion_1')->default("100");
            $table->tinyInteger('ponderacion_2')->default("75");
            $table->tinyInteger('ponderacion_3')->default("50");
            $table->tinyInteger('ponderacion_4')->default("25");
            $table->float('porcentaje_minimo',8,2)->default("70.0");
            $table->boolean('activo')->default(true);
            $table->timestamps();  
            $table->softDeletes();             
            });
    }
    public function down()
    {
        Schema::dropIfExists('perfilclimas');
    }
}