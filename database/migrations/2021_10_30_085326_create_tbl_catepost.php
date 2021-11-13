<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCatepost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_catepost', function (Blueprint $table) {
            $table->increments('cate_post_id');
            $table->string('cate_post_name', 100);
            $table->text('cate_post_desc');
            $table->integer('cate_post_status');
            $table->string('cate_post_slug', 100);
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
        Schema::dropIfExists('tbl_catepost');
    }
}