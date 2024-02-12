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
        Schema::create('worktimes', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->comment('プロジェクトID');
            $table->integer('submission_work_hours')->nullable()->comment('提出工数');
            $table->integer('submission_meeting_hours')->nullable()->comment('提出meeting工数');
            $table->integer('estimated_work_hours')->nullable()->comment('見積工数');
            $table->integer('actual_work_hours')->nullable()->comment('実工数');
            $table->integer('actual_meeting_hours')->nullable()->comment('実meeting工数');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worktimes');
    }
};
