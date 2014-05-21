<?php include('header.php') ?>
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
	        <div class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li class="active">
	            	<a href="/sad-proto/login.php" class="active">Home</a>
	            </li>
	            <li>
	            	<a href="/sad-proto/profile.php" class="">Profile</a>
	            </li>
	            <li>
	            	<a href="/sad-proto/record.php" class="">Record</a>
	            </li>
	            <li>
	            	<a href="/sad-proto/notice.php" class="">Notice</a>
	            </li>
	            <li>
	            	<a href="/sad-proto">Logout</a>
	            </li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
</div>

<div class="contentStyles mtheader">
	<div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5>Chit Form</h5>
				</div>
				<table class="table-striped table">
					<thead>
						<tr>
							<th class="col-md-1 col-sm-1">#</th>
							<th class="col-md-5 col-sm-5">ITEM</th>
							<th class="col-md-1 col-sm-1">STOCK</th>
							<th class="col-md-1 col-sm-1">AMOUNT</th>
							<th class="col-md-3 col-sm-3">NOTES</th>
							<th class="col-md-1 col-sm-1">ACTION</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>
								<small>Godrej Large Table</small>
							</td>
							<td>
								100 / <span class="text-danger">2</span>
							</td>
							<td>
								<input type="text" class="form-control input-sm" placeholder="Amount" value="1">
							</td>
							<td>
								<textarea name="" id="" cols="3" rows="2" class="form-control" disabled></textarea>
							</td>
							<td class="text-center">
								<span class="btn btn-default btn-sm">X</span>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>
								<small>Godrej Large Table</small>
							</td>
							<td>
								10029 / <span class="text-danger">112</span>
							</td>
							<td>
								<input type="text" class="form-control input-sm" placeholder="Amount" value="1">
							</td>
							<td>
								<textarea name="" id="" cols="3" rows="2" class="form-control"></textarea>
							</td>
							<td class="text-center">
								<span class="btn btn-default btn-sm">X</span>
							</td>
						</tr>
						<tr>
							<td>3</td>
							<td>
								<small>Godrej Large Chair</small>
							</td>
							<td>
								100 / <span class="text-danger">2</span>
							</td>
							<td>
								<input type="text" class="form-control input-sm" placeholder="Amount" value="1">
							</td>
							<td>
								<textarea name="" id="" cols="3" rows="2" class="form-control"></textarea>
							</td>
							<td class="text-center">
								<span class="btn btn-default btn-sm">X</span>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="panel-body">
					<hr>
					<dl class="dl-horizontal">
						<dt>Indentor</dt>
							<dd>XYZ ABC</dd>
						<dt>Designation</dt>
							<dd>Deputy Secretary</dd>
						<dt>Department</dt>
							<dd>PQRS Department</dd>
						<dt>Address</dt>
							<dd>Room 67, 1st Floor, Section D</dd>
						<dt>Contact</dt>
							<dd>9876543210</dd>
						<dt>Date</dt>
							<dd>12/01/2014</dd>
					</dl>
					<span class="btn btn-primary">Submit Indent</span>
				</div>
			</div>
	</div>
</div>

<?php include('footer.php') ?>