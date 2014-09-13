<?php
class Post extends Eloquent{
	/**
	 * Şema ismi
	 * @var string
	 */
	protected $table = 'posts';
	
	/**
	 * Primary Key ismi
	 * @var string
	 */
	protected $primaryKey = 'post_id';
	
	/**
	 * Toplu doldurulabilecek alan isimleri
	 * @var array
	 */
	protected $fillable = array('post_title', 'post_content', 'published');
	
	/**
	 * Şema ilişki tanımı
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(){
		/*
		 * İçeriklerin kullanıcılara bağlanmasını sağlar. 
		 * İlk parametre uzak model ismi, 
		 * ikinci parametre bu modeldeki bağlanacak alan ismi, 
		 * üçüncü parametre ise uzak modeldeki referans alan ismidir.
		 */
		return $this->belongsTo('User', 'user_id', 'user_id');
	}
	
	public function comments(){
		return $this->hasMany('Comment', 'post_id', 'post_id');
	}
}