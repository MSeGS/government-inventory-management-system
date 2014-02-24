<?php include('header.php'); ?>

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
	            	<a href="/sad-proto/admin.php">Home</a>	
	            </li>
	            <li>
	            	<a href="/sad-proto/admin_damage.php">Damage</a>
	            </li>
	            <li>
	            	<a href="/sad-proto/admin_users.php">Users</a>
	            </li>
	            <li>
	            	<a href="/sad-proto/admin_profile.php">Profile</a>
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
			<div class="col-md-4 col-sm-2">
			<form action="" role="form">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="ID / Indentor">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
					</span>
				</div>
			</form>	
			</div>

			<div class="col-md-3 col-sm-2">
				<div class="form-group">
					<input type="text" class="datepicker form-control" placeholder="Click to Select Date">
				</div>
			</div>

			<div class="col-md-5 col-sm-8">
				<div class="btn-group pull-right">
					<a href="/all" class="btn btn-default active">All</a>
					<a href="/completed" class="btn btn-default">Submitted</a>
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
				<table class="table table-striped table-bordered table-rowlink table-hover">
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
						<tr class="link" href="#">
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
								12/10/2014 03:00PM
							</td>
							<td>
								Completed
							</td>
						</tr>
						<tr class="link" href="#">
							<td>
								2
							</td>
							<td>
								Alan
							</td>
							<td>
								System Administrator
							</td>
							<td>
								11/10/2014 10:00AM
							</td>
							<td>
								Incomplete
							</td>
						</tr>
						<tr class="link" href="#">
							<td>
								3
							</td>
							<td>
								John Dapzar
							</td>
							<td>
								Jr. System Integrator 
							</td>
							<td>
								10/10/2014 12:00AM
							</td>
							<td>
								Approved
							</td>
						</tr>
						<tr class="link" href="#">
							<td>
								4
							</td>
							<td>
								John Dapzar
							</td>
							<td>
								Jr. System Integrator 
							</td>
							<td>
								10/10/2014 12:00AM
							</td>
							<td>
								Approved
							</td>
						</tr>
						<tr class="link" href="#">
							<td>
								5
							</td>
							<td>
								John Dapzar
							</td>
							<td>
								Jr. System Integrator 
							</td>
							<td>
								10/10/2014 12:00AM
							</td>
							<td>
								Approved
							</td>
						</tr>
						<tr class="link" href="#">
							<td>
								6
							</td>
							<td>
								John Dapzar
							</td>
							<td>
								Jr. System Integrator 
							</td>
							<td>
								10/10/2014 12:00AM
							</td>
							<td>
								Approved
							</td>
						</tr>
						<tr class="link" href="#">
							<td>
								7
							</td>
							<td>
								John Dapzar
							</td>
							<td>
								Jr. System Integrator 
							</td>
							<td>
								10/10/2014 12:00AM
							</td>
							<td>
								Approved
							</td>
						</tr>
						<tr class="link" href="#">
							<td>
								8
							</td>
							<td>
								John Dapzar
							</td>
							<td>
								Jr. System Integrator 
							</td>
							<td>
								10/10/2014 12:00AM
							</td>
							<td>
								Approved
							</td>
						</tr>
						<tr class="link" href="#">
							<td>
								9
							</td>
							<td>
								John Dapzar
							</td>
							<td>
								Jr. System Integrator 
							</td>
							<td>
								10/10/2014 12:00AM
							</td>
							<td>
								Approved
							</td>
						</tr>
						<tr class="link" href="#">
							<td>
								10
							</td>
							<td>
								John Dapzar
							</td>
							<td>
								Jr. System Integrator 
							</td>
							<td>
								10/10/2014 12:00AM
							</td>
							<td>
								Approved
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
</div>
<?php include('footer.php'); ?>