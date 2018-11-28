<?php
	 include ('header.php');
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
        <li class="breadcrumb-item active">Add Retailer</li>
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
	   

		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   
		   </div>
	   
		<div class="row abc">	
			<form action="" method="POST" id="add_retailer" class="add-retailer">
			<div class="col-sm-2 pull-left"> 
				<img src="images/retailer-shop.JPG" style="width: 180px;margin:0 20px 20px 0">
				<button class="add-btn">Delete</button>  
			</div>
			
			<div class="col-lg-10  pull-left">
			<div class="col-lg-12  pull-left padd0">
			<input type="hidden" id="distributerid"  name="distributerid" value="1" class="form-control">
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Retailer Licence Name*</label>
				<input type="text" id="retailer_licence_name" class="form-control" name="retailer_licence_name">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="licence_name"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Contact Person Name1 *</label>
				<input type="text" id="person_name_one" name="person_name_one" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="person_name"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Contact Person Name2</label>
				<input type="text" id="person_name_two" name="person_name_two" class="form-control">
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Contact Person Name3</label>
				<input type="text" id="person_name_three" name="person_name_three" class="form-control">
			</div>
			
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Retailer excise Code*</label>
				<input type="text" id="retailer_excise_code" name="retailer_excise_code" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="retailer_excise"></div>
			</div>
			
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Retailer Email*</label>
				<input type="email" id="retailer_email" name="retailer_email" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="ret_email"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text"> Credit days*</label>
				<input type="text" id="credit_days" name="credit_days" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="cred_days"></div>
			</div>
			</div>
			
			
			
			<div class="col-lg-12  pull-left padd0">
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Mobile1*</label>
				<input type="text" id="mobile_one" name="mobile_one" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="mobile"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Mobile2</label>
				<input type="text" id="mobile_two" name="mobile_two" class="form-control">
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Mobile3</label>
				<input type="text" id="mobile_three" name="mobile_three" class="form-control">
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Landline No</label>
				<input type="text" id="landline_no" name="landline_no" class="form-control">
				
			</div>
			</div>
			
			<div class="col-lg-12  pull-left padd0">
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Locality*</label>
				<input type="text" id="locality" name="locality" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="local"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Street*</label>
				<input type="text" id="street" name="street" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="streets"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">City</label>
				<select class="form-control" name="state" id="City" value="1"> 
							<option>Select</option>
							<?php foreach($rowdata->lstCommnodetail as $value){?>
							<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
							<?php }?>
						</select>
			</div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">District*</label>
				<input type="text" id="district" name="district" class="form-control">
				<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="dist"></div>
			</div>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Pin Code*</label>
				
				<input type="text" id="pin_code" name="pin_code" class="form-control">
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
	//print_r($getzone);
	//die;
	?>
			<div class="col-sm-3 pull-left">
			<label for="defaultFormLoginEmailEx" class="grey-text">Zone</label>
				<select class="form-control" id="zone" name="zone">
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
				<select class="form-control" name="state" id="state" value="1"> 
							<option>Select</option>
							<?php foreach($getState->lstCommnodetail as $value){?>
							<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
							<?php }?>
						</select>
			</div>
			</div>
			
			
			<?php
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
	 $type=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$gettype=json_decode($type);
	//print_r($rowdata);
	//die;
	?>
			
			
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Type</label>
					<select class="form-control" name="type" id="type">
						<option>Select Type</option>
						<?php 	foreach($gettype->lstRetailerDetailedData as $value){ ?>
						<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
						<?php }?>
					</select>
			</div>
			
	<?php
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
	$url="http://".$baseurl."/salesforceapi/getRetailerSubType";
		$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                                		
	 $subtype=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($subtype);
	$getsubtype=json_decode($subtype);
	//print_r($getsubtype);
	//die;
	?>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Subtype</label>
					<select class="form-control" id="sub_type" name="sub_type">
					<option>Select Subtype</option>
					<?php foreach($getsubtype->lstRetailerDetailedData as $value){?>
						<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
						
					<?php }?>
					</select>
			</div>
	<?php
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
	 $category=curl_exec($ch);
	// echo '<pre>';print_r($category);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$getcategory=json_decode($category);
	//print_r($rowdata);
	//die;
	?>
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Category</label>
					<select class="form-control" id="category" name="category">
						<option>Select Category</option>
						<?php foreach($getcategory->lstRetailerDetailedData as $value){ ?>
						<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
						<?php }?>
					</select>
			</div>
<script>
$(document).ready(function(){
document.getElementById('group_name').disabled=true;
  });
</script>  
			<div class="col-sm-3 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Group </label>
				<select class="form-control" name="group" id="group">
						<option value="">No</option>
						<option value="2">Yes</option>
					</select>
			</div>

			<div class="col-sm-3 pull-left" style="disabled">
						<label></label>
						<label for="defaultFormLoginEmailEx" class="grey-text">Group Name</label>
					<select class="form-control" id="group_name" name="group_name">
						
					</select>
			</div>
	
   <script>
     

$('#group').on('change',function(){
var groupid=this.value;
if(groupid==2){
document.getElementById('group_name').disabled=false;
}else{
document.getElementById('group_name').disabled=true;
$('#group_name').children('option').remove();
}
if(groupid =='2'){
$.ajax({
type: "GET",
url: 'ajax.php',
data: 'page=get_groupname',
success: function(res){	
//console.log(res);	
$('#group_name').html(res);
}
});
}
});
</script>
	
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
			<select class="form-control" id="manager" name="manager">
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
					<select class="form-control" id="tsm" name="tsm">
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
				data: 'tsmid='+tsmid+'&page=getrouteName',
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
					<select class="form-control" id="route_name" name="route_name">
					<option>Select</option>							
							<?php if(isset($_POST['tsm'])){
									$tid=$_POST['state'];?>
							<option value="<?php echo $value->employeeId;?>"<?php if($value->employeeName == $value->employeeId){echo "selected";}?>><?php echo $value->employeeName; ?></option>
						<?php }?>
					</select>
					  </div>
					  
					  <div class="col-sm-3 pull-left">
					  <label  class="grey-text">&nbsp;</label>
						<a href="kyc.php"><h5><img src="images/warning.png" width="30">  KYC</h5></a>
					  </div>
					  
					  </div>
			
			
			<div class="col-md-12" style="overflow:hidden;">
						<button type="submit" id="retailer_submit" name="submit" class="add-btn new-btn pull-right btn-primary">Submit</button>
					</div>
					
					
					</form>
					
					
		</div>
	   

	</div>
	</div>
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	 <script type="text/javascript">
$('#retailer_submit').click(function(){
var retailer_licence_name= $('#retailer_licence_name').val();
var person_name_one= $('#person_name_one').val();
var retailer_excise_code= $('#retailer_excise_code').val();
var retailer_email= $('#retailer_email').val();
var credit_days= $('#credit_days').val();
var mobile_one= $('#mobile_one').val();
var landline_no= $('#landline_no').val();
var locality= $('#locality').val();
var street= $('#street').val();
var city= $('#City').val();
var district= $('#district').val();
var pin_code= $('#pin_code').val();

if(retailer_licence_name.length < 1){
$("#licence_name").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Licence Name</p>");
$("#licence_name").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(person_name_one.length < 1){
$("#person_name").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Name</p>");
$("#person_name").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(retailer_excise_code.length < 1){
$("#retailer_excise").html("<p style='color:#FF0000;; text-align:left;'>Please Enter code</p>");
$("#retailer_excise").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(retailer_email.length < 1){
$("#ret_email").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Email</p>");
$("#ret_email").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(credit_days.length < 1){
$("#cred_days").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Credit Days</p>");
$("#cred_days").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(mobile_one.length < 10){
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
$("#cities").html("<p style='color:#FF0000;; text-align:left;'>Please Select City</p>");
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

});
		$(document).ready(function(){
			$("#retailer_submit").click(function(){
				//alert("hi");
				var retailer_licence_name= $('#retailer_licence_name').val();
				var person_name_one= $('#person_name_one').val();
				var person_name_two= $('#person_name_two').val();
				var person_name_three= $('#person_name_three').val();
				var retailer_excise_code= $('#retailer_excise_code').val();
				var retailer_email= $('#retailer_email').val();
				var credit_days= $('#credit_days').val();
				var mobile_one= $('#mobile_one').val();
				var mobile_two= $('#mobile_two').val();
				var mobile_three= $('#mobile_three').val();
				var landline_no= $('#landline_no').val();
				var locality= $('#locality').val();
				var street= $('#street').val();
				var city= $('#city').val();
				var district= $('#district').val();
				var pin_code= $('#pin_code').val();
				var zone= $('#zone').val();
				var state= $('#state').val();
				var type= $('#type').val();
				var sub_type= $('#sub_type').val();
				var category= $('#category').val();
				var group= $('#group').val();
				var group_name= $('#group_name').val();
				var manager= $('#manager').val();
				var asm= $('#asm').val();
				var tsm= $('#tsm').val();
				var route_name= $('#route_name').val();
				var distributerId=$('#distributerid').val();
				$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'retailer_licence_name':retailer_licence_name,'person_name_one':person_name_one,'person_name_two':person_name_two,'person_name_three':person_name_three,'retailer_excise_code':retailer_excise_code,'retailer_email':retailer_email,'credit_days':credit_days,'mobile_one':mobile_one,'mobile_two':mobile_two,'mobile_three':mobile_three,'landline_no':landline_no,'locality':locality,'street':street,'city':city,'district':district,'pin_code':pin_code,'zone':zone,'state':state,'type':type,'sub_type':sub_type,'category':category,'group':group,'group_name':group_name,'manager':manager,'asm':asm,'tsm':tsm,'route_name':route_name,'distributerid':distributerId,'page':"add_retailers"},
					cache: false,
					success: function(retailer){
						console.log(retailer);
						if(retailer.statusCode == 0) {
							swal("Success",retailer.message, "success");
								setTimeout(function(){
								  window.location.href='retailers.php';
								}, 2000);								
							}else {
								swal("Action failed",retailer.message, "error");
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