@extends('layout.main')

@section('content')
<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="text-center">New Product</h5>
		</div>
		<div class="panel-body">
			{{Form::open(array('url'=>route('product.index'), 'method'=>'post', 'class'=>'form-vertical'))}}				
				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}
				</div>
				@endif
				<div class="form-group">
					{{Form::label('category', 'Category',array('control-label'))}}
					{{Form::select('category', $categories, Input::old('category'), array('class'=>'dropdown form-control input-sm'))}}
					@if($errors->has('category'))
					<p class="help-block"><span class="text-danger">{{$errors->first('category')}}</span></p>
					@endif
				</div>
				<div class="form-group">
					{{Form::label('product_name', 'Product Name',array('control-label'))}}
					{{Form::text('name', '', array('class'=>'form-control input-sm'))}}
					@if($errors->has('name'))
					<p class="help-block"><span class="text-danger">{{$errors->first('name')}}</span></p>
					@endif
				</div>
				<div class="form-group">
					{{Form::label('description', 'Description (Optional)',array('control-label'))}}
					{{Form::text('description', '', array('class'=>'form-control input-sm'))}}
				</div>
				<div class="form-group">
					{{Form::label('reserved_amount', 'Reserved Amount',array('control-label'))}}
					{{Form::text('reserved_amount', '', array('class'=>'form-control input-sm'))}}
				</div>
				@if($errors->has('reserved_amount'))
				<p class="help-block"><span class="text-danger">{{$errors->first('reserved_amount')}}</span></p>
				@endif
				<div class="form-group text-right">
					{{Form::submit('Submit', array("class"=>"btn btn-primary btn-sm"))}}
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop