	<?php
	 include ('header.php');
	?>

 
  
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Team</a>
        </li>
        <li class="breadcrumb-item active">All Members</li>
		<div class="advance-tbtn" id="adv-s">Advance search</div>
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
	   <div class="row adv-s" id="show-search-box" style="display:none;">
				 <?php 
		extract($_POST);
	//print_r($_POST); die;
	$form_designation=array('roleId'=>'37','distributerId'=>'1');
	
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://103.206.248.235:8080/salesforceapi/getTeamByRole";
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
	   ?>
			   <div class="col-md-2 pd-3">
					<select class="form-control" name="manager" id="manager">
						<option>Select Manager</option>
						<?php foreach($getmanager->lstMemberResponse as $value){ ?>
						<option value="<?php echo $value->employeeId;?>"><?php echo $value->employeeName;?></option>
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
			   <div class="col-md-2 pd-3">
					<select class="form-control" name="asm" id="asm">
						<option>Select ASM</option>							
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
			   <div class="col-md-2 pd-3">
					<select class="form-control" name="tsm" id="tsm">
					<option>Select TSM</option>	
						<?php if(isset($_POST['asm'])){
									?>
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
					$('#sr').html(res);
				}
			});
		}
});
</script>
			   <div class="col-md-2 pd-3">
					<select class="form-control" name="sr" id="sr">
						<option>Select SR</option>	
						<?php if(isset($_POST['tsm'])){
						?>
							<option value="<?php echo $value->employeeId;?>"<?php if($value->employeeName == $value->employeeId){echo "selected";}?>><?php echo $value->employeeName; ?></option>
								<?php }?>
					</select>
			   </div>
			   <div class="col-md-2">
					<button type="submit" class="Adv-search-btn" id="member_search" placeholder="Search">Search</button>
			   </div>
		   </div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		/*$(document).ready(function(){
			$("#member_search").click(function(){
				
			)};
		)};*/
	</script>
		    <div class="row" style="margin: 18px -15px;"> 
			   <div class="col-md-4" style="padding:0px;">
				  <div class="input-group" style="">
					  <input class="form-control" type="text" placeholder="Search by Name / Mobile / Email">
					  <span class="input-group-append">
						<button class="btn btn-primary" type="button">
						  <i class="fa fa-search"></i>
						</button>
					  </span>
					</div>
			   </div>
			   <div class="col-md-8 csv" style="padding:0px;">
				 <a href="export_all_members.php"><button>Download CSV</button></a>
				<form method="post" action="import_members.php" enctype="multipart/form-data">
				      <a href="vendor/csv/members_upload.csv" style="padding-left:127px;">sample.csv </a>
				      <input type='file' name="importfile" id="importfile" required>
				    <button name="but_import" id="but_import">Upload CSV</button>
				</form>
			   </div>
		   </div>
	   
	 
	    <?php
		
	$url="http://103.206.248.235.:8080/salesforceapi/getAllMemberBYDistributerId";
	
	$form_designation=array('id'=>'1');
	$designation_string=json_encode($form_designation);
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
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
	   
	   
<div class="row">	   
  <table class="table table-hover" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		
        <th>Name</th>
        <th>Emp-Role-Id</th>
        <th>Role Name</th>
		<th>Email</th>
        <th>Mobile</th>
		<th>Reports To</th>
        <th>Designation</th>
		<th>Retailer</th>
        <th>City</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdata->lstMemberResponse as $value){?>
	    <tr>
			
				<?php 
			//manage self reporting prince		
		
			$sendUrl; 
			$rollid =$value->roleId;
			if($rollid==1) {
			$sendUrl = "profile_managers.php";
			}else if($rollid==37){
				$sendUrl="profile_managers.php";
			}else if($rollid==38){
				$sendUrl="profile_asm.php";
			}else if($rollid==39){
				$sendUrl="profile_tsm.php";
			}else if($rollid==40){
				$sendUrl="profile_sr.php";
			}
			//echo $sendUrl;
			//echo $employeeId=$value->employeeId;
				?>
		
		
			<td><a href="<?php echo $sendUrl?>?empid=<?php echo $value->employeeId;?>"><?php echo $value->employeeName;?></td>
			<td><?php echo $value->empId;?></td>
			<td><?php echo $value->roleName;?></td>
			<td><?php echo $value->emailId;?></td>
			<td><?php echo $value->mobile;?></td>

			
				<?php 
			//manage self reporting prince		
		
			$sendUrl1; 
			$rollid =$value->roleId;
			if($rollid==1) {
			$sendUrl1 = "profile_managers.php";
			}else if($rollid==37){
				$sendUrl1="profile_managers.php";
			}else if($rollid==38){
				$sendUrl1="profile_managers.php";
			}else if($rollid==39){
				$sendUrl1="profile_asm.php";
			}else if($rollid==40){
				$sendUrl1="profile_tsm.php";
			}
			$sendUrl1;
			 $employeeId=$value->employeeId;
						$mycheck = $value->reportTo;
			if($mycheck==-5) {
			$mycheck=	$value->employeeId;
			}
			?>
		
			<td><a href="<?php echo $sendUrl1?>?empid=<?php echo $mycheck;?>"><?php echo $value->reportToName;?></td>
			<td><?php echo $value->designationname;?></td>
			<td><a href="retailers.php?retailerid=<?= $value->employeeId; ?>"><?php echo $value->retailerCount;?></td>
			<td><?php echo $value->state;?></td>
			<td> 
			<a href="profile.php?empid=<?php echo base64_encode($value->employeeId);?>&rolid=<?php echo  base64_encode($value->roleId);?>&source=edit"><button type="button" class="btn btn-primary small-btn" id="edit_member"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<!--<button type="button" class="btn btn-danger small-btn" onclick="memberdelete('<?//= $value->employeeId; ?>');"><i class="fa fa-times" aria-hidden="true"></i></button>-->
			</td>
		</tr>
	<?php }?>
    </tbody>
  </table>
</div>
	</div>
	</div>
    <?php
	 include ('footer.php');
	?>