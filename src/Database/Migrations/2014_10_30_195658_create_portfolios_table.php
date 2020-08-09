<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfoliosTable extends Migration
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
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->integer('author_id');
            $table->string('slug')->unique();
            $table->integer('position')->nullable();
            $table->enum('status', ['published', 'unpublished','draft'])->default('draft');
            $table->text('gallery')->nullable();
            $table->text('images')->nullable();
            $table->boolean('top')->nullable();
            $table->integer('views')->default(0);
            $table->timestamp('published_at')->useCurrent = true;
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('portfolio_translations', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('portfolio_id')->unsigned();
            $table->string('title');
            $table->string('locale');
            $table->text('summary')->nullable();
            $table->text('content')->nullable();
            $table->text('meta')->nullable();

            $table->unique(['portfolio_id', 'locale']);
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');

            DB::statement('SET FOREIGN_KEY_CHECKS = 1');



        });
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
        Schema::dropIfExists('portfolio_translations');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
