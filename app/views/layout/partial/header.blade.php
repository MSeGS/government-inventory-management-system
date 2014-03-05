<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Indent Requisition System</title>

	<!-- Bootstrap CSS -->
	<link href="{{ asset('templates/default/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">

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
            		<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
          		</button>
      			<span class="navbar-brand headerBrand">Indent Requisition System</span>
        	</div>

        	@include('layout.partial.menu')
      	</div>
    </div>
</div>