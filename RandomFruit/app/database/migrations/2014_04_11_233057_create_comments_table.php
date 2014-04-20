<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->nullable();
			$table->integer('ticket_id')->unsigned();
			$table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
			$table->mediumText('content');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
