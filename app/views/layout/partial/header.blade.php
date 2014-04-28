<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>{{Option::getData('site_title')}}</title>

	<!-- Bootstrap CSS -->
	<link href="{{ asset('templates/default/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
	
	@if(Cookie::get('theme') && (Cookie::get('theme') != 'default'))
	<link id="theme" href="{{ asset('templates/default/lib/bootstrap/'. Cookie::get('theme') . '.min.css') }}" rel="stylesheet">
	@else
	<link rel="stylesheet" type="text/css" href="" id="theme">
	@endif
	<!-- Normalize CSS for cross browser rendering -->
	<link href="{{ asset('templates/default/lib/bootstrap/normalize.css') }}" rel="stylesheet">

	<!-- Date Picker CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('templates/default/lib/datepicker/default.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('templates/default/lib/datepicker/default.date.css') }}">
	
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('templates/default/lib/font-awesome-4.0.3/css/font-awesome.min.css') }}">
	
	<!-- Template Stylesheets -->
	<link rel="stylesheet" type="text/css" href="{{ asset('templates/default/css/style.css') }}">

	@yield('styles')
</head>
<body>
<div class="headerStyles">
<!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      	<div class="container">
        	<div class="navbar-header">
          		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            		<span class="sr-only"><?php echo _('Toggle navigation'); ?></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
          		</button>
      			<span class="navbar-brand headerBrand">{{Option::getData('site_title')}}</span>
        	</div>

        	@include('layout.partial.menu')
      	</div>
    </div>
</div>