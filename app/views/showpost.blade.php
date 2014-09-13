@extends('layout')
@section('page-title', $post->post_title)
@section('content')
	<h2>{{{$post->post_title}}}</h2>
	<p>{{{$post->post_content}}}</p>
	<em><small>{{date('d-m-Y', strtotime($post->created_at))}} tarihinde {{{$post->user->username}}} tarafından yazılmıştır.</small></em>
	
	@include('comments')
@stop