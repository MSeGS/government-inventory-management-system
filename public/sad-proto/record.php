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
	            <li class="">
	            	<a href="login.php" class="active">Home</a>
	            </li>
	            <li>
	            	<a href="profile.php" class="">Profile</a>
	            </li>
	            <li class="active">
	            	<a href="record.php" class="active">Record</a>
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
			<div class="col-md-12">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-md-1">#</th>
								<th class="col-md-4">DATE</th>
								<th class="col-md-4">STATUS</th>
								<th class="col-md-3">ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									1
								</td>
								<td>
									12/12/2014 10:00AM
								</td>
								<td>
									Submitted
								</td>
								<td>
									<div>
									<span class="btn btn-default btn-sm"><strong>Edit</strong></span>
									<span class="btn btn-default btn-sm"><strong>Delete</strong></span>
									</div>
									
								</td>
							</tr>
								
							<tr>
								<td>
									2
								</td>
								<td>
									11/10/2014 11:00AM
								</td>
								<td>
									Completed
								</td>
								<td>
									<div>
									<span class="btn btn-default btn-sm"><strong>View</strong></span>
									</div>
								</td>
							</tr>
														<tr>
								<td>
									3
								</td>
								<td>
									10/10/2014 11:10AM
								</td>
								<td>
									Incomplete
								</td>
								<td>
									<div>
									<span class="btn btn-default btn-sm"><strong>View</strong></span>
									</div>
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
 
<?php include('footer.php') ?>