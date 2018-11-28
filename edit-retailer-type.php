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
	//echo'<pre>';print_r($rowdata->lstRetailerDetailedData);
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
                  
		   
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
				
				 <?php foreach($rowdata->lstRetailerDetailedData as $retailerType){
					 //echo '<pre>';print_r($retailerType);
					   
					   if($retailerType->id==$_REQUEST['id']){
						   ?>
						   <label>Retailer Type</label>
				 <font color='red'> <span id="name_error" style='float:right;' ></span></font>
				 <input type="text" class="form-control" name="name" id="retailer_type" value="<?php echo $retailerType->name;?>" required>
				   <label>Description</label>
				  <font color='red'> <span id="description_error" style='float:right;' ></span></font>
				  <textarea class="form-control" rows="3" name="description" id="retailer_description" style="resize:none;" required><?php echo $retailerType->description;?></textarea>
				  <!-- <input type="date" class="form-control" name="createdate" id="retailer_createdate">-->
						   <?php
					   }   
				   }
				   ?>
				   
				   
					<button class="add-btn add-margin" name="create" id="update">UPDATE</button>
				
			   </div>
		   </div>
	   
	   
<div class="row">	   
  <table class="table table-hover" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Retailer Type</th>
        <th>Description</th>
		<th>Action</th>
      </tr>
    </thead>
	
	
    <tbody>
	<?php 	foreach($rowdata->lstRetailerDetailedData as $value){
               //echo '<pre>';print_r($value);
	 ?>
	    <tr>
			<td><?php echo $value->name;?></td>
			<td><?php echo $value->description; ?></td>
			<td> 
			<a href="edit-retailer-type.php?id=<?php echo $value->id;?>" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
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
		$(document).ready(function(){
			$("#update").click(function(){
				//alert("hi");
				var name= $('#retailer_type').val();
				var description= $('#retailer_description').val();
			    let id='<?php echo $_REQUEST['id'];?>';	
				
					
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
						CallAjaxToSave(name,description,id);
						}  	
						
				
				 return false;
			});
		});
		function CallAjaxToSave(name,description,id){
			$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'name':name,'description':description,'id':id,'page':"update_retailertype"},
					cache: false,
					success: function(retailer){
						console.log(retailer);
						if(retailer.statusCode == 0) {
							swal("Success",retailer.message, "success");
								setTimeout(function(){
									self.location.href="add_type.php";
								  //window.location.reload();
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