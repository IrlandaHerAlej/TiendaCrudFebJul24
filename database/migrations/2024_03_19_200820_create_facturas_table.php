<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero');
            $table->text('detalles');
            $table->integer('valor');
            $table->string('archivo');
            $table->unsignedBigInteger('idcliente')->unsigned();
            $table->foreign('idcliente')->references('id')->on('clientes');
            $table->unsignedBigInteger('idforma')->unsigned();
            $table->foreign('idforma')->references('id')->on('formaspago');
            $table->unsignedBigInteger('idestado')->unsigned();
            $table->foreign('idestado')->references('id')->on('estadosfacturas');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
