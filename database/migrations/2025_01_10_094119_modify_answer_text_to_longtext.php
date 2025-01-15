<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAnswerTextToLongtext extends Migration
{
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            // Mengubah kolom answer_text menjadi LONGTEXT
            $table->longText('answer_text')->change();
        });
    }

    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            // Mengembalikan kolom answer_text ke tipe sebelumnya (misalnya TEXT)
            $table->text('answer_text')->change();
        });
    }
}
