<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$this->call('UserTableSeeder');
		$this->call('ProjectTableSeeder');
		$this->call('MemberShipTableSeeder');
		$this->call('TicketTableSeeder');
		$this->call('WeeksTableSeeder');
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

}

class UserTableSeeder extends Seeder {
	public function run()
	{
		DB::table('memberships')->delete();
		DB::table('users')->delete();
		User::create(
			array(
				'username' => 'admin',
				'password' => Hash::make('admin'),
				'email' => 'admin@localhost',
				'is_admin' => 1
			)
		);
		User::create(
			array(
				'username' => 'greg',
				'password' => Hash::make('gerg'),
				'email' => 'greg@localhost',
				'is_admin' => 1
			)
		);
		User::create(
			array(
				'username' => 'alex',
				'password' => Hash::make('xela'),
				'email' => 'greg@localhost',
				'is_admin' => 1
			)
		);
		User::create(
			array(
				'username' => 'jeff',
				'password' => Hash::make('ffej'),
				'email' => 'greg@localhost',
				'is_admin' => 1
			)
		);
	}
}
