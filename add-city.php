<?php
	 include ('header.php');
	?>
  
  <!-------------------------------------navbar ends here------------------------------------------------->
  
  
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Retailer</a>
        </li>
        <li class="breadcrumb-item active">Add City</li>
		<!--div class="advance-tbtn" id="adv-s">Advance search</div-->
      </ol>
	   <!-----ddddddd--------->
	   <div class="container">

		   
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
				
				   <label>Add City</label>
				 <font color='red'> <span id="name_error" style='float:right;' ></span></font>
				 <input type="text" class="form-control" name="City_name" id="CityName" required>
				   
				  <!-- <input type="date" class="form-control" name="createdate" id="retailer_createdate">-->
				   
					<button class="add-btn add-margin" name="create" id="create_city">Create</button>
			
			   </div>
		   </div>
	   
	   
<div class="row">	   
  <table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>City Name</th>
        
		<th>Action</th>
      </tr>
    </thead>
	<?php
	$_SESSION['userData']['distributerId'];
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
	$url="http://".$baseurl."/salesforceapi/getcity";
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
	//echo '<pre>';print_r($rowdata->lstCommnodetail);
	//die;
	?>
	
    <tbody>
	<?php 	foreach($rowdata->lstCommnodetail as $value){
               //echo '<pre>';print_r($value);
	 ?>
	    <tr>
			<td><?php echo $value->name;?></td>
			
			<td> 
			<button type="button" class="btn btn-primary small-btn" onclick="javascript:edit_city(<?php echo $value->id?>)"><i class="fa fa-pencil" aria-hidden="true"></i></button>
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
	$(document).ready(function() {
	
			$('#example').DataTable();
		});
	    function edit_city(City_id){
			self.location.href='edit-city.php?city_id='+City_id;
		}
		$('#create_city').on('click',function(){
			let city_name=$('#CityName').val();
		
			$.ajax({
			type:'POST',
			url:'ajax.php',
			data:{'City_name':city_name,'page':'Create_city'},
			cache:false,
			success:function(res){
					self.location.href="";
				//window.location.reload();
				console.log(res);
				//alert(res);
				if(res.statusCode == 0) {
							swal("Success",res.message, "success");
								setTimeout(function(){
									window.location.reload();
								}, 2000);								
						}else{
								swal("Action failed",res.message, "error");
							}
				
			}
			});
		});
	</script>
    
    <?php
	 include ('footer.php');
	?>