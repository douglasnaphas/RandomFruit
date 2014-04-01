<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->mediumText('description');
			$table->integer('planned_hours');
			$table->integer('actual_hours');
			$table->integer('number');
			$table->date('due_date')->nullable();
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('projects');
			$table->integer('creator_id')->unsigned();
			$table->foreign('creator_id')->references('id')->on('users');
			$table->integer('owner_id')->unsigned();
			$table->foreign('owner_id')->references('id')->on('users');

			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tickets');
	}

}
