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
          <a href="#">Team</a>
        </li>
        <li class="breadcrumb-item active">All In Active Members List</li>
		<!--div class="advance-tbtn" id="adv-s">Advance search</div-->
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
		   </div-->
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   
		   </div>
	   
		   <!--<div class="row" style="margin: 18px -15px;">
			   
			   <div class="col-md-4" style="padding:0px;">
			   <div class="input-group">
					  <input class="form-control" type="text" placeholder="Search by Name / Mobile / Email">
					  <span class="input-group-append">
						<button class="btn btn-primary" type="button">
						  <i class="fa fa-search"></i>
						</button>
					  </span>
					</div>
			   </div>
		   </div>-->
	   
	   <?php 
		extract($_POST);
	//print_r($_POST); die;
	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'operationtype'=>'inActive','employeeId'=>$_SESSION['userData']['employeeId']);
	
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
	$option="<option value=''> Select Asm</option>";
	//$option.="<option value='1'>ADMIN</option>";
	$manager=curl_exec($ch);
	curl_close($ch);
	//print_r($manager);
	$getmanager=json_decode($manager);
	//echo '<pre>';print_r($getmanager->lstMemberResponse);
	
	   ?>
	   <?php
	    if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[5]->view=='Y'){
			?>
			<div class="row">	   
  <table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td>&nbsp;</td>
        <th>Name</th>
        <th>Emp-Id</th>
        <th>Designation</th>
		<th>Report to </th>
		<th>Email</th>
        <th>Mobile</th>
		<th>Joining Date</th>
		<th>Retailer</th>
        <th>Status</th>
		<?php
		 if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[5]->edit=='Y'){
			?>
			<th>Action</th>
            <?php			
		 }
		?>
		
      </tr>
    </thead>
    <tbody>
	<?php foreach($getmanager->lstMemberResponse as $value){ 
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
	
	?>
	    <tr>
			<td>&nbsp;</td>			
			<td><a href="<?php echo $sendUrl;?>?empid=<?php echo $value->employeeId; ?>"><?php echo $value->employeeName;?></a></td>
			<td><?php echo $value->empId;?></td>
			<td><?php echo $value->designationname;?></td>
			
			
			<?php 
			//manage self reporting prince		
		
			$mycheck = $value->reportTo;
			if($mycheck==-5) {
			$mycheck=	$value->employeeId;
			}
			
			if($value->reportToName=='null'){
				$reportto="NA";
			}else{
				$reportto=$value->reportToName;
			}
			?>
			
			
			<td><a href="profile_managers.php?empid=<?php echo $mycheck;?>"><?php echo $reportto;?></td>
			<td><?php echo $value->emailId;?></td>
			<td><?php echo $value->mobile;?></td>
			<td><?php echo $value->joiningDate;?></td>
			
			
			<td><a href="retailers.php?retailerid=<?php echo $value->employeeId;?>"><?php echo $value->retailerCount;?></td>
			<td><?php if($value->status=='2'){ echo 'In Active';} else{ echo 'Active';}?></td>
			<?php
			  if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[5]->edit=='Y'){
				  ?>
				  <td> 
			<a href="profile_managers.php?empid=<?php echo $value->employeeId;?>"><button type="button" class="btn btn-primary small-btn" id="edit_member"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<button type="button" class="btn btn-danger small-btn" onclick="memberDelete(<?= $value->employeeId;?>)";><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
				  <?php
			  }
			?>
			
		</tr>
	<?php }?>
		
    </tbody>
  </table>
</div>
	</div>
	</div>
			<?php
			
		}
	   ?>

	<script>
	
		function memberDelete(id){
			//alert(id);
			swal({
				title: "Are you sure?",
				text: "You Want to Delete this Member.?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete){
					
					$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'employeeid':id,'page':"delete_member"},
					cache: false,
					success: function(data){ 
					console.log(data);
					if(data.statusCode == 0) {
							swal("Success",data.message, "success");
								setTimeout(function(){
								 window.location.href='managers.php';
							}, 2000);
							}else {
								swal("Action failed", "To delete this member first assign the team members to others.", "error");
							}
					}
				});
					
				} 
			});
			
			
			
		}
		
		$(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
    <?php
	 include ('footer.php'); 
	?>