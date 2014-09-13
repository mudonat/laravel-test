<?php
class UserTableSeeder extends Seeder{
	public function run(){
		DB::table('users')->delete();
		User::create(array('username'=>'murat',
						   'password'=>Hash::make('parolam'),
						   'email'=>'murat@muratonat.com',
						   'level'=>'Admin'));
	}
}