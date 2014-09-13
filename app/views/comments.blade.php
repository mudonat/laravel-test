@if($post->comments()->count()>0)
	<h3>Yorumlar</h3>
	<ul>
		@foreach($post->comments()->get() as $comment)
		<li>
			<p><strong>{{$comment->sender_name}}</strong></p>
			<p>{{$comment->comment}}</p>
		</li>
		@endforeach
	</ul>
@endif

{{Form::open(array('route'=>array('add-comment', $post->post_id), 'id'=>'form_comment'))}}
@if($errors->any())
	<ul>
	@foreach($errors->all('<li>:message</li>') as $error)
		{{$error}}
	@endforeach
	</ul>
@endif
<p>{{Form::text('sender_name', Input::old('sender_name'), array('placeholder'=>'İsim'))}}</p>
<p>{{Form::text('sender_email', Input::old('sender_email'), array('placeholder'=>'E-posta adresi'))}}</p>
<p>{{Form::textarea('comment', Input::old('comment'), array('placeholder'=>'Yorumunuzu buraya yazın.'))}}</p>
<p>{{Form::submit('Gönder')}}<p>
{{Form::close()}}