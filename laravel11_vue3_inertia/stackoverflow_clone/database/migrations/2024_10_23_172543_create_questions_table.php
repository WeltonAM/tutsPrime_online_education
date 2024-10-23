<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('questions')) {
            Schema::create('questions', function (Blueprint $table) {
                $table->bigIncrements('id'); // Big integer ID for questions
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('body');
                $table->unsignedInteger('views')->default(0);
                $table->unsignedInteger('answers_count')->default(0);
                $table->integer('votes_count')->default(0);
                $table->unsignedBigInteger('best_answer_id')->nullable(); // Use unsignedBigInteger for foreign key
                $table->unsignedBigInteger('user_id'); // unsignedBigInteger for foreign key
                $table->timestamps();

                // Foreign key constraints
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('best_answer_id')->references('id')->on('answers')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
