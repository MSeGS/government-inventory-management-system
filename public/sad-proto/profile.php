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
	            <li>
	            	<a href="login.php">Home</a>
	            </li>
	            <li class="active">
	            	<a href="profile.php" class="active">Profile</a>
	            </li>
	            <li>
	            	<a href="record.php" class="">Record</a>
	            </li>
	            <li>
	            	<a href="notice.php" class="">Notice</a>
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
			<div class="col-md-7">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5>Personal Detail</h5>
					</div>
					<div class="panel-body">
						<form action="" class="form-horizontal">
							<div class="form-group">
								<label for="fullname" class="col-sm-2 control-label">Fullname</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="fullname" placeholder="Firstname, Lastname">
							    </div>
							</div>
							<div class="form-group">
								<label for="designation" class="col-sm-2 control-label">Designation</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="designation" placeholder="Full name of post">
							    </div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">Email</label>
							    <div class="col-sm-10">
							      <input type="email" class="form-control" id="email" placeholder="Email">
							    </div>
							</div>
							<div class="form-group">
								<label for="address" class="col-sm-2 control-label">Address</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="address" placeholder="Room no, Floor, Building">
							    </div>
							</div>
							<div class="form-group">
								<label for="contactno" class="col-sm-2 control-label">Contact No</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="contactno" placeholder="Landline / Mobile">
							    </div>
							</div>
							<div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" class="btn btn-primary">Update</button>
							    </div>
							  </div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5>Change Password</h5>
					</div>
					<div class="panel-body">
						<form action="" class="form-horizontal">
							<div class="form-group">
								<label for="password" class="col-sm-4 control-label">New Password</label>
							    <div class="col-sm-8">
							      <input type="password" class="form-control" id="password">
							    </div>
							</div>
							<div class="form-group">
								<label for="retypepassword" class="col-sm-4 control-label">Retype Password</label>
							    <div class="col-sm-8">
							      <input type="password" class="form-control" id="retypepassword">
							    </div>
							</div>
							<div class="form-group">
							    <div class="col-sm-offset-4 col-sm-8">
							      <button type="submit" class="btn btn-primary">Update</button>
							    </div>
							  </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('footer.php') ?>