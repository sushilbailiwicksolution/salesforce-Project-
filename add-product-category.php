<?php
	 include ('header.php');
	 
	@$proCatId=$_GET['procatId'];
	 
	$form_category=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$category_string=json_encode($form_category);
	$url="http://".$baseurl."/salesforceapi/getProductCategory";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$category_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                           		
	 $category=curl_exec($ch);
	curl_close($ch);
	$getcategory=json_decode($category);
	?>
  
 
  
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Products</a>
        </li>
        <li class="breadcrumb-item active">Add Product Category</li>
		<!--div class="advance-tbtn" id="adv-s">Advance search</div-->
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
	       <?php
		   if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[25]->download=='Y'){
			   ?>
			    <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				<a href="export_all_product_category.php"><button>Download CSV</button></a>
			   </div>
		   </div>
			   <?php
		   }
			   
		   ?>

		  
	    <?php  if(!empty($proCatId)){
				foreach($getcategory->lstProductRawdata as $procategorydata){
					//print_r($subtypedata);
					if($procategorydata->id==$proCatId){?>		
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
				   <label>Product Category</label>
				    <font color='red'> <span id="name_error" style='float:right;' ></span></font>
					<input type="text" class="form-control" name="name" id="product_Category" value="<?php echo $procategorydata->name;?>" required>
				 
				   <label>Description</label>
					<font color='red'> <span id="description_error" style='float:right;' ></span></font>				  
					<textarea class="form-control" rows="3" name="description" id="product_description" style="resize:none;" required><?php echo $procategorydata->description;?></textarea>
					<button class="add-btn add-margin" name="update_product_category" id="update_product_category">Update</button>
			   </div>
		   </div>
					<?php }
				}
		}else{?>
			 <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
				   <label>Product Category</label>
				    <font color='red'> <span id="name_error" style='float:right;' ></span></font>
					<input type="text" class="form-control" name="name" id="product_Category" required>
				 
				   <label>Description</label>
					<font color='red'> <span id="description_error" style='float:right;' ></span></font>				  
					<textarea class="form-control" rows="3" name="description" id="product_description" style="resize:none;" required></textarea>
					<button class="add-btn add-margin" name="create" id="create">Create</button>
			   </div>
		   </div>
		<?php }?>
	   
	   
<div class="row">	   
  <table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Product Category</th>
        <th>Description</th>
		<?php
		if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[25]->edit=='Y'){
			?>
		      <th>Action</th>	
			<?php
		}
		?>
		
      </tr>
    </thead>
    	<?php
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);
	$url="http://".$baseurl."/salesforceapi/getProductCategory";
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
	curl_close($ch);
	$rowdata=json_decode($data);
	?>
	
	
	<tbody>
<?php 	foreach($rowdata->lstProductRawdata as $value){
         
		?>
 
    <tr>
			<td><?php echo $value->name;?></td>
			<td><?php echo $value->description; ?></td>
			<?php
			if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[25]->edit=='Y'){
				?>
				<td> 
			<a href="add-product-category.php?procatId=<?php echo $value->id;?>"><button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
				<?php
				
			}
			?>
			
			
		</tr>
		
			<?php  } ?>
		
    </tbody>
  </table>
</div>
	</div>
	</div>
	
 
   <!-- Prince Code/.content-wrapper-->
   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
	$(document).ready(function() {
	
			$('#example').DataTable();
		});
		$(document).ready(function(){
			$("#create").click(function(){
				//alert("hi");
				var name= $('#product_Category').val();
				var description= $('#product_description').val();
				
				if (name == "")
					{ 
					$('#name_error').text("Requried");
//						alert("Empty");  	
						return false; 
					}else if(description==""){
					$('#description_error').text("Requried");
					return false;
					}
					else{
					
						// Create Function
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
					 data:{'name':name,'description':description,'page':"add_product_catagory"},
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
						
		$(document).ready(function(){
			$("#update_product_category").click(function(){
				//alert("hi");
				var name= $('#product_Category').val();
				var description= $('#product_description').val();
				var proCatid='<?php echo $proCatId;?>';
				
				$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'name':name,'description':description,'proCatid':proCatid,'page':"update_product_category"},
					cache: false,
					success: function(data){
						console.log(data);
						if(data.statusCode == 0) {
							swal("Success",data.message, "success");
								setTimeout(function(){
								window.location.reload();
							}, 2000);
							}else {
								swal("Action failed",data.message, "error");
							}
					}
				});
				
			});
		});

		</script>
    
    <?php
	 include ('footer.php');
	?>