<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('memberships', function(Blueprint $table)
		{
			$table->engine = 'InnoDb';
			$table->increments('id');
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('projects')->on_delete('cascade');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->on_delete('cascade');
			$table->unique(array('user_id', 'project_id'));
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
		Schema::drop('memberships');
	}

}
