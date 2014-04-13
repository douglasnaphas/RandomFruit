<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeeksToTickets extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tickets', function(Blueprint $table)
		{
			$table->integer('week_due_id')->unsigned()->nullable()->default(NULL);
			$table->foreign('week_due_id')->references('id')->on('weeks')->onDelete('set null')->nullable()->default(NULL);
			$table->integer('week_completed_id')->unsigned()->nullable()->default(NULL);
			$table->foreign('week_completed_id')->references('id')->on('weeks')->onDelete('set null')->nullable()->default(NULL);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tickets', function(Blueprint $table)
		{
			$table->dropForeign('tickets_week_due_id_foreign');
			$table->dropForeign('tickets_week_completed_id_foreign');
		});
	}

}
