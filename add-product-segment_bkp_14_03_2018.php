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
          <a href="#">Products</a>
        </li>
        <li class="breadcrumb-item active">Add Product Segment </li>
		<!--div class="advance-tbtn" id="adv-s">Advance search</div-->
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >

		   <!--div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				<button>Download CSV</button>
				<button>Upload CSV</button>
			   </div>
		   </div-->
	   
		   <!--div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   <a href="create-team.php" class="add-btn" >Add Manager</a>
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
		   </div-->
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
				   <label>Product Segment </label>
				   <font color='red'> <span id="name_error" style='float:right;' ></span></font>
				   <input type="text" class="form-control" name="name" id="product_segment" required>
				   <label>Description</label>
					<font color='red'> <span id="description_error" style='float:right;' ></span></font>				  
				  <textarea class="form-control" rows="3" name="description" id="product_description" style="resize:none;" required></textarea>
					<button class="add-btn add-margin" name="create" id="create">Create</button>
			   </div>
		   </div>
	   
	   
<div class="row">	   
  <table class="table table-hover" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Product Segment </th>
        <th>Description</th>
		<th>Action</th>
      </tr>
    </thead>
	<?php
		
	$url="http://103.206.248.235:8080/salesforceapi/getProductSegment";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	//curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $data=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$rowdata=json_decode($data);
	//print_r($rowdata);
	//die;
	?>
	
    <tbody>
	<?php 	foreach($rowdata->lstProductRawdata as $value){ ?>
	
	    <tr>
			<td><?php echo $value->name;?></td>
			<td><?php echo $value->description; ?></td>
			<td> 
			<button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php  } ?>
		
		
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
   <!-- Prince Code/.content-wrapper-->
   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#create").click(function(){
				//alert("hi");
				var name= $('#product_segment').val();
				var description= $('#product_description').val();
			
				if(name==""){
					$('#name_error').text("Requried");
				}else if(description==""){
					$('#description_error').text("Requried");
					
				}else{
					CallAjaxToSave(name,description);
				}
			
				 return false;
			});
		});
		function CallAjaxToSave(name,description){
			$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'name':name,'description':description,'page':"add_product_segment"},
					cache: false,
					success: function(retailer){
						console.log(retailer);
						if(retailer.statusCode == 0) {
							swal("Success",retailer.message, "success");
								setTimeout(function(){
								  window.location.reload();
								}, 2000);								
							}else {
								swal("Action failed",retailer.message, "error");
								}
					}
				});
		}
	</script>
    
    <?php
	 include ('footer.php');
	?>