<?php
	 include ('header.php');
	?>
  
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  
  
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Distributors</li>
		<div class="advance-tbtn" id="adv-s">Advance search</div>
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
	   
			<div class="row adv-s" id="show-search-box" style="display:none;">
				<div class="col-md-2 pd-3">
					<input type="text" class="form-control" placeholder="Name">
			   </div>
			   <div class="col-md-2 pd-3">
					<select class="form-control">
						<option>Manager</option>
						<option>Manager 1</option>
						<option>Manager 2</option>
					</select>
			   </div>
			   <div class="col-md-2 pd-3">
					<select class="form-control">
						<option>ASM</option>
						<option>ASM 1</option>
						<option>ASM 2</option>
					</select>
			   </div>
			   <div class="col-md-2 pd-3">
					<select class="form-control">
						<option>TSM</option>
						<option>TSM 1</option>
						<option>TSM 2</option>
					</select>
			   </div>
			   <div class="col-md-2">
					<button type="submit" class="Adv-search-btn" placeholder="Search">Search</button>
			   </div>
		   </div>

		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				<button>Download CSV</button>
				<button>Upload CSV</button>
			   </div>
		   </div>
	   
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   <button class="add-btn">Add Sales Representative</button>
			   </div>
			   <div class="col-md-4" style="padding:0px;">
			   <div class="input-group">
					  <input class="form-control" type="text" placeholder="Search by Name / Mobile / Email">
					  <span class="input-group-append">
						<button class="btn btn-primary" type="button">
						  <i class="fa fa-search"></i>
						</button>
					  </span>
					</div>
			   </div>
		   </div>
	   
	   
<div class="row">	   
  <table class="table table-hover" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
        <th>Name</th>
        <th>Emp-Role-Id</th>
        <th>Role Name</th>
		<th>Email</th>
        <th>Mobile</th>
		<th>Reports To</th>
        <th>Distributor</th>
		<th>Retailer</th>
        <th>City</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	    <tr>
			<td><input type="checkbox" /></td>
			<td>Anshul</td>
			<td>ABD110BD</td>
			<td>Manager</td>
			<td>anshul.kj@gmail.com</td>
			<td>9876543210</td>
			<td>Sunil</td>
			<td>-</td>
			<td>-</td>
			<td>New Delhi</td>
			<td> 
			<button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<tr>
			<td><input type="checkbox" /></td>
			<td>Anshul</td>
			<td>ABD110BD</td>
			<td>Manager</td>
			<td>anshul.kj@gmail.com</td>
			<td>9876543210</td>
			<td>Sunil</td>
			<td>-</td>
			<td>-</td>
			<td>New Delhi</td>
			<td> 
			<button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
    </tbody>
  </table>
</div>
	</div>
	</div>
	
   
    <!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
    <!-- /.content-wrapper-->
    <?php
	 include ('footer.php');
	?>
	?>