<?php

class WeeksTableSeeder extends Seeder {
	public function run()
	{
		DB::table('weeks')->delete();
		$dates = array("2/17/2014", "2/24/2014", "3/10/2014", 
			"3/17/2014", "3/24/2014", "3/31/2014", "4/14/2014",
			"4/21/2014", "5/5/2014", "5/9/2014");
		foreach(Project::all() as $project){
			for($i = 0; $i < count($dates); $i++){
				$week = new Week();
				$week->project()->associate($project);
				$end_date = new DateTime($dates[$i]);
				$week->end_date = $end_date->format('Y-m-d');
				$week->number = $i+1;
				$week->save();
			}
		}
	}
}
