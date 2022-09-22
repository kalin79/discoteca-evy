<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->id();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('dni_promotor',10)->nullable();
            $table->integer('promotor_id')->nullable();
            $table->string('codigo')->nullable();
            $table->string('imagen_qr')->nullable();
            $table->integer('tipo_ubicacion_id')->nullable();
            $table->integer('zona_id')->nullable();
            $table->integer('ingreso')->default(0);
            $table->integer('active')->default(1);
            $table->integer('usuario_registra_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_user_id')->nullable();
            $table->integer('updated_user_id')->nullable();
            $table->integer('deleted_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socios');
    }
};
