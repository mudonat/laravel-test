<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('comments', function($table){
			$table->engine = 'MyISAM';
			$table->unsignedInteger('comment_id', true); //yorum kimliği "integer unsigned auto_increment"
			$table->integer('post_id'); //ileti kimliği "integer"
			$table->text('comment'); //yorum içeriği "text"
			$table->string('ip_address',15); //gönderenin ip adresi "varchar(15)"
			$table->string('sender_name',255); //gönderenin adı "varchar(255)"
			$table->string('sender_email',255); //gönderenin e-posta adresi "varchar(255)"
			$table->timestamps(); //oluşturulma ve düzenlenme tarihi "timestamp"
			$table->foreign('post_id')->references('post_id')->on('posts')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('comments');
	}

}
