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
        Schema::create('matching_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id');
            $table->integer('user_id')->nullable();
            $table->integer('answer_id')->nullable();
            $table->integer('target_answer_id')->nullable();
            $table->index(['user_id','question_id','target_answer_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matching_answers');
    }
};
