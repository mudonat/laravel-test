@extends('layout')
@section('page-title',$post->post_id ? ('Düzenle: ' . $post->post_title) : 'İçerik ekle')
@section('content')
{{Form::model($post)}}<!-- Form açılışı -->
<!-- Giriş hata mesajları -->
@if($errors->any())
	<ul>
	@foreach($errors->all('<li>:message</li>') as $error)
		{{$error}}
	@endforeach
	</ul>
@endif
<p><!-- giriş etiketleri -->
{{Form::label('post_title', 'Başlık')}}
{{Form::text('post_title', Input::old('post_title'), array('placeholder'=>'İçerik başlığı'))}}
</p>
<p>{{Form::label('post_content', 'İçerik')}}</p>
<p>{{Form::textarea('post_content', Input::old('post_content'), array('placeholder'=>'İçerik'))}}</p>
<p>
{{Form::label('published', 'Yayın durumu')}}
{{Form::checkbox('published', '1', Input::old('published') ? true : false)}}
</p>
<p>{{Form::submit('Kaydet')}}</p>
{{Form::close()}}<!-- Form kapanış -->
@stop