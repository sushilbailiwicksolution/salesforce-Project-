<?php
	include ('header.php');
	 
	@$packId=$_GET['packId'];
	
	$form_pack=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$pack_string=json_encode($form_pack);
	$url="http://".$baseurl."/salesforceapi/getPackagetype";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$pack_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                            		
	 $package=curl_exec($ch);
	curl_close($ch);
	$getpackage=json_decode($package);
	
	?>
  

  
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Products</a>
        </li>
        <li class="breadcrumb-item active">Add Package Type</li>
		<!--div class="advance-tbtn" id="adv-s">Advance search</div-->
      </ol>
	   <!-----ddddddd--------->
	   <div class="container">

			<?php 
		   
			if(!empty($packId)){
				foreach($getpackage->lstProductRawdata as $packtypedata){
					//print_r($subtypedata);
					if($packtypedata->id==$packId){?>
						<div class="row" style="margin: 18px -15px;">
							<div class="col-md-4 add-form" style="padding:0px;">
								<label>product Package Type *</label> 
									<font color='red'> <span id="name_error" style='float:right;' ></span></font>
										<input type="text" class="form-control" name="name" id="product_pacakage_type" value="<?php echo $packtypedata->name;?>" required>				
								<label>Description *</label>
									<font color='red'> <span id="description_error" style='float:right;' ></span></font>
										<textarea class="form-control" rows="3" name="description" id="product_description" style="resize:none;" required><?php echo $packtypedata->description;?></textarea>		
								<button class="add-btn add-margin" name="update_package" id="update_package">Update</button>	
							</div>
							
						</div>
					<?php 
					}
				}
			}else{?>
				<div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
			      
				   <label>product Pacakage Type *</label> 
						<font color='red'> <span id="name_error" style='float:right;' ></span></font>
						<input type="text" class="form-control" name="name" id="product_pacakage_type" required>
				
				   <label>Description *</label>
						<font color='red'> <span id="description_error" style='float:right;' ></span></font>
									    
					<textarea class="form-control" rows="3" name="description" id="product_description" style="resize:none;" required></textarea>
		
					<button class="add-btn add-margin" name="create" id="create">Create</button>	
			   </div>
			   
			    <div class="col-md-8 csv" style="padding:0px;">
					<a href="export_all_package_type.php"><button>Download CSV</button></a>
				</div>
		   </div>
			<?php }
			?>
		   
	   
	   
<div class="row">	   
  <table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Products Package Type</th>
        <th>Description</th>
		<?php
		if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[30]->edit=='Y'){
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
	$url="http://".$baseurl."/salesforceapi/getPackagetype";
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
           //echo '<pre>';print_r($value);
		?>
	    <tr>
			<td><?php echo $value->name;?></td>
			<td><?php echo $value->description; ?></td>
			<?php
			if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[30]->edit=='Y'){
				?>
				<td> 
			<a href="add-package-type.php?packId=<?php echo $value->id;?>"><button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
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
				 var name= $('#product_pacakage_type').val();
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
						//return true; 
				
				
				
				 return false;
			});
		});
		
		function CallAjaxToSave(name,description){
			$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'name':name,'description':description,'page':"add_product_pacakage_type"},
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
			$("#update_package").click(function(){
				//alert("hi");
				var name= $('#product_pacakage_type').val();
				var description= $('#product_description').val();
				var packageid='<?php echo $packId;?>';
				
				$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'name':name,'description':description,'packageid':packageid,'page':"update_product_package_type"},
					cache: false,
					success: function(data){
						console.log(data);
						if(data.statusCode == 0) {
							swal("Success",data.message, "success");
								setTimeout(function(){
									self.location.href="add-package-type.php";
								
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