<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class PostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('posts', function($table){
			$table->engine = 'MyISAM';
			$table->unsignedInteger('post_id', true); //ileti kimliği "unsigned integer auto_increment"
			$table->integer('user_id'); //kullanıcı kimliği "integer"
			$table->string('post_title', 255); //ileti başlığı "varchar(255)"
			$table->text('post_content'); //ileti içeriği "text"
			$table->boolean('published'); //yayın durumu "boolean"
			$table->timestamps(); //oluşturulma ve düzenlenme tarihi "timestamp"
			$table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'); //bu tablodaki user_id isimli alanın, users tablosundaki user_id alanını temsil ettiğini belirtiyoruz.
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('posts');
	}

}
