<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('portfolio_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('slug')->unique();
            $table->integer('parent_id')->nullable();
            $table->text('images')->nullable();
            $table->integer('position')->nullable();
            $table->enum('status',['draft','published','unpublished'])->default('published');
            $table->softDeletes();
        });

        Schema::create('portfolio_category_translations', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('portfolio_category_id')->unsigned();
            $table->string('name');
            $table->string('locale');
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->text('meta')->nullable();

            $table->unique(['portfolio_category_id', 'locale']);
            $table->foreign('portfolio_category_id')->references('id')->on('portfolio_categories')->onDelete('cascade');
        });


        Schema::create('portfolio_portfolio_category', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('portfolio_category_id')->unsigned();
            $table->bigInteger('portfolio_id')->unsigned();


            $table->foreign('portfolio_category_id')->references('id')->on('portfolio_categories')->onDelete('cascade');
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
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

        Schema::dropIfExists('portfolio_categories');
        Schema::dropIfExists('portfolio_category_translations');
        Schema::dropIfExists('portfolio_portfolio_category');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
