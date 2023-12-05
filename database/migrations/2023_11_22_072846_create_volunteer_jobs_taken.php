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
        Schema::create('volunteer_jobs_takens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id')->nullable();
            $table->unsignedBigInteger('taken_by')->nullable();
            $table->enum('status', ['accepted', 'reviewing', 'completed'])->default('accepted');
            $table->timestamps();
            
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('taken_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_jobs_takens');
    }
};
