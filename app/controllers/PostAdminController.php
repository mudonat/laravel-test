<?php
class PostAdminController extends BaseController{
	public function index(){
		return View::make('post.index', array('posts'=>Post::all()));
	}
	
	public function createShow(){
		return View::make('post.create', array('post' => new Post));
	}
	
	public function createDo(){
		$validator = Validator::make(Input::all(), array('post_title'=>'required'), 
												   array('post_title.required'=>'Yazı başlığı boş bırakılamaz.'));
		
		if($validator->fails())
			return Redirect::to('admin/posts/create')->withErrors($validator)->withInput();
		
		$post = new Post;
		$post->post_title = Input::get('post_title');
		$post->post_content = Input::get('post_content');
		$post->published = (int)Input::get('published');
		$post->user_id = Auth::user()->user_id;
		if($post->save())
			return Redirect::to(URL::to('admin/posts/edit', array('id'=>$post->post_id)))->with('message', 'İçerik oluşturuldu');
		return Redirect::to('admin/posts/create')->with('message', 'İçerik oluşturulamadı.');
	}
	
	public function editShow($id=null){
		$post = Post::find((int)$id);
		if($post)
			return View::make('post.create', array('post'=>$post));
		return Redirect::to('admin/posts')->with('message', 'İçerik bulunamadı.');
	}
	
	public function editDo($id=null){
		//içerik kontrolü
		$post = Post::find((int)$id);
		if(!$post)
			return Redirect::to('admin/posts')->with('message', 'İçerik bulunamadı.');
		
		//hata mesajları
		$validator = Validator::make(Input::all(), array('post_title'=>'required'),
												   array('post_title.required'=>'Yazı başlığı boş bırakılamaz.'));
		
		//Form hata tespiti
		if($validator->fails())
			return Redirect::to(URL::to('admin/posts/edit', array('id'=>$id)))->withErrors($validator)->withInput();
		
		$changedPost = Input::all();
		$changedPost['published'] = (int)Input::get('published');//checkbox olan published alanı için ayrıca kontrol ekliyoruz.
		
		$message = 'İçerik düzenlenemedi.';
		if($post->update($changedPost))//kayıt işlemi
			$message = 'İçerik düzenlendi.';
		
		//Düzenleme sayfasına geri yönlendir.
		return Redirect::to(URL::to('admin/posts/edit', array('id'=>$id)))->withMessage($message);
	}
	
	public function delete($id=null){
		//içerik bilgisini veritabanından çek.
		$post = Post::find((int)$id);
		
		//varsayılan mesajı kaydet.
		$message = 'İçerik silinemedi.';
		
		//eğer içerik bulunamazsa mesajı değiştir.
		if(!$post)
			$message = 'Hatalı veri.';
		
		//eğer içerik silinirse mesajı değiştir.
		if($post->delete())
			$message = 'İçerik silindi.';
		
		//kullanıcıyı listeleme sayfasına yönlendir.
		return Redirect::to('admin/posts')->withMessage($message);
	}
}