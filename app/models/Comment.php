<?php
class Comment extends Eloquent{
	/**
	 * Şema ismi
	 * @var string
	 */
	protected $table = 'comments';
	
	/**
	 * Primary Key ismi
	 * @var string
	 */
	protected $primaryKey = 'comment_id';
	
	/**
	 * Toplu doldurulabilecek alan isimleri
	 * @var array
	 */
	protected $fillable = array('post_id', 'comment', 'ip_address', 'sender_name', 'sender_email');
	
	/**
	 * Şema ilişki tanımı
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function post(){
		/*
		 * Yorumların yazılara bağlanmasını sağlar. 
		 * İlk parametre uzak model ismi, 
		 * ikinci parametre bu modeldeki bağlanacak alan ismi, 
		 * üçüncü parametre ise uzak modeldeki referans alan ismidir.
		 */
		return $this->belongsTo('Post', 'post_id', 'post_id');
	}
}