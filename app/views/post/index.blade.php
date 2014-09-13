@extends('layout')
@section('page-title','İçerikler')
@section('content')
	<table width=100%>
		<thead>
			<tr>
				<th align="left">#Id</th>
				<th align="left">Başlık</th>
				<th align="left">Yazar</th>
				<th>Olaylar</th>
			</tr>
		</thead>
		<tbody>
			@if($posts->count()>0)
				@foreach($posts as $post)
				<tr>
					<td>{{$post->post_id}}</td>
					<td>{{{$post->post_title}}}</td>
					<td>{{{$post->user->username}}}</td>
					<td align="center">
						<a href="{{URL::to('admin/posts/edit', array($post->post_id))}}">Düzenle</a>
						<a onclick="return confirm('Silmek istediğinize emin misiniz') ? true : false" href="{{URL::to('admin/posts/delete', array('id'=>$post->post_id))}}">Sil</a>
					</td>
				</tr>
				@endforeach
			@else
				<tr>
					<td align="center" colspan="4">Kayıtlı içerik bulunamadı.</td>
				</tr>
			@endif
		</tbody>
	</table>
@stop