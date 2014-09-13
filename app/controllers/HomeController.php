<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome(){
		return View::make('hello');
	}
	
	public function loginShow(){
		return View::make('home.login');
	}
	
	public function loginDo(){
		/*
		 * Input validasyonlarını ayarlar
		 * username, zorunlu alandır ve alfanumerik karakter alabilir.
		 * password, zorunlu alandır.
		 * Validator::make fonksiyonunun üçüncü parametresi duruma göre hata mesajlarını özelleştirmek için kullanılabilir.
		 */
		$validator = Validator::make(Input::all(), array('username'=>'required|alphanum', 'password'=>'required'), array('username.alphanum'=>'Kullanıcı adı sadece alfanumerik karakterlerden oluşabilir.',
																														 'username.required'=>'Kullanıcı adı boş bırakılamaz',
																														 'password.required'=>'Parola boş bırakılamaz.'));
		//Eğer validasyondan geçemezse
		if($validator->fails())
			return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));//parola hariç tüm alanları tekrar login sayfasına yönlendir
		
		//eğer kullanıcı girişi yapılabilirse
		if(Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password'))))
			return Redirect::to('admin/posts');//admin/posts sayfasına yönlendir.
		return Redirect::to('login')->with('message','Hatalı kullanıcı adı ya da parola!');//giriş yapılamazsa login sayfasına geri yönlendir.
	}
	
	public function listPosts(){
		//Oluşan sorgu: select * from `posts` where `published` = 1 order by `created_at` desc limit 5
		$posts = Post::where('published', 1)
						->orderBy('created_at', 'DESC')
						->take(5)
						->get();
		return View::make('listposts', array('posts'=>$posts));
	}
	
	public function showPost($id=null){
		//Oluşan sorgu: select * from `posts` where `published` = 1 and `post_id` = {$id}
		$post = Post::where('published', 1)
					->where('post_id', $id)
					->first();
		
		if(!$post)
			return Redirect::to('/')->withMessage('İçerik bulunamadı.');
		
		return View::make('showpost', array('post'=>$post));
	}
	
	public function addComment($postId=null){
		$post = Post::where('published',1)->where('post_id',$postId)->first();
		if($postId && $post){
			$validator = Validator::make(Input::all(), array('comment'=>'required',
															'sender_name'=>'required',
															'sender_email'=>'required|email'),
													   array('comment.required'=>'Yorum boş bırakılamaz.',
															 'sender_name.required'=>'İsim alanı boş bırakılamaz.',
													   		 'sender_email.required'=>'E-posta alanı boş bırakılamaz.',
													   		 'sender_email.email'=>'Hatalı e-posta adresi.'));
			if($validator->fails())
				return Redirect::to("show/{$postId}")->withErrors($validator)->withInput();
			
			$comment = new Comment;
			$comment->post_id = $postId;
			$comment->sender_name = Input::get('sender_name');
			$comment->sender_email = Input::get('sender_email');
			$comment->comment = Input::get('comment');
			$comment->ip_address = $_SERVER['REMOTE_ADDR'];
			if($comment->save())
				return Redirect::to("show/{$postId}");
		}else
			return Redirect::to('/');
	}
}