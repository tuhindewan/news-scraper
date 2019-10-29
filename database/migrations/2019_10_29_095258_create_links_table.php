<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->string('main_filter_selector');   // this is the main filter selector used in the main filter() function
            $table->unsignedInteger('website_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('item_schema_id')->nullable();
            $table->foreign('website_id')
                ->references('id')
                ->on('websites')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('item_schema_id')
                ->references('id')
                ->on('item_schemas')
                ->onUpdate('cascade')
                ->onDelete('set null');
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
        Schema::dropIfExists('links');
    }
}
