<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->boolean('publish_status')->nullable();
            $table->string('menu_title');
            $table->string('title')->nullable();
            $table->integer('type_id');
            $table->string('external_link')->nullable();
            $table->mediumText('descripton')->nullable();
            $table->mediumText('summary')->nullable();
            $table->string('parallex_img')->nullable();
            $table->string('featured_img')->nullable();
            $table->string('position')->nullable();
            $table->string('show_on')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('contents');
    }
}
