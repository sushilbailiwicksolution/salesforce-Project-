<?php
	 include ('header.php');
	 //session_start();
	 $form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);		
	$url="http://".$baseurl."/salesforceapi/getZone";
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
	//print_r($rowdata);
	//die;
	?>
  
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  
  
  <div class="content-wrapper">
	<?php //echo 'sssssssss-'.$_SESSION['userData']['distributerId'];?>
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Retailer</a>
        </li>
        <li class="breadcrumb-item active">Add Zone</li>
		<!--div class="advance-tbtn" id="adv-s">Advance search</div-->
      </ol>
	   <!-----ddddddd--------->
	   <div class="container">

		   
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
				     <?php
					 foreach($rowdata->lstRetailerDetailedData as $Zone){
						 if($Zone->id==$_REQUEST['id']){
							 ?>
					           <label>Retailer Zone</label>
				   <font color='red'> <span id="name_error" style='float:right;' ></span></font>
				   <input type="text" class="form-control" name="name" id="zone_name" required value="<?php echo $Zone->name;?>">
				   <label>Description</label>
				   <font color='red'> <span id="description_error" style='float:right;' ></span></font>
				   <textarea class="form-control" rows="3" name="description" id="zone_description" style="resize:none;" required><?php echo $Zone->name;?></textarea>		 
							 <?php
							 
						 }
						 
					 }
					 ?>
				   
					<button class="add-btn add-margin btn-primary" name="create" id="retailer_zone">UPDATE</button>
				
			   </div>
		   </div>   
<div class="row">	   
  <table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Retailer Zone</th>
        <th>Description</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach($rowdata->lstRetailerDetailedData as $value){
               //echo '<pre>';print_r($value);
		 ?>
	    <tr>
			<td><?php echo $value->name;?></td>
			<td><?php echo $value->description;?></td>
			<td> 
			<a type="button" href="edit-zone.php?id=<?php echo $value->id;?>" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php }?>
		
		
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
			$("#retailer_zone").click(function(){
				//alert("hi");
				var name= $("#zone_name").val();
				let id='<?php echo $_REQUEST['id'];?>';
				//alert(name);
				var description= $("#zone_description").val();
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
					data:{'name':name,'description':description,'id':id,'page':"update_retailerzone"},
					cache: false,
					success: function(retailerzone){
                            self.location.href="add_zone.php";						
						if(retailerzone.statusCode == 0) {
							swal("Success",retailerzone.message, "success");
								setTimeout(function(){
									
								//window.location.reload();
							}, 2000);
							}else {
								swal("Action failed",retailerzone.message, "error");
							}
					}
				});
		}
	</script>
    <?php
	 include ('footer.php');
	?>