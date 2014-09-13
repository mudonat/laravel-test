@extends('layout')
@section('content')
	@if($posts->count())
		@foreach($posts as $post)
			<div class="post fl">
			<h2><a href="{{URL::to('show', array('id'=>$post->post_id))}}">{{{$post->post_title}}}</a></h2>
			<p>{{{mb_substr($post->post_content,0,400)}}}</p>
			<p><em><small>{{{date('d-m-Y', strtotime($post->created_at))}}} tarihinde {{{$post->user->username}}} tarafından yazılmıştır.</small></em></p>
			</div>
		@endforeach
	@endif
@stop