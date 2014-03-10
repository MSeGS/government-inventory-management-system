@extends('layout.main')

@section('content')
<div class="col-md-6 col-md-offset-3">
	<h2><i class="fa fa-lock"></i> {{_('Access Denied')}}</h2>
	<hr>
	@if(isset($route_name) && $route_name != '')
	<?php $resource = Resource::where('route','=',$route_name)->first(); ?>
	
	@if($resource)
	<p>{{_('You are trying to access "') . $resource->name . '"'}}</p>
	@else
	<p>{{_('You are trying to access route "') . $route_name . '"'}}</p>
	@endif

	@endif
	
	<p>{{_('You are not allowed to access this page. Please contact administrator.')}}</p>
</div>
@stop