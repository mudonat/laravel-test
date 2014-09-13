<!Doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; Charset=utf-8" />
		<title>@yield('page-title', 'Laravel Blog Denemesi')</title>
	</head>
	<body>
		<h1><a href="{{URL::to('/')}}">Laravel Blog Denemesi</a></h1>
		@include('navigation')
		<!-- Sistem mesajı -->
		@if(Session::has('message'))
			<p>{{Session::get('message')}}</p>
		@endif
		<div id="content">
			@yield('content')
		</div>
	</body>
</html>