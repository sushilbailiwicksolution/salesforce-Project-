<?php
	 include ('header.php');
	 $_SESSION['userData']['distributerId'];
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
	$url="http://".$baseurl."/salesforceapi/getRetailerType";
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
  <div class="content-wrapper">
	<div class="container">
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Retailer</a>
        </li>
        <li class="breadcrumb-item active">Add Type</li>
		<!--div class="advance-tbtn" id="adv-s">Advance search</div-->
      </ol>
	   <!-----ddddddd--------->
	   <div class="container">
	   <?php
	   if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[15]->add=='Y'){
		   ?>
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
				<form method="POST" action="" id="add_retailertype" class="add-retailertype">
				   <label>Retailer Type</label>
				 <font color='red'> <span id="name_error" style='float:right;' ></span></font>
				 <input type="text" class="form-control" name="name" id="retailer_type" required>
				   <label>Description</label>
				  <font color='red'> <span id="description_error" style='float:right;' ></span></font>
				  <textarea class="form-control" rows="3" name="description" id="retailer_description" style="resize:none;" required></textarea>
				  <!-- <input type="date" class="form-control" name="createdate" id="retailer_createdate">-->
				   
					<button class="add-btn add-margin" name="create" id="create">Create</button>
				</form>
			   </div>
		   </div>
		   <?php
	   }
	   ?>
		   
	   
	   
<div class="row">	   
  <table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Retailer Type</th>
        <th>Description</th>
		<?php
		if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[15]->edit=='Y'){
			?>
			<th>Action</th>
			<?php
			
		}
		?>
		
      </tr>
    </thead>
	
	
    <tbody>
	<?php 	foreach($rowdata->lstRetailerDetailedData as $value){
               //echo '<pre>';print_r($value);
	 ?>
	    <tr>
			<td><?php echo $value->name;?></td>
			<td><?php echo $value->description; ?></td>
			<?php
			if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[15]->edit=='Y'){
				?>
				<td> 
			<a href="edit-retailer-type.php?id=<?php echo $value->id;?>" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
	$(document).ready(function() {
	
			$('#example').DataTable();
		});
		$(document).ready(function(){
			$("#create").click(function(){
				//alert("hi");
				var name= $('#retailer_type').val();
				var description= $('#retailer_description').val();
				
					
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
					 data:{'name':name,'description':description,'page':"add_retailertype"},
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