<?php
	 include ('header.php');
	?>
  
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  
 <?php if(!empty($_GET['designation'])){?>
             <script>
			  var designation="<?php echo $_GET['designation']; ?>";
			 </script>
							
		<?php } ?>
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Team</a>
        </li>
        <li class="breadcrumb-item active">Manage Designation</li>
		<!--div class="advance-tbtn" id="adv-s">Advance search</div-->
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >

		   <!--div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				<button>Download CSV</button>
				<button>Upload CSV</button>
			   </div>
		   </div-->
	   
		   <!--div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   <a href="create-team.php" class="add-btn" >Add Manager</a>
			   </div>
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
		   </div-->
		   
			<?php 
				//echo 'kkkkkkk-'.$_SESSION['userData']['distributerId'];
		@$desginationID=$_GET['designation'];
				//echo $_GET['designation'];
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);			
		
	$url="http://".$baseurl."/salesforceapi/getDesignation";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                                                 		
	 $designations=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$rowdata=json_decode($designations);
	//print_r($rowdata);
	//die;
	if(!empty($desginationID)){
	foreach($rowdata->lstCommnodetail as $designationdata){
		if($designationdata->id==$desginationID){
			if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[7]->edit=='Y'){
				?>
			
			 <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
				<form method="POST" action="" class="update-designation">
				   <label>Designation Name</label>
				<font color='red'> <span id="name_error" style='float:right;' ></span></font>
				<input type="text" name="name" id="designation_name" class="form-control"  value="<?php echo  $designationdata->name;?>"><span class="error_form"></span>
				   <label>Description</label>
				   <font color='red'> <span id="description_error" style='float:right;' ></span></font>
				   <textarea class="form-control" rows="3" name="description" id="designation_description" style="resize:none;"><?php echo  $designationdata->description;?></textarea><span class="error_form"></span>
				   <label>Status</label>
				   <Select class="form-control" name="status" id="status" >
						<option value="1" <?php ($designationdata->status==1)?'checked':''?>> Active</option>
						<option value="2" <?php ($designationdata->status==2)?'checked':''?>>Inactive</option>
				   </select>
				   
					<button type="button" class="add-btn add-margin"  id="update_desi">Update</button>
				</form>
			   </div>
		     </div>
	<?php 		
			}
			
		}
	  }
	}else{
		 if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[7]->add=='Y'){
			?>
		       <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
				<form method="POST" action="" class="add-designation" id="add_designation">
				   <label>Designation Name</label>
				<font color='red'> <span id="name_error" style='float:right;' ></span></font>
				<input type="text" name="name" id="designation_name" class="form-control" onchange="myvalidate(this);" value="<?= !empty($designation)?>"><span class="error_form"></span>
				   <label>Description</label>
				   <font color='red'> <span id="description_error" style='float:right;' ></span></font>
				   <textarea class="form-control" rows="3" name="description" id="designation_description"  style="resize:none;"></textarea><span class="error_form"></span>
					<button class="add-btn add-margin"  name="create" id="create_designation">Create</button>
				</form>
			   </div>
		     </div>
	<?php  
		 }
		  } ?>
	<style>
	.table-fixed tbody {
height: 200px;
overflow-y: auto;
width: 100% !important;
}
.table-fixed thead,
.table-fixed tbody,
.table-fixed tr,
.table-fixed td,
.table-fixed th div {
display: block;

}
.table-fixed tr:after {
content: "";
display: block;
visibility: hidden;
clear: both;
}
.table-fixed tbody td,
.table-fixed thead > tr > th {
float: left;
}
.table-fixed tbody td, .table-fixed thead > tr > th {
    float: left;
    height: 40px;
}


	
	</style>
	<?php
	if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[7]->view=='Y'){
		?>
		<div class="row">	   
  <table class="table table-hover table-fixed" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th class="col-md-3">Designation Name</th>
        <th class="col-md-6">Description</th>
		<?php
		if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[7]->edit=='Y'){
			?>
			<th class="col-md-3">Action</th>
			<?php
		}
		?>
		
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdata->lstCommnodetail as $value){
		?>
	    <tr>
			<td class="col-md-3"><?php echo $value->name;?></td>
			<td class="col-md-6"><?php echo $value->description;?></td>
			<?php
			if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[7]->edit=='Y'){
				?>
				<td class="col-md-3"> 
			<a href="add-designation.php?designation=<?php echo $value->id; ?>"><button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<button type="button" class="btn btn-dallnger small-btn" onclick="designationDelete(<?= $value->id;?>)";><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
				<?php
			}
			?>
			
		</tr>
	<?php }?>
		
    </tbody>
  </table>
</div>
		<?php
	}
	?>

	</div>
	</div>
	
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script>
	$(document).ready(function(){		
		$("#create_designation").click(function(){
			var nm= $('#designation_name').val();
			//alert(nm);
			var des= $('#designation_description').val();
			//alert(des);
			if(nm==""){
					$('#name_error').text("Requried");
					return false;
				}else if(des==""){
					$('#description_error').text("Requried");
					return false;
				}else{
					CallAjaxToSave(nm,des);
				}
			
				
				 return false;
			});
		});
		function CallAjaxToSave(nm,des){
			$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'name':nm,'description':des,'page':"add_designation"},
					cache: false,
					success: function(designation){
						//alert(designation);
						//console.log(designation);
						if(designation.statusCode == 0) {
							swal("Success",designation.message, "success");
							setTimeout(function(){
							  window.location.reload();
							}, 2000);
							
								//$('.add-designation')[1].reset(); 
							}else {
								swal("Action failed",designation.message, "error");
							}
					}
				});
		}
		
		
		function designationDelete(id){
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
					 data:{'designationid':id,'page':"delete_designation"},
					cache: false,
					success: function(data){ 
					console.log(data);
					if(data.statusCode == 0) {
							swal("Success",data.message, "success");
								setTimeout(function(){
								 window.location.reload();
							}, 2000);
							}else {
								swal("Action failed", "To delete this member first assign the team members to others.", "error");
							}
					}
				});
					
				} 
			});
		}
		
		$("#update_desi").click(function(){
			var designation_name= $('#designation_name').val();
			var designation_description= $('#designation_description').val();
			var status=$('#status').val();
			
			$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'name':designation_name,'description':designation_description,'status':status,'desgination_id':designation,
					 'page':"update_designation"},
					cache: false,
					success: function(data){
						console.log(data);
						if(data.statusCode == 0) {
							swal("Success",data.message, "success");
								setTimeout(function(){
								self.location.href="add-designation.php";
							}, 2000);
							}else {
								swal("Action failed",data.message, "error");
							}
					}
				}); 
			});
			
			
   </script>
   
   
    <?php
	 include ('footer.php');
	?>