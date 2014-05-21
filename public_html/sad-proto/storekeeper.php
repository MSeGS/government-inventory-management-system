<?php include ('header.php') ?>

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
	            	<a href="storekeeper.php">Home</a>	
	            </li>
	            <li>
	            	<a href="storekeeper_entry.php">Entry</a>
	            </li>
	            <li>
	            	<a href="storekeeper_damage.php">Damage</a> 
	            </li>
	            <li>
	            	<a href="storekeeper_profile.php">Profile</a>
	            </li>
	            <li>
	            	<a href="/sad-proto">Logout</a>
	            </li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
</div>

<div class="searchStyles">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-3">
			<form action="" role="form">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="ID / Indentor">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
					</span>
				</div>
			</form>	
			</div>

			<div class="col-md-4 col-sm-3">
				<div class="form-group">
					<input type="text" class="datepicker form-control" placeholder="Click to Select Date">
				</div>
			</div>

			<div class="col-md-4 col-sm-6">
				<div class="btn-group pull-right">
					<a href="/all" class="btn btn-default active">All</a>
					<a href="/completed" class="btn btn-default">Completed</a>
					<a href="/incomplete" class="btn btn-default">Incomplete</a>
					<a href="/approved" class="btn btn-default">Approved</a>
				</div>
			</div>
		</div>
	</div>			
</div>		

<div class="contentStyles">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="col-md-1 col-sm-1">#</th>
							<th class="col-md-3 col-sm-3">INDENTOR</th>
							<th class="col-md-5 col-sm-5">DESIGNATION</th>
							<th class="col-md-2 col-sm-2">DATE</th>
							<th class="col-md-1 col-sm-1">STATUS</th>	
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								1
							</td>
							<td>
								Lalremruata
							</td>
							<td>
								Jr. System Administrator
							</td>	
							<td>
								12/12/2014 10:00AM
							</td>
							<td>
								APPROVE
							</td>
						</tr>
						<tr>
							<td>
								2
							</td>
							<td>
								Lalrelfela
							</td>
							<td>
								Jr. Network Engineer 
							</td>
							<td>
								12/10/2014 03:00PM
							</td>
							<td>
								INCOMPLETE
							</td>
						</tr>
						<tr>
							<td>
								3
							</td>
							<td>
								Lalhuapliana
							</td>
							<td>
								Jr. Network Engineer
							</td>
							<td>
								10/10/2014 11:00PM
							</td>
							<td>
								COMPLETED
							</td>
						</tr>
						<tr>
							<td>
								3
							</td>
							<td>
								Lalhuapliana
							</td>
							<td>
								Jr. Network Engineer
							</td>
							<td>
								10/10/2014 11:00PM
							</td>
							<td>
								COMPLETED
							</td>
						</tr>
						<tr>
							<td>
								3
							</td>
							<td>
								Lalhuapliana
							</td>
							<td>
								Jr. Network Engineer
							</td>
							<td>
								10/10/2014 11:00PM
							</td>
							<td>
								COMPLETED
							</td>
						</tr>
						<tr>
							<td>
								3
							</td>
							<td>
								Lalhuapliana
							</td>
							<td>
								Jr. Network Engineer
							</td>
							<td>
								10/10/2014 11:00PM
							</td>
							<td>
								COMPLETED
							</td>
						</tr>
						<tr>
							<td>
								3
							</td>
							<td>
								Lalhuapliana
							</td>
							<td>
								Jr. Network Engineer
							</td>
							<td>
								10/10/2014 11:00PM
							</td>
							<td>
								COMPLETED
							</td>
						</tr>
						<tr>
							<td>
								3
							</td>
							<td>
								Lalhuapliana
							</td>
							<td>
								Jr. Network Engineer
							</td>
							<td>
								10/10/2014 11:00PM
							</td>
							<td>
								COMPLETED
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
		</div>
	</div>
</div>

<?php include ('footer.php') ?>
