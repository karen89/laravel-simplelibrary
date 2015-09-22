<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {
	
	function run() {
		User::truncate();
		User::Create([
			'username' => 'cristian',
			'email' => 'cristian@library.com',
			'password' => '1234',
		]);

		User::Create([
			'username' => 'michael',
			'email' => 'michael@library.com',
			'password' => '1234',
		]);

		User::Create([
			'username' => 'rachel',
			'email' => 'rachel@library.com',
			'password' => '1234',
		]);
	}
	
}
