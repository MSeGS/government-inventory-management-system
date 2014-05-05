@extends('layout.main')
@section('content')
<div class="row">
	<div class="col-md-9">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-md-1">#</th>
						<th class="col-md-4"><?php echo _("Name") ?></th>
						<th class="col-md-2"><?php echo _("Indent") ?></th>
						<th class="col-md-2"><?php echo _("Requirement") ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; ?>
					@foreach($reports as $report)
					<tr>
						<td>{{++$i}}</td>
						<td>{{$report->full_name}}</td>
						<td>{{sizeof($report->indents)}}</td>
						<td><?php
						$requirements = 0;
						foreach ($report->indents as $indent) {
							$requirements += sizeof($indent->requirements);
						}
						echo $requirements;
						?></td>
					</tr>
					@endforeach
				</tbody>
			</table>
	</div>
</div>
@stop
