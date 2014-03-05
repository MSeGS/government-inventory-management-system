@include('layout.partial.header')

<div class="searchStyles">
	<div class="container">
		<div class="row">
			@yield('contentTop')
		</div>
	</div>
</div>

<div class="contentStyles">
	<div class="container">
		<div class="row">
			@yield('content')
		</div>
	</div>
</div>

@include('layout.partial.footer')