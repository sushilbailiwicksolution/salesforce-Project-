   <?php
	 include ('header.php');
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
          <a href="#">Retailers</a>
        </li>
        <li class="breadcrumb-item active">Add Group</li>
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
	   

		  
	   
		<div class="row abc">	 
			<div class="col-sm-2 pull-left">
				<img src="images/retailer-shop.JPG" style="width: 180px;margin:0 20px 20px 0">
				<button class="add-btn">Delete</button>
			</div>
			
			<div class="col-lg-10  pull-left">
			
			<div class="col-lg-12  pull-left padd0">
			<input type="hidden" id="distributerid"  name="distributerid" value="<?php echo $_SESSION['userData']['distributerId'];?>" class="form-control">
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Group Name</label>
				<input type="email" id="group_name" name="group_name" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="group_nm"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Contact Person Name * 1 </label>
				<input type="email" id="contact_preson_name1" name="contact_preson_name1" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="person_name"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Contact Person Name 2</label>
				<input type="email" id="contact_preson_name2" name="contact_preson_name2" class="form-control">
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Contact Person Name 3</label>
				<input type="email" id="contact_preson_name3" name="contact_preson_name3" class="form-control">
			</div>
			
			
			
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Retailer Email</label>
				<input type="email" id="group_email"  name="group_email" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="ret_email"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text"> Credit days</label>
				<input type="email" id="credit_days" name="credit_days" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="cred_days"></div>
			</div>
			
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text"> Group Code</label>
				<input type="text" id="group_code" name="group_code" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="cred_days"></div>
			</div>
			</div>
			
			
			<div class="col-lg-12  pull-left padd0">
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Mobile1*</label>
				<input type="email" id="mobile_one" name="mobile_one" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="mobile"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Mobile2</label>
				<input type="email" id="mobile_two" name="mobile_two" class="form-control">
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Mobile3</label>
				<input type="email" id="mobile_three" name="mobile_three" class="form-control">
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Landline No</label>
				<input type="email" id="landline"  name="landline" class="form-control">
			</div>
			</div>
			
			<div class="col-lg-12  pull-left padd0">
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Locality</label>
				<input type="email" id="locality" name="locality" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="local"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Street</label>
				<input type="email" id="street" name="street" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="streets"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">City</label>
				<input type="email" id="city" name="city" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="cities"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">District</label>
				<input type="email" id="district" name="district" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="dist"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Pin Code</label>
				<input type="email" id="pin_code" name="pin_code" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="pin"></div>
			</div>
			
			 <?php
		
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
	 $zone=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$getzone=json_decode($zone);
	?>
			
			
			<div class="col-sm-3 pull-left">
			<label for="defaultFormLoginEmailEx" class="grey-text">Zone</label>
				<select class="form-control" name="zone" id="zone">
						<option> Select Zone </option>
				<?php foreach($getzone->lstRetailerDetailedData as $value){ ?>						
						<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
						
				<?php } ?>
						
					</select>
			</div>
	
	<?php			
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);				
	$url="http://".$baseurl."/salesforceapi/getAllState";
		$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                                		
	 $state=curl_exec($ch);
	curl_close($ch);
	//print_r($data);
	$getState=json_decode($state);
	//print_r($rowdata);
	//die;
			?>
			
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">State</label>
				<select class="form-control" name="state" id="state">
						<option>Select</option>
							<?php foreach($getState->lstCommnodetail as $value){?>
							<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
							<?php }?>
					</select>
			</div>
			</div>
					  
	<?php 
	extract($_POST);
	//print_r($_POST); die;
	$form_designation=array('roleId'=>'37','distributerId'=>$_SESSION['userData']['distributerId']);
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
	
	//$option.="<option value='1'>ADMIN</option>";
	$manager=curl_exec($ch);
	curl_close($ch);
	//print_r($manager);
	$getmanager=json_decode($manager);
	
	   ?> 
					  
		<div class="col-sm-3 pull-left">
						<label></label>
						<label for="defaultFormLoginEmailEx" class="grey-text">Manager</label>
					<select class="form-control" name="manager" id="manager">
					    <option value="">Select Managers</option>
			<?php foreach($getmanager->lstMemberResponse as $value){ ?>
				 <option value="<?php  echo $value->employeeId;?>"><?php echo $value->employeeName?> </option>
			<?php }?>
					</select>
					  </div>
					  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
$('#manager').on('change', function () {
	var managerid=this.value;
	if(managerid!=''){
			$.ajax({
				type: "GET",
				url: 'ajax.php',
				data: 'managerid='+managerid+'&page=getAsmteam&req=2',
				success: function(res){	
                    console.log(res);				
					$('#asm').html(res);
				}
			});
		}
	});
</script>
					  
					  <div class="col-sm-3 pull-left">
						<label></label>
						<label for="defaultFormLoginEmailEx" class="grey-text">ASM</label>
					<select class="form-control" id="asm" name="asm">
					    <option>Select</option>							
							<?php if(isset($_POST['manager'])){
									$mid=$_POST['state'];?>
							<option value="<?php echo $value->employeeId;?>"<?php if($value->employeeName == $value->employeeId){echo "selected";}?>><?php echo $value->employeeName; ?></option>
						<?php }?>
					</select>
					  </div>
					  
<script>
$('#asm').on('change', function () {
	var asmid=this.value;
	if(asmid!=''){
			$.ajax({
				type: "GET",
				url: 'ajax.php',
				data: 'asmid='+asmid+'&page=gettsmteam&req=3',
				success: function(res){	
                    console.log(res);				
					$('#tsm').html(res);
				}
			});
		}
});
</script>
					  
					  <div class="col-sm-3 pull-left">
						<label></label>
						<label for="defaultFormLoginEmailEx" class="grey-text">TSM</label>
					<select class="form-control" name="tsm" id="tsm">
					      <option>Select</option>							
							<?php if(isset($_POST['asm'])){
									$aid=$_POST['state'];?>
							<option value="<?php echo $value->employeeId;?>"<?php if($value->employeeName == $value->employeeId){echo "selected";}?>><?php echo $value->employeeName; ?></option>
						<?php }?>
					</select>
					  </div>
	<script>
$('#tsm').on('change', function () {
	var tsmid=this.value;
	if(tsmid!=''){
			$.ajax({
				type: "GET",
				url: 'ajax.php',
				data: 'tsmid='+tsmid+'&page=getsrteam&req=3',
				success: function(res){	
                    console.log(res);				
					$('#route_name').html(res);
				}
			});
		}
});
</script>
					  <div class="col-sm-3 pull-left">
						<label></label>
						<label for="defaultFormLoginEmailEx" class="grey-text">Route Name</label>
					<select class="form-control" name="route_name" id="route_name">
					    <option>Select</option>							
							<?php if(isset($_POST['tsm'])){
									$tid=$_POST['state'];?>
							<option value="<?php echo $value->employeeId;?>"<?php if($value->employeeName == $value->employeeId){echo "selected";}?>><?php echo $value->employeeName; ?></option>
						<?php }?>
					</select>
					  </div>
					  
					  <div class="col-sm-3 pull-left">
					  <label class="grey-text">&nbsp;</label>
						<a href="kyc.php"><h5><img src="images/warning.png" width="30">  KYC</h5></a>
					  </div>
					  
					  </div>
			
			
			<div class="col-md-12" style="overflow:hidden;">
						<button type="submit" id="group_submit" name="submit" class="add-btn new-btn pull-right">Submit</button>
					</div>
					
					
					
					
					
		</div>
	   

	</div>
	</div>
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		 <script type="text/javascript">
$('#group_submit').click(function(){
var group_name= $('#group_name').val();
var contact_preson_name1= $('#contact_preson_name1').val();
var group_email= $('#group_email').val();
var credit_days= $('#credit_days').val();
var mobile_one= $('#mobile_one').val();
var locality= $('#locality').val();
var street= $('#street').val();
var city= $('#city').val();
var district= $('#district').val();
var pin_code= $('#pin_code').val();

if(group_name.length < 1){
$("#group_nm").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Group Name</p>");
$("#group_nm").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(contact_preson_name1.length < 1){
$("#person_name").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Name</p>");
$("#person_name").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(group_email.length < 1){
$("#ret_email").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Email</p>");
$("#ret_email").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(credit_days.length < 1){
$("#cred_days").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Credit Days</p>");
$("#cred_days").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(mobile_one.length < 1){
$("#mobile").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Mobile No</p>");
$("#mobile").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(locality.length < 1){
$("#local").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Locality</p>");
$("#local").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(street.length < 1){
$("#streets").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Street</p>");
$("#streets").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(city.length < 1){
$("#cities").html("<p style='color:#FF0000;; text-align:left;'>Please Enter City</p>");
$("#cities").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(district.length < 1){
$("#dist").html("<p style='color:#FF0000;; text-align:left;'>Please Enter District</p>");
$("#dist").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(pin_code.length < 1){
$("#pin").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Pin Code</p>");
$("#pin").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}

if(group_code.length < 1){
$("#group_code").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Group Code</p>");
$("#group_code").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
}); 
		$(document).ready(function(){
			$("#group_submit").click(function(){
				
				var group_name= $('#group_name').val();
				var contact_preson_name1= $('#contact_preson_name1').val();	
				var contact_preson_name2= $('#contact_preson_name2').val();							
				//alert(contact_preson_name2);
				var contact_preson_name3= $('#contact_preson_name3').val();
				//alert(contact_preson_name3);
				var group_email= $('#group_email').val();
				//alert(group_email);
				var credit_days= $('#credit_days').val();
				//alert(credit_days);
				var mobile_one= $('#mobile_one').val();
				//alert(mobile_one);
				var mobile_two= $('#mobile_two').val();
				//alert(mobile_two);
				var mobile_three= $('#mobile_three').val();
				//alert(mobile_three);
				var landline= $('#landline').val();
				//alert(landline_no);
				var locality= $('#locality').val();
				//alert(locality);
				var street= $('#street').val();
				//alert(street);
				var city= $('#city').val();
				//alert(city);
				var district= $('#district').val();
				//alert(district);
				var pin_code= $('#pin_code').val();
				//alert(pin_code);
				var zone= $('#zone').val();
				//alert(zone);
				var state= $('#state').val();
				//alert(state);
				var manager= $('#manager').val();
				//alert(manager);
				var asm= $('#asm').val();
				//alert(asm);
				var tsm= $('#tsm').val();
				//alert(tsm);
				var route_name= $('#route_name').val();
				//alert(route_name);
				var distributerId=$('#distributerid').val();
				var group_code=$('#group_code').val();
				//alert(distributerId);		
				//
				$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'group_name':group_name,'contact_preson_name1':contact_preson_name1,'contact_preson_name2':contact_preson_name2,'contact_preson_name3':contact_preson_name3,'group_email':group_email,'credit_days':credit_days,'mobile_one':mobile_one,'mobile_two':mobile_two,'mobile_three':mobile_three,'landline':landline,'locality':locality,'street':street,'city':city,'district':district,'pin_code':pin_code,'zone':zone,'state':state,'manager':manager,'asm':asm,'tsm':tsm,'route_name':route_name,'distributerid':distributerId,'group_code':group_code,'page':"add_group"},
					cache: false,
					success: function(group){
						//alert(group);
						console.log(group);
						if(group.statusCode == 0) {
							swal("Success",group.message, "success");
								setTimeout(function(){
								 window.location.href='chain.php';
								}, 2000);								
							}else {
								swal("Action failed",group.message, "error");
								}
					}
				});
				 return false;
			});
		});
	</script>
	
	
    <?php
	 include ('footer.php');
	?>
	
	
	
	<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Shop</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row  ">	 
			
			<div class="col-lg-12 hub-area">
			<div class="col-lg-3 col-md-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">Retailer Name</label>
				<input type="email" id="defaultFormLoginEmailEx" class="form-control">
			</div>
			<div class="col-lg-3 col-md-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">Licence</label>
				<input type="email" id="defaultFormLoginEmailEx" class="form-control">
			</div>
			<div class="col-lg-3 col-md-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">Retailer Email</label>
				<input type="email" id="defaultFormLoginEmailEx" class="form-control">
			</div>
			<div class="col-lg-3 col-md-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">Mobile</label>
				<input type="email" id="defaultFormLoginEmailEx" class="form-control">
			</div>
			<div class="col-lg-3 col-md-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">Address</label>
				<input type="email" id="defaultFormLoginEmailEx" class="form-control">
			</div>
			<div class="col-lg-3 col-md-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">State</label>
				<input type="email" id="defaultFormLoginEmailEx" class="form-control">
			</div>
			<div class="col-lg-3 col-md-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">SR</label>
				<input type="email" id="defaultFormLoginEmailEx" class="form-control">
			</div>
			<div class="col-lg-3 col-md-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">Type</label>
					<select class="form-control">
						<option>On</option>
						<option>Off</option>
					</select>
			</div>
			<div class="col-lg-3 col-md-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">Subtype</label>
					<select class="form-control">
						<option>Hotel</option>
						<option>Restaurant</option>
						<option>Bar</option>
					</select>
			</div>
			<div class="col-lg-3 col-md-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">Category</label>
					<select class="form-control">
						<option>Gold</option>
						<option>Silver</option>
						<option>Platinum</option>
					</select>
			</div>
			<div class="col-lg-3 col-md-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">Chain Name</label>
				<input type="email" id="defaultFormLoginEmailEx" class="form-control">
			</div>
			
			
			
			</div>
			
			
			
		</div>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary">Add &amp; Save </button>
      </div>
    </div>
  </div>
</div>
	
	
	
	
	
	