<?php
	 include ('header.php');
	 $form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
	$url="http://".$baseurl."/salesforceapi/getRetailerCat";
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
	//echo '<pre>';print_r($data->lstRetailerDetailedData);
	?>
  
  <!-------------------------------------navbar ends here------------------------------------------------->
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Retailer</a>
        </li>
        <li class="breadcrumb-item active">Update Category</li>
		<!--div class="advance-tbtn" id="adv-s">Advance search</div-->
      </ol>
	   <!-----ddddddd--------->
	   <div class="container">

		   
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
			   <?php
			    foreach($rowdata->lstRetailerDetailedData as $retailercategory){
					if($retailercategory->id==$_REQUEST['id']){
						?>
					     <label>Retailer Category </label>
				<font color='red'> <span id="name_error" style='float:right;' ></span></font>
				<input type="text" name="name" id="retailer_subtype" class="form-control" value="<?php echo $retailercategory->name;?>" required>
				   <label>Description</label>
				  <font color='red'> <span id="description_error" style='float:right;' ></span></font>
				  <textarea class="form-control" name="description" id="retailer_description" rows="3" style="resize:none;" required><?php echo $retailercategory->description;?></textarea>	
						<?php
						
					}
					
				}
			   ?>
				
				   
					<button class="add-btn add-margin" name="create" id="retailer_updatesubtype">UPDATE</button>
				
			   </div>
		   </div>
	
	   
<div class="row">	   
  <table class="table table-hover" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Retailer Category</th>
        <th>Description</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach($rowdata->lstRetailerDetailedData as $value){
             // echo '<pre>';print_r($value);
			?>
	    <tr>
			<td><?php echo $value->name;?></td>
			<td><?php echo $value->description; ?></td>
			<td> 
			<a type="button" href="edit-retailer-cat.php?id=<?php echo $value->id?>" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		<?php }?>
		</tr>
	</tbody>
  </table>
</div>
	</div>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#retailer_updatesubtype").click(function(){
				//alert("hi");
				var name= $("#retailer_subtype").val();
				//alert(name);
				var description= $("#retailer_description").val();
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
					data:{'name':name,'description':description,'id':id,'page':"update_category"},
					cache: false,
					success: function(retailersubtype){ 
					//alert(retailersubtype);
						if(retailersubtype.statusCode == 0) {
							swal("Success",retailersubtype.message, "success");
								setTimeout(function(){
								self.location.href="add_category.php";
							}, 2000);
							}else {
								swal("Action failed",retailersubtype.message, "error");
							}
					}
				});
		}
	</script>
    <?php
	 include ('footer.php');
	?>