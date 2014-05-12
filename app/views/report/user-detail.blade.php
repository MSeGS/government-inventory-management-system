@extends('layout.main')
@section('content')
<div class="row">
	<div class="col-md-12 ">
		<h1><?php echo _("User Report"); ?></h1>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
			<li ><a href="{{route('report.user')}}">Tabular Report</a>	</li>
			<li ><a href="{{route('report.user-graphic')}}">Graphical Report</a></li>
			<li class="active"><a href="{{route('report.user-detail')}}">Detail Report</a></li>
		</ul>
		<div class="mb20"></div>
		<div class="lead mb20">
			<?php 
			if($indentors && count($indentors))
				echo _('Users Procurement/Indent Overview <small>for</small>'); 
			else
				echo _('Select User');

			?>
			<div class="btn-group user" data-uid="{{$user?$user->id:''}}">
				<button type="button" class="btn btn-default chart-button btn-sm">{{($user?$user->full_name:'Select User')}}</button>
				<button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown">
					<span class="caret"></span>
					<span class="sr-only">Click to select User</span>
				</button>
				<ul class="dropdown-menu" id="year_selector" role="menu">
					@foreach($indentors as $key=>$indentor)
					<li ><a data-uid="{{$key}}" href="javascript:;" >{{$indentor}}</a></li>
					@endforeach
				</ul>
			</div>

			<?php echo _(' for the year '); ?>
			<div class="btn-group year" data-year="{{$year?$year:''}}">
				<button type="button" class="btn btn-default chart-button btn-sm">{{($year?$year:'All')}}</button>
				<button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown">
					<span class="caret"></span>
					<span class="sr-only">Click to select year</span>
				</button>
				<ul class="dropdown-menu" id="year_selector" role="menu">
					@foreach($years as $year)
					<li ><a data-year="{{$year}}" href="javascript:;">{{$year}}</a></li>
					@endforeach
				</ul>
			</div>

			<a href="javascript:;" class="btn btn-small btn-default filter btn-sm"><i class="fa fa-arrow-circle-right"></i> GO</a>

		</div> 
	</div>
</div>
<div class="row">
	
	@if($user)
	<div class="col-md-12 mb20" >
		<div class="panel panel-defautl">
			<div class="panel-heading"></div>
			<div class="panel-contents">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="col-md-1">#</th>
							<th>Date</th>
							<th>Item</th>
							<th class="col-md-1">Indented</th>
							<th class="col-md-1">Supplied</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						
						$i=1;
						$j=1; 
						
						?>
						@if($indents->count())
							@foreach($indents as $indent)
								<tr>
									<td>{{$i}}</td>
									<td colspan="4">{{$indent->indent_date}}</td>
								</tr>
								@foreach($indent->items as $item)
								<tr class="{{$i%2==1?'active':''}}">
									<td style="padding-left:20px">{{$j++.')'}}</td>
									<td> - </td>
									<td>{{$item->product->name}}</td>
									<td>{{$item->quantity}}</td>
									<td>{{$item->supplied}}</td>
								</tr>
								@endforeach
								<tr><td colspan="5"></td></tr>
								<?php $i++;$j=1	; ?>
							@endforeach
						@else
							<tr class="warning">
								<td colspan="5" class="text-center">No Indents Found !!</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
	@endif
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(function(){
		$('.user li a').click(function(){
			$('.user').data('uid', $(this).data('uid'));
			console.log($(this));
			$('.user').find('.chart-button').text($(this).text());
		})
		$('.year li a').click(function(){
			$('.year').data('year', $(this).data('year'));
			$('.year').find('.chart-button').text($(this).text());
		})
		$('.filter').click(function(){
			if($(this).parent().find('.user').data('uid').length == 0)
				alert('Please select a user');
			else
				document.location = '/report/user-detail/'+$(this).parent().find('.user').data('uid')+'/'+$(this).parent().find('.year').data('year');
		});
	})

</script>
@stop