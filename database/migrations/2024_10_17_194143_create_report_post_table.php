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
        Schema::create('report_post', function (Blueprint $table) {
            $table->id('id_report');
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_user_report');
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->string('cause');
            $table->enum('state_report', ['APPROVED', 'REFUSED', 'PENDING']);
            $table->timestamps();
            $table->foreign('id_post')->references('id_post')->on('posts')->onDelete('cascade');
            $table->foreign('id_user_report')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_admin')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_post');
    }
};