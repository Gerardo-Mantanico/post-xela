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
        Schema::create('post_baneada', function (Blueprint $table) {
            $table->id('id_post_baneada');
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_publishe');
            $table->integer('no_report');
            $table->boolean('baneada');
            $table->foreign('id_publishe')->references('id_publishe')->on('publishes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_baneada');
    }
};
