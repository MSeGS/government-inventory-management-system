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
	            	<a href="/sad-proto/storekeeper.php">Home</a>	
	            </li>
	            <li>
	            	<a href="/sad-proto/storekeeper_entry.php">Entry</a>
	            </li>
	            <li class="active">
	            	<a href="/sad-proto/storekeeper_damage.php">Damage</a> 
	            </li>
	            <li>
	            	<a href="/sad-proto/storekeeper_profile.php">Profile</a>
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
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Damage Report Form</h4>
					</div>
					<div class="panel-body">
					
					<div class="form-group">
						<select class="dropdown">
							<option value="" class="label" value="">Category</option>
							<option value="10">Hardware</option>
							<option value="10">Stationery</option>
							<option value="10">Construction</option>
						</select>
					</div>
					<div class="form-group">
						<select class="dropdown">
							<option value="" class="label" value="">Item</option>
							<option value="10">Pencil</option>
							<option value="10">Table</option>
							<option value="10">Paper</option>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="datepicker form-control">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Quantity">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<textarea name="" rows="3" class="form-control" placeholder="Notes (Optional)"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>


<?php include ('footer.php') ?>	