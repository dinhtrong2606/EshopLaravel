<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_post', function (Blueprint $table) {
            $table->increments('post_id');
            $table->integer('cate_post_id');
            $table->string('post_title');
            $table->string('post_slug');
            $table->string('post_desc');
            $table->string('post_content');
            $table->string('post_meta_desc');
            $table->string('post_meta_keywords');
            $table->integer('post_status');
            $table->string('post_image', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_post');
    }
}