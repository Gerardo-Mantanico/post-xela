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
        Schema::create('posts', function (Blueprint $table) {
            $table->id('id_post');
            $table->unsignedBigInteger('id_user');
            $table->string('title');
            $table->date('date_event');
            $table->time('time_event');
            $table->integer('capacity');
            $table->integer('confirmed');
            $table->string('address');
            $table->longText('description');
            $table->unsignedBigInteger('id_category');
            $table->enum('state_publication', ['ACTIVATED', 'REFUSED', 'PENDING', 'BAN']); // Corregido
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_category')->references('id_category')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
