<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('portfolioTags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('status', ['published', 'unpublished'])->default('published');
            $table->text('images')->nullable();
            $table->text('ordered')->nullable();
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

        Schema::dropIfExists('portfolioTags');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
