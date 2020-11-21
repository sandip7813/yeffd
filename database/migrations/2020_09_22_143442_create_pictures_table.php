<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('org_image', 255)->nullable();
            $table->string('mod_image', 255)->nullable();
            $table->string('thumb_image', 255)->nullable();
            $table->tinyInteger('application')->nullable()->comment('0 = gallery, 1 = events, 2 = success stories');
            $table->integer('application_id')->default(0);
            $table->tinyInteger('status')->default(1)->comment('0 = inactive, 1 = active');
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
        Schema::dropIfExists('pictures');
    }
}
