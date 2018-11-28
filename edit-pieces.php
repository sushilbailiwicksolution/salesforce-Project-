<?php
	 include ('header.php');
	 	
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
	$url="http://".$baseurl."/salesforceapi/getQtyPcs";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                             		
	 $data=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$rowdata=json_decode($data);
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
        <li class="breadcrumb-item active">Add Pieces</li>
		<!--div class="advance-tbtn" id="adv-s">Advance search</div-->
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >

		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   
		   </div>
	   
		  
		   <div class="row" style="margin: 18px -15px;">
		   <?php
		     foreach($rowdata->listQtyInPcs as $picess){
				//echo '<pre>';print_r($picess);
				 if($picess->id==$_REQUEST['id']){
					 ?>
					 <div class="col-md-4 add-form" style="padding:0px;">
						<label>Quantity In ML</label>
					<font color='red'> <span id="name_error" style='float:right;' ></span></font>
					<input type="text" class="form-control" name="name" id="product_ml" value="<?php echo $picess->qtyMl?>" required>
						<label>Description</label>
					<font color='red'> <span id="description_error" style='float:right;' ></span></font>
					<textarea class="form-control" rows="3" name="description" id="product_description" style="resize:none;" required><?php echo $picess->description?></textarea>
				
					<button class="add-btn add-margin" name="create" id="create">Update</button>
			   </div>
			   <div class="col-md-4 add-form" >
						<label>Pieces</label>
						<font color='red'> <span id="piece_error" style='float:right;' ></span></font>
					<input type="text" class="form-control" name="pieces" id="product_pieces" required value="<?php echo $picess->pcs?>">
	
				   
			   </div>
					 
					 <?php
					 
				 }
				 
			 }
		   ?>
			   
		   </div>
	   
	   
<div class="row">	   
  <table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Quantity (Ml)</th>
		<th>Pieces</th>
        <th>Description</th>
		<th>Action</th>
      </tr>
    </thead>
		
	

    <tbody>
	<?php 	foreach($rowdata->listQtyInPcs as $value){ 
          // echo '<pre>';print_r($value);
		?>
	    <tr>
			<td><?php echo $value->qtyMl;?></td>
			<td><?php echo $value->pcs; ?></td>
			<td><?php echo $value->description; ?></td>

			<td> 
			<a href="edit-pieces.php?id=<?php echo $value->id;?>">
			<button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
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
    <!-- /.content-wrapper-->
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
	$(document).ready(function() {
	
			$('#example').DataTable();
		});
	//console("prince");
		$(document).ready(function(){
			$("#create").click(function(){
				//alert("hi");
				var product_ml= $('#product_ml').val();
				var product_pcs= $('#product_pieces').val();
				var description= $('#product_description').val();
				
			
				
				if(product_ml==""){
					$('#name_error').text("Requried")
				return false;
				}else if(product_pcs==""){
					$('#piece_error').text("Requried")
				return false;
				}else if(description==""){
					$('#description_error').text("Requried")
				return false;
				}else{
					CallAjaxToSave(product_ml,product_pcs,description);
				}
				
				
				 return false;
			});
		});
		
		function CallAjaxToSave(product_ml,product_pcs,description){
			var picess='<?php echo $_REQUEST['id'];?>';
			$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'product_ml':product_ml,'product_pieces':product_pcs,'product_description':description,'id':picess,'page':"edit_product_peice_qty"},
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