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
        Schema::create('job_taken_proof', function (Blueprint $table) {
            $table->id();
            $table->string('proof')->nullable(); 
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->timestamps(); 


            $table->foreign('transaction_id')->references('id')->on('volunteer_jobs_takens'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_taken_proof');
    }
};
