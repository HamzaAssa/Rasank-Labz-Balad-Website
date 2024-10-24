<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_to_words', function (Blueprint $table) {
            $table->id();
            $table->integer('balochi_id');
            $table->integer('urdu_id');
            $table->integer('english_id');
            $table->integer('roman_balochi_id');
            $table->date('date');
            $table->timestamps();
            $table->engine = 'InnoDB';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('word_to_words');
    }
};
