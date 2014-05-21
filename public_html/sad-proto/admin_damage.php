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
	            <li class="active">
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
			<div class="col-md-4 col-sm-4">
			<form action="" role="form">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Item / Category">
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

			<div class="col-md-4 col-sm-5">
				<div class="btn-group pull-right">
					<a href="/incomplete" class="btn btn-default active">All Records</a>
					<a href="/incomplete" class="btn btn-default">Pending</a>
					<a href="/approved" class="btn btn-default">Verified</a>
				</div>
			</div>
		</div>
	</div>			
</div>	

<div class="contentStyles">
	<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="col-md-1 col-sm-1">#</th>
						<th class="col-md-5 col-sm-5">ITEM</th>
						<th class="col-md-3 col-sm-3">CATEGORY</th>
						<th class="col-md-2 col-sm-2">DATE</th>
						<th class="col-md-1 col-sm-1">STATUS</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Godrej Steel Chair
						</td>
						<td>Table</td>
						<td>12/12/2013 10:00PM</td>
						<td class="text-center">
							<button class="btn btn-primary btn-sm">Verify</button>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Godrej Steel Chair
							<br>
							<span class="text-muted"><small>
								This is the muted text for the notes of the records. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, debitis alias aspernatur saepe animi eaque mollitia corrupti tempore ut quod qui neque ab repellendus. Saepe, provident ut nisi quod ea.
								</small>
							</span>
						</td>
						<td>Table</td>
						<td>12/12/2013 10:00PM</td>
						<td class="text-center">Verified</td>
					</tr>
					<tr>
						<td>3</td>
						<td>Godrej Steel Chair
							<br>
							<span class="text-muted"><small>
								This is the muted text for the notes of the records. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, debitis alias aspernatur saepe animi eaque mollitia corrupti tempore ut quod qui neque ab repellendus. Saepe, provident ut nisi quod ea.
								</small>
							</span>
						</td>
						<td>Table</td>
						<td>12/12/2013 10:00PM</td>
						<td class="text-center">Verified</td>
					</tr>
					<tr>
						<td>4</td>
						<td>Godrej Steel Chair
						</td>
						<td>Table</td>
						<td>12/12/2013 10:00PM</td>
						<td class="text-center">Verified</td>
					</tr>
					<tr>
						<td>5</td>
						<td>Godrej Steel Chair
							<br>
							<span class="text-muted"><small>
								This is the muted text for the notes of the records. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, debitis alias aspernatur saepe animi eaque mollitia corrupti tempore ut quod qui neque ab repellendus. Saepe, provident ut nisi quod ea.
								</small>
							</span>
						</td>
						<td>Table</td>
						<td>12/12/2013 10:00PM</td>
						<td class="text-center">Verified</td>
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

<?php include('footer.php'); ?>