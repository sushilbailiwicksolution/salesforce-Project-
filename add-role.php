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
        <li class="breadcrumb-item active">Manage Role</li>
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
		    if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[6]->add=='Y'){
				?>
				<div class="row" style="margin: 18px -15px;">
				<div class="col-md-4 add-form" style="padding:0px;">
					<form method="POST" action="" class="add-role" id="add_role">
				   <label>Role Name</label>
						<font color='red'> <span id="name_error" style='float:right;' ></span></font>
				   <input type="text" name="name" id="name" class="form-control">
				   <label>Description</label>
						<font color='red'> <span id="description_error" style='float:right;' ></span></font>				  
					<textarea class="form-control" rows="3" name="description"  id="description" style="resize:none;"></textarea>
					<!--<button class="add-btn add-margin" name="create" id="create">Create</button>-->
					</form>
			   </div>
		   </div>
				<?php
				
			}
		  ?>
			
	   
	<?php
		
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);			
		
	$url="http://".$baseurl."/salesforceapi/getRole";
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
	 $data=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$rowdata=json_decode($data);
	//print_r($rowdata);
	//die;
	?>
	
	
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
	    if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[6]->view=='Y'){
			?>
			<div class="row">	   
  <table class="table table-hover table-fixed"  style="border:1px solid #ddd; font-size:12px;" id="get_role" name="get-role">
    <thead>
      <tr>
        <th class="col-md-2">Role Name</th>
        <th class="col-md-6">Description</th>
		<!--<th class="col-md-2">Action</th>-->
      </tr>
    </thead>
    <tbody>
		<?php 
		
		foreach($rowdata->lstCommnodetail as $value){?>
	    <tr>		
			<td class="col-md-2"><?php echo $value->name;?></td>
			<td class="col-md-6"><?php echo $value->description; ?></td>
			<!--<td class="col-md-2"> 
			<!--<button type="button" class="btn btn-primary small-btn pull-right"  name="manager-edit" id="manager_edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<!--<button type="button" class="btn btn-danger small-btn" name="manager-delete" id="manager_delete"><i class="fa fa-times" aria-hidden="true"></i></button>--
			</td>-->
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
		$("#create").click(function(){			
			var name= $('#name').val();
			//alert(name);
			var description= $('#description').val();
				
				if (name == "")
					{ 
					$('#name_error').text("Requried");
//						  	
						return false; 
					}else if(description==""){
					$('#description_error').text("Requried");
					return false;
					}
					else{
					
						// Create Function
						CallAjaxToSave(name,description);
						}  	
					
				
				 return false;
			});
		});
		function CallAjaxToSave(name,description){
			$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'name':name,'description':description,'page':"add_role"},
					cache: false,
					success: function(output){ 
						if(output.statusCode == 0) {
							swal("Success",output.message, "success");
								setTimeout(function(){
								window.location.reload();
							}, 2000);
							}else {
								swal("Action failed",output.message, "error");
							}
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