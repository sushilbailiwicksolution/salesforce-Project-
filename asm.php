<?php
	 include ('header.php');
	// print_r($_SESSION);
	 $form_designation=array('roleId'=>'37','distributerId'=>$_SESSION['userData']['distributerId'],'employeeId'=>$_SESSION['userData']['employeeId']);
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
        <li class="breadcrumb-item active">Assistant Sales Manager</li>
		<div class="advance-tbtn" id="adv-s">Advance search</div>
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
	   
			<div class="row adv-s" id="show-search-box" style="display:none;">
				
			   <div class="col-md-2 pd-3">
					<select class="form-control" name="manager" id="manager">
						<option value="">Select Manager</option>
						<?php foreach($getmanager->lstMemberResponse as $value){ ?>
						<option value="<?php echo $value->employeeId;?>"><?php echo $value->employeeName;?></option>
						<?php }?>
						
					</select>

			   </div>
			   
			   
			   <div class="col-md-2">
					<button type="button"  id="asm_search" class="Adv-search-btn" placeholder="Search">Search</button>
			   </div>
		   </div>
             <?php
			  if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[2]->download=='Y' && $rowdatapermissionValid->list[2]->add=='Y'){
				  ?>
				   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				<a href="export_all_asm.php" id="ori_down"><button>Download CSV</button></a>
				<button id="search_download" style="display:none;">Download CSV</button>
				<!--<button>Upload CSV</button>-->
			   </div>
		   </div>
	   
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   <a href="create-team-asm.php" class="add-btn">Add ASM</a>
			   </div>
			   <div class="col-md-4" style="padding:0px;">
			   
			   </div>
		   </div>
				  <?php
			  }else if($rowdatapermissionValid->list[2]->download=='Y' && $rowdatapermissionValid->list[2]->add=='N'){
				  ?>
				 
				   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				<a href="export_all_asm.php" id="ori_down"><button>Download CSV</button></a>
				<button id="search_download" style="display:none;">Download CSV</button>
				<!--<button>Upload CSV</button>-->
			   </div>
		   </div>
				  <?php
				  
			  }else if($rowdatapermissionValid->list[2]->add=='Y' && $rowdatapermissionValid->list[2]->download=='N'){
				  ?>
				   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   <a href="create-team-asm.php" class="add-btn">Add ASM</a>
			   </div>
			   <div class="col-md-4" style="padding:0px;">
			   
			   </div>
		   </div>
				  <?php
				  
			  }
			 ?>     
		  
	   <?php 
			extract($_POST);
	//print_r($_POST); die;
	
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
	//echo '<pre>';print_r($getasm);die;
	   ?>
	   <?php
	    if($rowdatapermissionValid->list[2]->view=='Y'){
			?>
			<div class="row" id="show_box">	   
  <table class="table table-hover" style="border:1px solid #ddd; font-size:12px;" id="example">
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
        <th>City</th>
		<?php
		if($_SESSION['userData']['roleId']=='1'){
			?>
			<th>Action</th>
			<?php
			
		}else if($rowdatapermissionValid->list[2]->edit=='Y'){
		   ?>
		   <th>Action</th>
           <?php		   
		}
		?>
		
      </tr>
    </thead>
    <tbody>
	<?php foreach($getasm->lstMemberResponse as $value){ ?>
	    <tr>
			<td>&nbsp;</td>			
			<td><a href="profile_asm.php?empid=<?php echo $value->employeeId; ?>"><?php echo $value->employeeName;?></a></td>
			<td><?php echo $value->empId;?></td>
			<td><?php echo $value->designationname;?></td>
			<?php 
			//manage self reporting prince		
	
			$mycheck = $value->reportTo;
			if($mycheck==-5) {
			$mycheck=	$value->employeeId;
			}?>

			
			<td><a href="profile_asm.php?empid=<?php echo $mycheck;?>"><?php echo $value->reportToName;?></td>
			<td><?php echo $value->emailId;?></td>
			<td><?php echo $value->mobile;?></td>
			<td><?php echo $value->joiningDate;?></td>
			<td><a href="retailers.php?retailerid=<?php echo $value->employeeId;?>"><?php echo $value->retailerCount;?></td>
			<td><?php echo $value->state;?></td>
			<?php
			 if($_SESSION['userData']['roleId']=='1'){
				 ?>
				  <td> 
			<a href="profile_asm.php?empid=<?php echo $value->employeeId; ?>"><button type="button" class="btn btn-primary small-btn" id="edit_member"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<button type="button" class="btn btn-danger small-btn" onclick="memberDelete(<?= $value->employeeId;?>)";><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
				 <?php
				 
			 }
			 else if($rowdatapermissionValid->list[2]->edit=='Y'){
				 ?>
				 <td> 
			<a href="profile_asm.php?empid=<?php echo $value->employeeId; ?>"><button type="button" class="btn btn-primary small-btn" id="edit_member"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<button type="button" class="btn btn-danger small-btn" onclick="memberDelete(<?= $value->employeeId;?>)";><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
				 <?php
			 }
			?>
			
		</tr>
	<?php }?>
		
    </tbody>
    </tbody>
  </table>
</div>
			<?php
			
		}
	   ?>

	</div>
	</div>
	<script>
	
	$(document).ready(function() {
		$('#example').DataTable();
	});
	
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
								 window.location.href='asm.php';
							}, 2000);
							}else {
								swal("Action failed", "To delete this member first assign the team members to others.", "error");
							}
					}
				});
					
				} 
			});
		}
		/****************************************************ADVANCE SEARCH OF ASM************************************************/
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

$('#asm_search').on('click',function(){
	    let roleId='';
	    let manager=$('#manager').val();
		
		//alert(manager);
		
		if(manager!=""){
			 roleId='38';
			 
			
		}
		
		//alert(manager+'-'+asm+'-'+tsm+'role-'+roleId);
		$.ajax({
	    type:'POST',
        url:'ajax.php',
        data:{'manager':manager,'roleId':roleId,'page':'GetasmBysearchparam'},
        async:false,
        success: function (res){
		$('#ori_down').css('display','none');
        $('#search_download').css('display','block');
	    $('#show-search-box').css('display','none');
	    $('#show_box').html(res);	
	   }			
	   });
});

/******************************************************END ADVANCE SEARCH**************************************************/

/**************************************************SEARCH ITEAM ONLY DOWNLOAD*****************************************************************/
$('#search_download').on('click',function(){        
        let roleId='';
	    let manager=$('#manager').val();
		//alert(manager);
		if(manager!=""){
			 roleId='38';
		} 
		
    self.location.href="search_export_all_asm.php?manager="+manager+'&roleId='+roleId;
});
/***************************************************END ADVANCE SEARCH DOWNLOAD ***************************************************************/
	</script>
   
    <?php
	 include ('footer.php');
	?>