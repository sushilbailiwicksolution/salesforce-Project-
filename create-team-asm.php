<?php
	 include ('header.php');
	?>
  
 <?php
	//get role	
	$url="http://".$baseurl."/salesforceapi/getRole";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	//curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $data=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$rowdata_role=json_decode($data);
	//print_r($rowdata);
	//die;
	
	//get designation
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$designation_string=json_encode($form_designation);
	$url="http://".$baseurl."/salesforceapi/getDesignation";
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
	 $designations=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$rowdata_designations=json_decode($designations);
	//print_r($rowdata_designations);
	//die;
	
		$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$data_string=json_encode($form_designation);
	$url="http://".$baseurl."/salesforceapi/getAllState";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                              		
	 $state=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$getState=json_decode($state);
	//print_r($rowdata);
	//die;
	?>  
  
  
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Team</a>
        </li>
        <li class="breadcrumb-item ">Create Team</li>
      </ol>
	   <!-----ddddddd--------->
	    <div class="container" >
			<div class="row abc">
				<div class="col-md-8" style="padding:0">
			<form method="POST" action="" name="create_team" id="create-team">
					
					<!--<label for="defaultFormLoginEmailEx" class="grey-text">First Name</label>-->
		<input type="hidden" id="distributerid"  name="distributerid" value="<?php echo $_SESSION['userData']['distributerId']?>" class="form-control">
					
					<div class="col-md-3">					
					<label for="defaultFormLoginEmailEx" class="grey-text">First Name*</label>
					<input type="text" id="fname"  name="fname"class="form-control">
					<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="first_name"></div>
					</div>
					
					<div class="col-md-3">
					<label for="defaultFormLoginEmailEx" class="grey-text">Last Name*</label>
					<input type="text" id="lname" name="lname" class="form-control">
					<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="last_name"></div>
					</div>
					
					<div class="col-md-3">
						<label for="defaultFormLoginEmailEx" class="grey-text">E-mail*</label>
						<input type="email" id="email" name="email" class="form-control">
						<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="email_id"></div>
					</div>
					<div class="col-md-3">
						<label for="defaultFormLoginEmailEx" class="grey-text">Mobile 1*</label>
						<input type="text" id="phone" name="phone" class="form-control">
						<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="phone_no"></div>
					</div>
					<div class="col-md-3">
						<label for="defaultFormLoginEmailEx" class="grey-text">Mobile 2</label>
						<input type="text" id="mobile" name="mobile" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="defaultFormLoginEmailEx" class="grey-text">Address*</label>
						<input type="text" id="address" name="address" class="form-control">
						<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="addresses"></div>
					</div>
					
					
					<div class="col-md-3">
						<label for="defaultFormLoginEmailEx" class="grey-text">Employee ID*</label>
						<input type="text" id="emp_id" name="emp_id" class="form-control">
						<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="employee_id"></div>
					</div>
					<div class="col-md-3">
						<label for="defaultFormLoginEmailEx" class="grey-text">Password*</label>
						<input type="password" id="password" name="password" class="form-control">
						<div style="font-size: 10px; display: none; width: 100%; float: left;     margin-top: -10px;" id="pass"></div>
					</div>
					<div class="col-md-3">
					<label for="defaultFormLoginEmailEx" class="grey-text">Date of Joining</label>
					<input type="date" id="doj" name="doj" class="form-control" placeholder="12/06/2018">
					</div>
					
					<div class="col-md-3">
						<label for="defaultFormLoginEmailEx" class="grey-text">Role</label>						
						<select class="form-control" name="role" id="role">
						<option>Select</option>
						<?php foreach($rowdata_role->lstCommnodetail as $value){
							if($value->name =='ASM'){?> 
							<?php $roleid=$value->id ;?>
							<option value="<?php echo $value->id;?>"<?php if($value->name == $value->id){ echo "selected";} ?>><?php echo $value->name; ?></option>
						<?php }}?>
							
						</select>
						
					</div>
					
					<div class="col-md-3">
						<label for="defaultFormLoginEmailEx" class="grey-text">Designation</label>
						<select class="form-control" name="designation" id="designation">
							<option>--Select--</option>
							<?php foreach($rowdata_designations->lstCommnodetail as $value){?>
							<option value="<?php echo $value->id;?>"><?php echo $value->name; ?></option>
							<?php }?>
							
						</select>
					</div>
					<div class="col-md-3">
						<label for="defaultFormLoginEmailEx" class="grey-text">State</label>
						<select class="form-control" name="state" id="state"> 
							<option>Select</option>
							<?php foreach($getState->lstCommnodetail as $value){?>
							<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
							<?php }?>
						</select>
					</div>
					<div class="col-md-3">
						<label for="defaultFormLoginEmailEx" class="grey-text">Report To</label>
						<select class="form-control" name="report" id="report">
							<option>Select</option>	
						
							<?php if(isset($_POST['role'])){
									$rid=$_POST['state'];?>
							<option value="<?php echo $value->id;?>"<?php if($value->name == $value->id){echo "selected";}?>><?php echo $value->name; ?></option>
							
							<?php } ?>
						</select>
					</div>
				
					<div class="col-md-12" style="overflow:hidden;">
						<button type="submit" class="add-btn new-btn" id="manager_team">Submit</button>
					</div>
					</form>
				</div>
			
				
				<div class="col-sm-4">
					<img src="images/profile.jpg" class="img-responsive">
				</div>
				
			</div>
		</div>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
$('#role').on('change', function () {
	var roleid=this.value;
	var distributerId=$('#distributerid').val();
	//alert(distributerid);
	if(roleid!=''){
			$.ajax({
				type: "POST",
				url: 'ajax.php',
				data: 'roleid='+roleid+'&distributerid='+distributerId+'&page=getManagers',
				success: function(res){								
					$('#report').html(res);
				}
			});
		}
	});
	
</script>
 <script type="text/javascript">
$('#manager_team').click(function(){
var fname=$.trim($('#fname').val());
var lname=$.trim($('#lname').val());
var email=$.trim($('#email').val());
var phone=$.trim($('#phone').val());
var address=$.trim($('#address').val());	
var employeeid=$.trim($('#emp_id').val());
var password=$.trim($('#password').val());

if(fname.length < 1){
$("#first_name").html("<p style='color:#FF0000;; text-align:left;'>Please Enter First Name</p>");
$("#first_name").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(lname.length < 1){
$("#last_name").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Last Name</p>");
$("#last_name").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(email.length < 1){
$("#email_id").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Email</p>");
$("#email_id").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(phone.length < 1){
$("#phone_no").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Phone</p>");
$("#phone_no").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(address.length < 1){
$("#addresses").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Address</p>");
$("#addresses").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(employeeid.length < 1){
$("#employee_id").html("<p style='color:#FF0000;; text-align:left;'>Please Enter EmployeeID</p>");
$("#employee_id").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
if(password.length < 1){
$("#pass").html("<p style='color:#FF0000;; text-align:left;'>Please Enter Password</p>");
$("#pass").fadeIn("fast", function() { $(this).delay(5000).fadeOut("slow"); });

return false;
}
});
$(document).ready(function(){
		$("#manager_team").click(function(){			
			var fname= $('#fname').val();
			var lname=$('#lname').val();
			var email= $('#email').val();
			var phone= $('#phone').val();
			var mobile= $('#mobile').val();
			var address= $('#address').val();
			var password= $('#password').val();
			var emp_id= $('#emp_id').val();
			var doj= $('#doj').val();
			var role= $('#role').val();
			var designation= $('#designation').val();
			var state= $('#state').val();
			var report= $('#report').val();
			var distributerId=$('#distributerid').val();
				$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'fname':fname,'lname':lname,'email':email,'phone':phone,'mobile':mobile,'address':address,'emp_id':emp_id,'doj':doj,'role':role,'designation':designation,'state':state,'report':report,'password':password,'distributerid':distributerId,'page':"create_team_all"},
					cache: false,
					success: function(managerdata){ 
					
						if(managerdata.statusCode == 0) {
							swal("Success",managerdata.message, "success");
								setTimeout(function(){
								 window.location.href='asm.php';
							}, 2000);
							}else {
								swal("Action failed",managerdata.message, "error");
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