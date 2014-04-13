<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('weeks', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('number');
			$table->date('end_date');
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
			$table->unique(array('number','project_id'));
			$table->integer('week_due')->unsigned()->nullable()->default(NULL);
			$table->foreign('week_completed')->references('id')->on('weeks')->onDelete('cascade')->nullable()->default(NULL);
			$table->integer('week_completed')->unsigned();
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
		Schema::drop('weeks');
	}

}
