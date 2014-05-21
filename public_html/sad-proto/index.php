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
	          <form class="navbar-form navbar-right" role="form">
	              <div class="form-group">
	                <input type="text" placeholder="Username" class="form-control input-sm">
	              </div>
	              <div class="form-group ml10">
	                <input type="password" placeholder="Password" class="form-control input-sm">
	              </div>
	              <button type="submit" class="btn btn-custom btn-sm ml10">Sign in</button>
	              <a href="#" class="text-default ml10">Help?</a>
	            </form>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
</div>

<div class="searchStyles">
	<div class="container">
		<div class="row">

			<div class="col-md-2 col-sm-4">
				<select name="" id="" class="dropdown">
					<option value="" class="label" value="">Show Items</option>
					<option value="10">10</option>
					<option value="10">20</option>
					<option value="10">30</option>
					<option value="10">40</option>
					<option value="10">50</option>
				</select>
			</div>

			<div class="col-md-2 col-sm-4">
				<select class="dropdown">
					<option value="" class="label" value="">Category</option>
					<option value="10">Hardware</option>
					<option value="10">Stationery</option>
					<option value="10">Construction</option>
				</select>
			</div>

			<div class="col-md-3 col-sm-4">
			<form action="" role="form">
				<div class="input-group">
			      <input type="text" class="form-control" placeholder="Search Item">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button"> <i class="glyphicon glyphicon-search"></i> </button>
			      </span>
			    </div><!-- /input-group -->
			</form>
			</div>

		</div>
	</div>
</div>

<div class="contentStyles">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-md-9 col-sm-9">ITEM</th>
								<th class="col-md-3 col-sm-3">STOCK / RESERVE</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									100 / <span class="text-danger">2</span>
								</td>
								
							</tr>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									100 / <span class="text-danger">2</span>
								</td>
								
							</tr>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									100 / <span class="text-danger">2</span>
								</td>
								
							</tr>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									100 / <span class="text-danger">2</span>
								</td>
								
							</tr>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									100 / <span class="text-danger">2</span>
								</td>
								
							</tr>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									100 / <span class="text-danger">2</span>
								</td>
								
							</tr>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									100 / <span class="text-danger">2</span>
								</td>
								
							</tr>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									100 / <span class="text-danger">2</span>
								</td>
								
							</tr>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									100 / <span class="text-danger">2</span>
								</td>
								
							</tr>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									100 / <span class="text-danger">2</span>
								</td>
								
							</tr>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									100 / <span class="text-danger">2</span>
								</td>
								
							</tr>
							<tr>
								<td>
									Godrej Table Large
								</td>
								<td>
									0 / <span class="text-danger">0</span>
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
			<!-- <div class="col-md-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5>CHIT FORM</h5>
					</div>
					<div class="panel-body">
						<div class="text-center">Please login to indent items</div>
					</div>	
				</div>
			</div> -->
		</div>
	</div>
</div>


<?php include('footer.php') ?>