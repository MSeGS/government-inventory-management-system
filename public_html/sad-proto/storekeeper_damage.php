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
	            <li>
	            	<a href="storekeeper.php">Home</a>	
	            </li>
	            <li>
	            	<a href="storekeeper_entry.php">Entry</a>
	            </li>
	            <li class="active">
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

<div class="contentStyles mtheader">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Item">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
							</span>
						</div>
					</div>
					<div class="col-md-8 col-sm-6">
						<a href="/sad-proto/storekeeper_reportdamage.php" class="btn btn-primary pull-right">Report Damage</a>
					</div>
				</div>

				<table class="table-bordered table table-striped mt18 table-hover">
					<thead>
						<tr>
							<th class="col-md-1 col-sm-1">#</th>
							<th class="col-md-7 col-sm-6">ITEM</th>
							<th class="col-md-1 col-sm-1">QTY</th>
							<th class="col-md-2 col-sm-2">DATE</th>
							<th class="col-md-1 col-sm-2">STATUS</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Pencil <br>
								<span class="text-muted"><small>If there is any notes, it will be displayed under the item name.</small></span>
							</td>
							<td>4</td>
							<td>20/12/2013 03:00PM</td>
							<td>
								<a href="#" class="btn btn-default btn-sm">Edit</a>
								<a href="#" class="btn btn-default btn-sm">X</a>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Table</td>
							<td>1</td>
							<td>12/12/2013 01:00PM</td>
							<td>Verified</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Table</td>
							<td>1</td>
							<td>12/12/2013 01:00PM</td>
							<td>Verified</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Table</td>
							<td>1</td>
							<td>12/12/2013 01:00PM</td>
							<td>Verified</td>
						</tr>
						<tr>
							<td>5</td>
							<td>Table</td>
							<td>1</td>
							<td>12/12/2013 01:00PM</td>
							<td>Verified</td>
						</tr>
						<tr>
							<td>6</td>
							<td>Table</td>
							<td>1</td>
							<td>12/12/2013 01:00PM</td>
							<td>Verified</td>
						</tr>
						<tr>
							<td>7</td>
							<td>Table</td>
							<td>1</td>
							<td>12/12/2013 01:00PM</td>
							<td>Verified</td>
						</tr>
						<tr>
							<td>8</td>
							<td>Table</td>
							<td>1</td>
							<td>12/12/2013 01:00PM</td>
							<td>Verified</td>
						</tr>
						<tr>
							<td>9</td>
							<td>Table</td>
							<td>1</td>
							<td>12/12/2013 01:00PM</td>
							<td>Verified</td>
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