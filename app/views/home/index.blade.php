@extends('layout.main')

@section('contentTop')
<div class="container">
	<div class="row">
		<div class="col-md-2 col-sm-4">
			<select name="" id="" class="easydropdown">
				<option value="" class="label" value="">Show Items</option>
				<option value="10">10</option>
				<option value="10">20</option>
				<option value="10">30</option>
				<option value="10">40</option>
				<option value="10">50</option>
			</select>
		</div>

		<div class="col-md-2 col-sm-4">
			<select class="easydropdown">
				<option value="" class="label" value="">Category</option>
				<option value="10">Hardware</option>
				<option value="10">Stationery</option>
				<option value="10">Construction</option>
			</select>
		</div>

		<div class="col-md-3 col-sm-4">
		<form action="" role="form">
			<div class="input-group">
		      <input type="text" class="form-control" placeholder="Search Item">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button"> <i class="glyphicon glyphicon-search"></i> </button>
		      </span>
		    </div><!-- /input-group -->
		</form>
		</div>

	</div>
</div>
@stop

@section('content')
<div class="col-md-7">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-md-7 col-sm-7">NAME</th>
				<th class="col-md-2 col-sm-2">STOCK</th>
				<th class="col-md-2 col-sm-2">AMOUNT</th>
				<th class="col-md-1 col-sm-1"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					100 / <span class="text-danger">2</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					100 / <span class="text-danger">2</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					100 / <span class="text-danger">2</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					100 / <span class="text-danger">2</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					100 / <span class="text-danger">2</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					100 / <span class="text-danger">2</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					100 / <span class="text-danger">2</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					100 / <span class="text-danger">2</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					100 / <span class="text-danger">2</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					100 / <span class="text-danger">2</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					100 / <span class="text-danger">2</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>Godrej Table Large</small>
				</td>
				<td>
					0 / <span class="text-danger">0</span>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td>
					<span class="btn btn-default btn-sm">Add</span>
				</td>
			</tr>
		</tbody>
	</table>
	<ul class="pagination">
	  <li class="disabled"><a href="#">&laquo;</a></li>
	  <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
	  <li><a href="#">2</a></li>
	  <li><a href="#">3</a></li>
	  <li><a href="#">4</a></li>
	  <li><a href="#">5</a></li>
	  <li><a href="#">&raquo;</a></li>
	</ul>
</div>
<div class="col-md-5">
<div class="panel panel-default">
	<div class="panel-heading">
		<h5 class="text-center">CHIT FORM</h5>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="col-md-1">#</th>
				<th class="col-md-7">NAME</th>
				<th class="col-md-2">AMT</th>
				<th class="col-md-2 text-center">ACTION</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<small>1</small>
				</td>
				<td>
					<small>Departmental Table Big Departmental Table Big Departmental Table Big</small>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td class="text-right"> 
					<span class="btn btn-default btn-sm">X</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>2</small>
				</td>
				<td>
					<small>Godrej Table and Chair</small>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td class="text-right">
					<span class="btn btn-default btn-sm">X</span>
				</td>
			</tr>
			<tr>
				<td>
					<small>3</small>
				</td>
				<td>
					<small>Godrej Table and Chair</small>
				</td>
				<td>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control">
					</div>
				</td>
				<td class="text-right">
					<span class="btn btn-default btn-sm">X</span>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="panel-body">
		<hr>
		<a href="/sad-proto/chit.php" class="btn btn-primary pull-right">Proceed</a>
	</div>
</div>
</div>
@stop