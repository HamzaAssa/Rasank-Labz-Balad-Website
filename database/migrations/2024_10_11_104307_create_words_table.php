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
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->string('language');
            $table->integer('status'); // 0 status is unverified, 1 is pending, 2 is verified
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
        
        Schema::dropIfExists('word_to_words');
        // Schema::table('word_to_words', function (Blueprint $table)
        // {   
        //     $table->dropForeign(['balochi_id', 'english_id', 'urdu_id', 'roman_balochi_id']);
        //     $table->dropColumn('balochi_id');
        //     $table->dropColumn('english_id');
        //     $table->dropColumn('urdu_id');
        //     $table->dropColumn('roman_balochi_id');
        // });
        Schema::dropIfExists('words');
    }
};
