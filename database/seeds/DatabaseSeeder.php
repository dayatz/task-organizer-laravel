<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {
    public function run() {
        DB::table('user')->delete();

        $users = array(
            array(
                'name' => 'Dayat',
                'email' => 'dayat.py@facebook.com',
                'password' => Hash::make('dayat'),
            ),
            array(
                'name' => 'Ela',
                'email' => 'elanovita.py@facebook.com',
                'password' => Hash::make('ela'),
            ),
            array(
                'name' => 'Juned',
                'email' => 'ahmad.junaed@facebook.com',
                'password' => Hash::make('juned'),
            ),
            array(
                'name' => 'Aulindra',
                'email' => 'putra.emeet@facebook.com',
                'password' => Hash::make('emet'),
            ),
        );

        DB::table('user')->insert($users);
    }
}
