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
	            <li>
	            	<a href="/sad-proto/admin.php">Home</a>	
	            </li>
	            <li>
	            	<a href="/sad-proto/admin_damage.php">Damage</a>
	            </li>
	            <li class="active">
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
			<div class="col-md-3 col-sm-3">			
				<form action="" role="form">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Username/Id">
						<span class="input-group-btn">
							<button class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
						</span>	
					</div>
				</form>
			</div>
			<div class="col-md-9 col-sm-9">
				<a href="/sad-proto/#" class="btn btn-primary pull-right">Add New User</a>
			</div>
		</div>
	</div>
</div>	

<div class="contentStyles">
	<div class="container">
		<div class="row">
			<div class="col-md-12">						
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th class="col-md-1 col-sm-1">#</th>
							<th class="col-md-2 col-sm-2">USERNAME</th>
							<th class="col-md-5 col-sm-5">DETAIL</th>
							<th class="col-md-2 col-sm-1">ROLE</th>
							<th class="col-md-2 col-sm-3">ACTION</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>remruata</td>	
							<td>
								<strong>Lalremruata Chhakchhuak</strong><br>
								<span class="text-muted">
								Jnr System Administrator <br>	
								ICT</span>
							</td>
							<td>Indentor</td>
							<td>
								<a href="" class="btn btn-default btn-sm">Edit</a>
								<a href="" class="btn btn-default btn-sm">Deactivate</a>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>JohnDapzar</td>	
							<td>
								<strong>Lalremruata Chhakchhuak</strong><br>
								<span class="text-muted">
								Jnr System Administrator <br>	
								ICT</span>
							</td>
							<td>Storekeeper</td>
							<td>
								<a href="" class="btn btn-default btn-sm">Edit</a>
								<a href="" class="btn btn-default btn-sm">Deactivate</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<?php include('footer.php') ?>
