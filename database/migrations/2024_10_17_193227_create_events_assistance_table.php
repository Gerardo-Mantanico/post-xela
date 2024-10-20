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
        Schema::create('events_assistance', function (Blueprint $table) {
            $table->id('id_event');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_post');
            $table->integer('days');
            $table->date('term');
            $table->timestamps();
            $table->foreign('id_post')->references('id_post')->on('posts')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_assistance');
    }
};
