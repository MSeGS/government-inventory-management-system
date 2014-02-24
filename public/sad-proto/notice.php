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
	            <li>
	            	<a href="record.php" class="">Record</a>
	            </li>
	            <li class="active">
	            	<a href="notice.php" class="active">Notice</a>
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
								<th class="col-md-1 col-sm-1">#</th>
								<th class="col-md-8 col-sm-8">MESSAGE</th>
								<th class="col-md-3 col-sm-3">DATE</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									1
								</td>
								<td>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime officiis ab porro quasi iure iste! Suscipit, sequi quae mollitia blanditiis quisquam. Laborum optio aspernatur culpa nobis ipsam quae molestias corporis.
								</td>
								<td>
									12/12/2014 10:30AM
								</td>
							</tr>
								
							<tr>
								<td>
									2
								</td>
								<td>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime officiis ab porro quasi iure iste! Suscipit, sequi quae mollitia blanditiis quisquam. Laborum optio aspernatur culpa nobis ipsam quae molestias corporis.
								</td>
								<td>
									10/12/2014 03:00PM
								</td>
							</tr>
							
							<tr>
								<td>
									3
								</td>
								<td>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime officiis ab porro quasi iure iste! Suscipit, sequi quae mollitia blanditiis quisquam. Laborum optio aspernatur culpa nobis ipsam quae molestias corporis.
								</td>
								<td>
									11/10/2014 10:00AM
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