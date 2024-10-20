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
        Schema::create('publication_verifaction', function (Blueprint $table) {
            $table->id('id_verification');
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->unsignedBigInteger('id_publishe');
            $table->boolean('state');
            $table->timestamps();
            $table->foreign('id_post')->references('id_post')->on('posts')->onDelete('cascade');
            $table->foreign('id_admin')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_publishe')->references('id_publishe')->on('publishes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_verifaction');
    }
};
