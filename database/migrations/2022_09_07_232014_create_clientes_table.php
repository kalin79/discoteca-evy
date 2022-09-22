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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('email')->nullable();
            $table->string('dni')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('distrito_id')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('ciudad')->default('LIMA');
            $table->string('codigo')->nullable();
            $table->integer('evento_id')->nullable();
            $table->integer('promotor_id')->nullable();
            $table->integer('zona_id')->nullable();
            $table->integer('ingreso')->default(0);
            $table->integer('tyc')->default(0);
            $table->integer('tyc_publicidad')->default(0);
            $table->string('imagen_qr')->nullable();
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
        Schema::dropIfExists('clientes');
    }
};
