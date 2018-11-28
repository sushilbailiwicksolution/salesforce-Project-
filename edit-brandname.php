<?php
	 include ('header.php');
	 extract($_POST);
	//print_r($_POST); die;
	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
	
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getBrand";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               	
	
	$brand=curl_exec($ch);
	curl_close($ch);
	//print_r($brand);
	$getbrand=json_decode($brand);
	//get license
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
    $urls="http://".$baseurl."/salesforceapi/getLicenseByDistributerId";
    $header=array('Accept: application/json',
		'Content-Type: application/json');

	$ch1=curl_init();
	curl_setopt($ch1,CURLOPT_URL,$urls);
	curl_setopt($ch1,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch1,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch1,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                              
$getlicense=curl_exec($ch1);
//print_r($getlicense);
//echo $data;
curl_close($ch1);

$licence=json_decode($getlicense);
	?>
  <div class="content-wrapper">
	
	<div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Products</a>
        </li>
        <li class="breadcrumb-item active">Edit Brand Name</li>
      </ol>
	   <div class="container" >
		   <div class="row" style="margin: 18px -15px;">
		    <div class="col-md-12 csv" style="padding:0px;">
				<a href="export_all_brands.php"><button>Download CSV</button> </a>
			</div>
		   <input type="hidden" id="state"  name="state" value="1" class="form-control">
		   <input type="hidden" id="distributerid"  name="distributerid" value="1" class="form-control">
		   <?php
		   foreach($getbrand->brandList as $brandList){
			  // echo '<pre>';print_r($brandList);
			   if($brandList->brandId==$_REQUEST['id']){
				   ?>
				   <div class="col-md-3 add-form" style="padding:0px;">
				   <label>Brand Name</label>
				   <input type="text" name="brand_name" id="brand_name" class="form-control" value="<?php echo $brandList->brandName;?>">
				   <div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="brand_nm"></div>
			   </div>
			  
			   
			   <div class="col-md-3 add-form" >
				   <label>Brand Code</label>
				   <input type="text" name="brand_code" id="brand_code" class="form-control" value="<?php echo $brandList->brandCode;?>">
				   <div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="brand_cd"></div>
			   </div>
			   <div class="col-md-3 add-form" >
				  <label>Internal Brand code</label>
				   <input type="text" name="internal_brand_code" id="internal_brand_code" class="form-control" value="<?php echo $brandList->internalBrandCode;?>">  
				   <div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="internal_brand"></div>
			   </div>
			   
			   <div class="col-md-3 add-form">
				  <label>Principle</label>
				   <input type="text" name="principle" id="principle" class="form-control" value="<?php echo $brandList->principal;?>">  
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="brand_principle"></div>   
			   </div>
			   <div class="col-md-3 add-form" >
				  <label>Brand Owner</label>
				   <input type="text" name="brand_owner" id="brand_owner" class="form-control" value="<?php echo $brandList->brandowner;?>">  
				   <div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="brand_own"></div>
			   </div>
			    <div class="col-md-3 pd-3"> 
				 <label>License</label>
					<select class="form-control" name="license" id="license">
						<option value=""> Select License</option>
						 <?php 
                              foreach($licence->list as $lic){
								  ?>
								<option value="<?php echo $lic->licenseId;?>" <?php if($lic->licenseId==$brandList->licenseId){echo 'selected';}?>><?php echo $lic->licenseName;?></option>
								  <?php
							  }						 
						 
						?>
					</select>
			   </div>
			   
			   
			    <div class="col-md-6 add-form" >
				   <label>Description</label>
				   <textarea class="form-control" rows="2" name="description" id="description" style="resize:none;"><?php echo $brandList->description;?></textarea>
				   <div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="descrip"></div>
			   </div>
				   
				   <?php
				   
			   }
			   
			   
		   }
		   ?>
			   
			   
			   
		 <?php 

	
//echo '<pre>';print_r($licence);
	   ?> 	   
			   
			  
			   
			   <div class="col-md-10 add-form" ></div>
			   
			   <div class="col-md-2 add-form" style="    text-align: right;" >
			   <button type="submit" class="add-btn add-margin btn-primary" name="create" id="create" >UPDATE</button>
			   </div>
			   
		   </div>
	   
	   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#create').click(function(){
		var brand_name= $('#brand_name').val();
		var brand_code= $('#brand_code').val();
		var internal_brand_code= $('#internal_brand_code').val();
		var principle= $('#principle').val();
		var brand_owner= $('#brand_owner').val();
		var description= $('#description').val();
		var state=$('#state').val();		
		var license= $('#license').val();
		var distributerId=$('#distributerid').val();
		let brandId='<?php echo $_REQUEST['id'];?>';
		//alert(distributerId);

	if(brand_name.length < 1){
			$("#brand_nm").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Brand Name</p>");
			$("#brand_nm").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });
			return false;
		}
	if(brand_code.length < 1){
			$("#brand_cd").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Brand Code</p>");
			$("#brand_cd").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });
			return false;
		}
	if(internal_brand_code.length < 1){
			$("#internal_brand").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Internal Brand Code</p>");
			$("#internal_brand").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });
			return false;
		}
	if(principle.length < 1){
			$("#brand_principle").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Principle</p>");
			$("#brand_principle").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });
			return false;	
		}
	if(brand_owner.length < 1){
			$("#brand_own").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Brand Owner</p>");
			$("#brand_own").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });
			return false;
		}
	if(description.length < 1){
			$("#descrip").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Description</p>");
			$("#descrip").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });
			return false;
		}
				
	
				$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'brand_name':brand_name,'brand_code':brand_code,'internal_brand_code':internal_brand_code,'principle':principle,'license':license,'brand_owner':brand_owner,'description':description,'state':state,'distributerid':distributerId,'brandId':brandId,'page':"edit_brand"},
					cache: false,
					success: function(brand){
						console.log(brand);
						if(brand.statusCode == 0) {
							swal("Success",brand.message, "success");
								setTimeout(function(){
								window.location.reload();
								}, 2000);								
							}else {
								swal("Action failed",brand.message, "error");
								}
					}
				});
				 return false;
			});
		});
	</script>
<div class="row">	   
  <table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Brand Name</th>
		<th>Brand Code</th>
		<th>Internal Brcode</th>
		<th>Principle</th>
		<th>Brand Owner</th>
		<th>License</th>
        <th>Description</th>		
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($getbrand->brandList as $value){ 
	           
	?>
	    <tr>
			<td><?php echo $value->brandName;?></td>
			<td><?php echo $value->brandCode;?></td>
			<td><?php echo $value->internalBrandCode;?></td>
			<td><?php echo $value->principal;?></td>
			<td><?php echo $value->brandowner;?></td>
			<td><?php echo $value->licenseName;?></td>
			<td width="400"><?php echo $value->description;?></td>
			<td> 
			<a type="button" href="edit-brandname.php?id="<?php echo $value->brandId;?>"" class="btn btn-primary small-btn">
			<i class="fa fa-pencil" aria-hidden="true"></i>
			</a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
	<?php }?>
		
    </tbody>
  </table>
</div>
	</div>
	</div>
	<script>
	   $(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
	
    <?php
	 include ('footer.php');
	?>