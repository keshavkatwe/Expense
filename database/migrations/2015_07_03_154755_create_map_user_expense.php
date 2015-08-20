<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapUserExpense extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('MapUserExpense', function (Blueprint $table) {
                    $table->increments('id');
                    $table->integer('expense_id')->unsigned();
                    $table->integer('user_id')->unsigned();
                    $table->timestamps();
                });

        Schema::table('MapUserExpense', function($table) {
                    $table->foreign('expense_id')->references('id')->on('expense');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('MapUserExpense');
    }

}
