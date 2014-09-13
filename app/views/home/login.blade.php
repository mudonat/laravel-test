<!Doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; Charset=utf-8" />
		<title>Kullanıcı Giriş</title>
	</head>
	<body>
		{{Form::open(array('url'=>'login'))}}<!-- Form açılışı -->
			<h1>Yönetici Girişi</h1>
			<!-- Giriş hata mesajları -->
			@if($errors->any())
				<ul>
				@foreach($errors->all('<li>:message</li>') as $error)
					{{$error}}
				@endforeach
				</ul>
			@endif
			<!-- Sistem mesajı -->
			@if(Session::has('message'))
				<p>{{Session::get('message')}}</p>
			@endif
			<p><!-- giriş etiketleri -->
			{{Form::label('username', 'Kullanıcı adı')}}
			{{Form::text('username', Input::old('username'), array('placeholder'=>'Kullanıcı adı'))}}
			</p>
			<p>
			{{Form::label('password', 'Parola')}}
			{{Form::password('password')}}
			</p>
			<p>
			{{Form::submit('Giriş')}}
			</p>
		{{Form::close()}}<!-- Form kapanış -->
	</body>
</html>