<?php
error_reporting(E_ERROR | E_PARSE);
include ('header.php');
  //echo'<pre>';print_r($_SESSION['userData']);
   $month = 201002; 
   $date = DateTime::createFromFormat('Yd', $month);  

	// Start Get Brand
	extract($_POST);
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);
	$url="http://".$baseurl."/salesforceapi/getBrand";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               	
	$brand=curl_exec($ch);
	curl_close($ch);
	$getbrand=json_decode($brand);
	
	//End Get Brand
	
	
	
	
	
	//Start Get Product SubType
	
	$url="http://".$baseurl."/salesforceapi/getProductSubType";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                        
	$Subtype=curl_exec($ch);
	curl_close($ch);
	$getSubtype=json_decode($Subtype);	
	
	// End Get Product SubType
	
	// Start Get Package Type
	$url="http://".$baseurl."/salesforceapi/getPackagetype";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	//curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);     
	$packagetype=curl_exec($ch);
	curl_close($ch);
	$getpackagetype=json_decode($packagetype);	
	
	// End Get Package Type 
	
	// Start Get Quantity 
	
	$url="http://".$baseurl."/salesforceapi/getQtyPcs";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);
	$qtypcs=curl_exec($ch);
	curl_close($ch);
	$getqtypcs=json_decode($qtypcs);
	
	// End Get Quantity
	
	// Start Get Product Type
	
	$url="http://".$baseurl."/salesforceapi/getProductType";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                  
	$protype=curl_exec($ch);
	curl_close($ch);
	$getprotype=json_decode($protype);
	
	// End Get Product Type
	
	// Start Get License 
	
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
   $license=curl_exec($ch1);
	curl_close($ch);
	$getlicense=json_decode($license);
	
	// End Get License 
	
	
	//get manager
	if($_SESSION['userData']['employeeId']==1){
	$form_designation=array('roleId'=>'37','distributerId'=>$_SESSION['userData']['distributerId']);	
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getTeamByRole";	
	}
	if($_SESSION['userData']['roleId']==37){
	$form_designation=array('roleId'=>$_SESSION['userData']['roleId'],'id'=>$_SESSION['userData']['employeeId']);	
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getListForProfile";		
	}
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
	$option="<option value=''> Select Asm</option>";
	//$option.="<option value='1'>ADMIN</option>";
	$manager=curl_exec($ch);
	curl_close($ch);
	//print_r($manager);
	$getmanager=json_decode($manager);
	
	// get target
$date_year=date('Y');
$month = 201002; 
$date = DateTime::createFromFormat('Yd', $month);  
$monthName = $date->format('M'); // will get Month name
	if($_REQUEST['year']!=''){
		
		$date_year=$_REQUEST['year'];
	}
	if($_REQUEST['month']!=''){
		
		$monthName=$_REQUEST['month'];
	}

$date_year=date('Y');

if($_REQUEST['manager_id']==""){
	
	$manager_id=$_SESSION['userData']['employeeId'];
}else{
	$manager_id=$_REQUEST['manager_id'];
}
//echo 'managerdddddddd-'.$manager_id;
$form_target=array('id'=>$manager_id,'month'=>$monthName,'year'=>$date_year);	
$target_string=json_encode($form_target);
$url="http://".$baseurl."/salesforceapi/getTarget";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$target_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                           
$target=curl_exec($ch);
curl_close($ch);
$gettarget=json_decode($target);

//echo '<pre>';print_r($gettarget);
$form_designation=array('roleId'=>'38','distributerId'=>$_SESSION['userData']['distributerId'],'employeeId'=>$_SESSION['userData']['employeeId']);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getTeamByRole";
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
	
	$asm=curl_exec($ch);
	curl_close($ch);
	//print_r($manager);
	$getasm=json_decode($asm);
	
	$form_designation=array('roleId'=>'39','distributerId'=>$_SESSION['userData']['distributerId'],'employeeId'=>$_SESSION['userData']['employeeId']);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getTeamByRole";
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
	
	$tsm=curl_exec($ch);
	curl_close($ch);
	//print_r($manager);
	$gettsm=json_decode($tsm);
	
/**************************************GET TSM LIST*********************************************************************/
$form_designation=array('roleId'=>'39','distributerId'=>$_SESSION['userData']['distributerId'],'employeeId'=>$_SESSION['userData']['employeeId']);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getTeamByRole";
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
	
	$tsmData=curl_exec($ch);
	curl_close($ch);
	//print_r($manager);
	$gettsmList=json_decode($tsmData);
/****************************************END GET TSM LIST***************************************************************/

$form_designation=array('roleId'=>'40','distributerId'=>$_SESSION['userData']['distributerId'],'employeeId'=>$_SESSION['userData']['employeeId']);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getTeamByRole";
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
	 
	$sr=curl_exec($ch);
	curl_close($ch);
	//print_r($sr);
	$getsr=json_decode($sr);
	
?> 
	<div class="content-wrapper">
			<div class="container">	
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
          <a href="#">Orders</a>
        </li>
        <li class="breadcrumb-item active">Create Target</li>
				</ol>
			<div class="container">
			<!--<div class="row" style="margin: 18px -15px;">
				<div class="col-md-8" style="padding:0px;"></div>
				<?php //if(!empty($_GET['pro_id'])){?>
				<div class="col-md-4 csv" style="padding:0px;">
				<?php 
					/*@$proID=$_GET['pro_id'];
					@$source=$_GET['source'];
					if(!$source){*/
				?>
					<button onclick="editProfile(<?//=$proID;?>);">Edit Product</button>
					<?php //}else{?>
					<button onclick="viewProfile(<?//=$proID;?>);">View Product</button>	
					<?php //}?>
			   </div>
			   <?php //}?>
			</div>  -->
			
	<!--ADD Product-->	
		
		<div class="row abc">
        <div class="col-sm-2">
					<input type="hidden" id="employee"  name="employee" value="<?php echo $_SESSION['userData']['distributerId'];?>" class="form-control">
				<input type="hidden" id="role"  name="role" value="37" class="form-control">
				<label for="defaultFormLoginEmailEx" class="grey-text">Year</label>
					<select class="form-control" name="year" id="year">
						<option><?php echo $date_year;?></option>
						<option>2016</option>
						<option>2017</option>
					</select>
			</div>
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Month</label>
					<select class="form-control" name="month" id="month">
					    <option><?php echo $monthName;?></option>
						<option>Jan</option>
						<option>Feb</option>
						<option>Mar</option>
						<option>Apr</option>
						<option>May</option>
						<option>Jun</option>
						<option>july</option>
						<option>Aug</option>
						<option>Sep</option>
						<option>Out</option>
						<option>Nov</option>
						<option>Dec</option>
					</select>
			</div>
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">License</label>
				<select class="form-control" name="license" id="license">
						<option> Select License </option>							
							<?php if(isset($_POST['brand_name'])){?>
							<option value="<?php echo $value->licenseId;?>" ><?php echo $value->licenseName; ?></option>
						<?php }?>
							<?php $arr=array(); foreach($getbrand->brandList as $value){?>
							<?php if(!in_array($value->licenseId,$arr,TRUE)){?>
						    <option value="<?php echo $value->licenseId; ?>"><?php echo $value->licenseName; ?></option>
						    <?php } ?>
						<?php array_push($arr,$value->licenseId); } ?>
				</select>
			</div>
			
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Brand Name</label>
				<input type="hidden" id="employee"  name="employee" value="<?php echo $_SESSION['userData']['employeeId'];?>" class="form-control">
				<input type="hidden" id="distributerid"  name="distributerid" value="<?php echo $_SESSION['userData']['distributerId']?>" class="form-control">
				<select class="form-control" id="brand_name" name="brand_name">
				<option> Select Brand Name </option>	
				<?php foreach($getbrand->brandList as $brandData){
					?>
					<option value="<?= $brandData->brandId;?>"><?= $brandData->brandName;?></option>
				<?php } ?>
					
				</select>
			</div>
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Brand Code</label>
				<select class="form-control" id="brand_code" name="brand_code">				
				<option> Select Brand Code </option>	
				<?php foreach($getbrand->brandList as $brandcode){?>
					<option><?= $brandcode->brandCode;?></option>
				<?php }?>
				</select>
			</div>			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Internal Br. Code</label>
				<select class="form-control" id="internal_brand_code" name="internal_brand_code">
				<option> Select Internal Brand Code</option>	
				<?php foreach($getbrand->brandList as $internalbrandcode){?>
					<option><?= $internalbrandcode->internalBrandCode;?></option>
				<?php }?>
				</select>
			</div>
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Cases / Pices</label>
				<input type="email" id="cases" name="cases" class="form-control">
			</div>
			<?php
			   if($_SESSION['userData']['employeeId']==1){
				  ?>
				  <div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Manager</label>
					<select class="form-control" name="manager" id="managers">
						<option value="">Select Manager </option>
						<?php foreach($getmanager->lstMemberResponse as $managerList){?>
						<option value="<?php echo $managerList->employeeId;?>"><?php echo $managerList->employeeName;?></option>
						<?php }?>
					</select>
			</div>
                  <?php				  
				   
			   }
			   if($_SESSION['userData']['roleId']==37){
				   ?>
				   <div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Asm</label>
					<select class="form-control" name="manager" id="managers">
						<option value="">Select Asm</option>
						<?php foreach($getasm->lstMemberResponse as $managerList){?>
						
						<option value="<?php echo $managerList->employeeId;?>"><?php echo $managerList->employeeName;?></option>
						<?php }?>
					</select>
			</div>
				   <?php
			   }
			?>
			
			<?php				  
				   //print_r($_SESSION);
			   
			   if($_SESSION['userData']['roleId']==38){
				   ?>
				   <div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Tsm</label>
					<select class="form-control" name="manager" id="managers">
						<option value="">Select Tsm</option>
						<?php foreach($gettsmList->lstMemberResponse as $managerList){?>
						
						<option value="<?php echo $managerList->employeeId;?>"><?php echo $managerList->employeeName;?></option>
						<?php }?>
					</select>
			</div>
				   <?php
			   }
			?>
			
			<?php				  
				  // print_r($_SESSION);
			   
			   if($_SESSION['userData']['roleId']==39){
				   ?>
				   <div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Sr</label>
					<select class="form-control" name="manager" id="managers">
						<option value="">Select SR</option>
						<?php foreach($getsr->lstMemberResponse as $managerList){?>
						
						<option value="<?php echo $managerList->employeeId;?>"><?php echo $managerList->employeeName;?></option>
						<?php }?>
					</select>
			</div>
				   <?php
			   }
			?>
			
			
			
			
			
			
			<div class="col-sm-4 " style="    margin-top: 37px;">
			<label for="defaultFormLoginEmailEx" class="grey-text">&nbsp;</label>
				<button  id="manager_search" class="add-btn" style="width:34%; padding: 8px;">Search</button>
				<?php
				if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[41]->add=='Y'){
				   ?>
				   <button  id="create_target" class="add-btn" style="width:34%; padding: 8px;">Add</button>
                  <?php				   
				}
				?>
				
			</div>
		</div>
			
		
		</div>
<!--table start here-->
<?php
if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[41]->view=='Y'){
	?>
	  <div class="row" style="margin-top:40px;">	   
  <table class="table table-hover" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Year</th>
        <th>Month </th>
        <!--<th>License</th>
		<th>Internal Brand code</th>-->
		<th>Brand</th>
        <th>Cases / Pices</th>
		<th>Manager</th>
		<!--<th>Action</th>-->
      </tr>
    </thead>
    <tbody>
		  <?php 
		  $flag=0;
		  foreach($gettarget->targetList as $target_data){ 
		//echo '<pre>'; print_r($target_data);
		$flag=1;
		if($flag==1){
			?>
		<tr>
			<td><?php echo $target_data->targetYear;?></td>
			<td><?php echo $target_data->targetMonth;?></td>
			<td><?php echo $target_data->brandName;?></td>
			<td><?php echo $target_data->qty;?></td>
			<td><?php echo $target_data->assignName;?></td>
		
			<!--<td> 
			<button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>-->
		</tr>
		<?php
			
			
		}
		
	}
	
	?>
    </tbody>
  </table>
  <?php
  if($flag==0){
		   ?>
			<h5 style="color:red;margin-left: 393px;;">DATA NOT FOUND</h5>
			<?php
		
	}
  ?>
</div>
	<?php
	
	
}
?>

<!--table end here-->		
	</div>
	</div>
</div>



<!--Script-->

<script>

       /****************************GET TARGET BY MANAGER***************************/
	$('#manager_search').on('click',function(){
		var manager_id=$('#managers').val();
		var year=$('#year').val();
		var month=$('#month').val();
		if(manager_id!='' & year!='' & month!=''){
				self.location.href="create_target.php?manager_id="+manager_id+'&year='+year+'&month='+month;
		}else{
			alert('Please enter all field Details');
		}
		//alert(manager_id);
	
	});
	/*****************************END GET MANAGER*******************************/
	// Brand Name

		$('#brand_name').on('change', function(){
			var brandid=this.value;	
			if(brandid!=''){
				$.ajax({
					type: "GET",
					url: 'ajax.php',
					dataType:'JSON',
					data: 'brandid='+brandid+'&page=getbrandcode',				
					success: function(res){	
						console.log(res);
						$('#brand_code').html(res.brand_id);
						$('#internal_brand_code').html(res.internal_brand);
						//$('#license').html(res.license_name);					
					}
				});
			}
		});
		
	// Brand Code	
		
		$('#brand_code').on('change', function () {
			var brand_code=this.value;	
			if(brand_code!=''){
				$.ajax({
					type: "GET",
					url: 'ajax.php',
					dataType:'JSON',
					data: 'brand_code='+brand_code+'&page=getbrandname',				
					success: function(res){	
						$('#brand_name').html(res.brand_id);
						$('#internal_brand_code').html(res.internal_brand);
						$('#license').html(res.license_name);
					}
				});
			}
		});
		
	// Internal Brand Code 
	
		$('#internal_brand_code').on('change', function () {
			var internal_brand_code=this.value;	
			if(internal_brand_code!=''){
				$.ajax({
					type: "GET",
					url: 'ajax.php',
					dataType:'JSON',
					data: 'internal_brand_code='+internal_brand_code+'&page=get_internal_brand_name',				
					success: function(res){	
						console.log(res);
						$('#brand_name').html(res.internal_brand);
						$('#brand_code').html(res.brand_id);
						$('#license').html(res.license_name);
					}
				});
			}
		});
		
	// Product Type
	
		$('#pro_type').on('change', function (){
			$('#number option[value!="0"]').remove();
			var pro_type=this.value;
				if(pro_type=='5'){
					$("#number").append('<option value="1">1</option>');
				}else{
					if(pro_type!=''){
						$.ajax({
							type: "GET",
							url: 'ajax.php',
							dataType:'JSON',
							data: 'pro_type='+pro_type+'&page=get_pro_type_name',				
							success: function(res){	
							   $('#number').html(res.qty_num);
							}
						});
					}
				}
		});
		
	// License 
	
		$('#license').on('change', function () {
			var license=$('#license').val();
			if(license!=''){
				$.ajax({
					type: "GET",
					url: 'ajax.php',
					dataType:'JSON',
					data: 'license='+license+'&page=get_license_name',				
					success: function(res){	
						console.log(res);
						$('#internal_brand_code option[value!="0"]').remove();	
						$('#brand_code option[value!="0"]').remove();	
						$('#brand_name option[value!="0"]').remove();
						$('#internal_brand_code').html(res.internal_brand);
						$('#brand_code').html(res.brand_id);
						$('#brand_name').html(res.brand_name);
					}
				});
			}
		});
		//add target
		$(document).ready(function(){
			$("#create_target").click(function(){
				var brand_name= $('#brand_name').val();
				var internal_brand_code= $('#internal_brand_code').val();
				var year= $('#year').val();
				var month= $('#month').val();
				var license= $('#license').val();
				var manager= $('#managers').val(); 
				var cases= $('#cases').val(); 
				var employee=$('#employee').val();
				var role=$('role').val();
				
				$.ajax({
					type: "POST",
					url: 'ajax.php',
					dataType:'JSON',
					data:{'brand_name':brand_name,'internal_brand_code':internal_brand_code,'year':year,'month':month,'license':license,'manager':manager,'cases':cases,'employee':employee,'role':role,'page':"add_target"},				
					cache: false,
					success: function(target){
						console.log(target);
						if(target.statusCode == 0) {
							swal("Success",target.message, "success");
								setTimeout(function(){
									window.location.reload();
								}, 2000);								
						}else{
								swal("Action failed",target.message, "error");
							}
					}
				});
				
			});
		});
	
	
</script>


	
<?php include ('footer.php');	?>