@extends('layout.main')
@section('content')
<div class="row">
	<div class="col-md-12 ">
		<h1><?php echo _("User Report"); ?></h1>
	</div>
</div>
<div class="row">
	<ul class="nav nav-tabs">
		<li class="active"><a href="{{route('report.user')}}">Tabular Report</a></li>
		<!-- <li><a href="{{route('report.user-graphic')}}">Graphical Report</a></li> -->
		<li><a href="{{route('report.user-detail')}}">Detail Report</a></li>
	</ul>
	<div class="mb20"></div>
	<div class="col-md-9">
		<h3 class="lead"><?php echo _('Users Procurement/Indent Overview'); ?></h3> <!-- hman tur zawk ka hre mai lo -->
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-4"><?php echo _("Name") ?></th>
					<th class="col-md-2"><?php echo _("Indent") ?></th>
					<th class="col-md-2"><?php echo _("Requirement") ?></th>
					<th class="col-md-2"><?php echo _("Damages") ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; ?>
				@foreach($indentors as $indentor)
				<tr>
					<td>{{++$i}}</td>
					<td><a href="{{route('report.user-detail',array('id'=>$indentor->id))}}" >{{$indentor->full_name}}</td>
					<td>{{sizeof($indentor->indents)}}</td>
					<td><?php
					$requirements = 0;
					$damages = 0;
					foreach ($indentor->indents as $indent) {
						$requirements += sizeof($indent->requirements);
					}
					echo $requirements;
					?></td>
					<td>
					<?php echo $indentor->damages->count();

					 ?>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-md-3">
		<h3 class="lead"><?php echo _('Group Overview'); ?></h3> 
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Group</th>
					<th>Members</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td><?php echo _('Administrator'); ?></td>
					<td>{{$userGroups->adminsCount}}</td>
				</tr>
				<tr>
					<td>2</td>
					<td><?php echo _('Storekeepers'); ?></td>
					<td>{{$userGroups->storeKeepersCount}}</td>
				</tr>
				<tr>
					<td>3</td>
					<td><?php echo _('Indentor'); ?></td>
					<td>{{$userGroups->indentorsCount}}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@stop
