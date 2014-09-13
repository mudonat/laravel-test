<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class UsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('users',function($table){
			$table->engine = 'MyISAM';
			$table->unsignedInteger('user_id', true); //kullanıcı kimliği alanı. "unsigned integer auto_increment"
			$table->string('username', 100)->unique(); //kullanıcı adı. "varchar(100)"
			$table->string('password', 100); //parola. "varchar(100)"
			$table->string('email', 255)->unique(); //e-posta. "varchar(255) unique"
			$table->enum('level', array('Admin', 'Moderator')); //kullanıcı seviyesi. "enum('Admin', 'Moderator')"
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('users');
	}

}