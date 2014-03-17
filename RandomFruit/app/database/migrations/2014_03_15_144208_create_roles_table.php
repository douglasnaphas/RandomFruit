<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name');
			$table->boolean('create_tickets');
			$table->boolean('delete_tickets');
			$table->boolean('modify_tickets');
			$table->boolean('close_tickets');
			$table->boolean('comment_tickets');
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('projects')->on_delete('cascade');
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
		Schema::drop('roles');
	}

}
