<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('ordered')->nullable();
            $table->enum('status', ['published', 'unpublished','draft'])->default('draft');
            $table->text('image')->nullable();
            $table->string('alt')->nullable();
            $table->text('media')->nullable();
            $table->text('summary')->nullable();
            $table->text('content')->nullable();
            $table->boolean('top')->nullable();
            $table->integer('views')->default(0);
            $table->text('meta_description')->nullable();
            $table->timestamp('published_at')->useCurrent = true;
            $table->timestamps();
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

        Schema::dropIfExists('portfolios');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
