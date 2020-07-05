<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('portfolioCategorires', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('parent_id')->nullable();
            $table->text('images')->nullable();
            $table->integer('ordered')->nullable();
            $table->enum('status',['published','unpublished'])->default('published');
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->text('meta_description')->nullable();
            $table->softDeletes();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('portfolioCategorires');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
