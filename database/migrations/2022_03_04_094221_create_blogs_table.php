<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->increments('id_blog'); 
            $table->string('slug');
            $table->string('foto');
            $table->string('judul');
            $table->text('isi');
            $table->string('kategori');
            $table->date('uploaded');
            $table->string('uploader');
        });

        Schema::table('blog', function (Blueprint $table) {
            $table->foreign('uploader')->references('username')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
