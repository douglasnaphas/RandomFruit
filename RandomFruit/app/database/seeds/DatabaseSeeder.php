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

		$this->call('UserTableSeeder');
		$this->call('ProjectTableSeeder');
		$this->call('MemberShipTableSeeder');
		$this->call('TicketTableSeeder');
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
	}
}
