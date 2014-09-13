@if(Auth::check())
	<ul>
		<li{{Request::is('admin/posts') ? ' class="active"' : ''}}><a href="{{{URL::to('admin/posts')}}}">İçerikler</a></li>
		<li{{Request::is('admin/posts/create') ? ' class="active"' : ''}}><a href="{{{URL::to('admin/posts/create')}}}">İçerik ekle</a></li>
		<li><a href="{{{URL::to('logout')}}}">Çıkış</a></li>
	</ul>
@endif