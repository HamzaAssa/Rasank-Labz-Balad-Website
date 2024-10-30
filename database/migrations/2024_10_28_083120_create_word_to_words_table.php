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
            $table->foreignId('balochi_id')->default(1)->constrained('words')->onDelete('cascade');
            $table->foreignId('urdu_id')->default(2)->constrained('words')->onDelete('cascade');
            $table->foreignId('english_id')->default(3)->constrained('words')->onDelete('cascade');
            $table->foreignId('roman_balochi_id')->default(4)->constrained('words')->onDelete('cascade');  
            // $table->unique(['balochi_id', 'urdu_id', 'english_id', 'roman_balochi_id']);
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::table('word_to_words', function (Blueprint $table) {
            $table->dropForeign(['balochi_id']);
            $table->dropForeign(['urdu_id']);
            $table->dropForeign(['english_id']);
            $table->dropForeign(['roman_balochi_id']);
        });
        Schema::dropIfExists('word_to_words');
    }
};
