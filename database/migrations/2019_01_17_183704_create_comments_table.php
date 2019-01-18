<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {

            // create the required columns
            
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->string('full_name', 100);
            $table->longText('comment');
            $table->timestamps();

            // create indexes to speed up queries

            $table->index(['full_name', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
