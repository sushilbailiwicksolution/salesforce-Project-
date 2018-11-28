<?php
	 include ('header.php');
	 error_reporting(E_ERROR | E_PARSE);
	 $form_designation=array('roleId'=>'37','distributerId'=>$_SESSION['userData']['distributerId']
);
		$designation_string=json_encode($form_designation);
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
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Routes</a>
        </li>
        <li class="breadcrumb-item active">All Routes</li>
		<a href="routes-create-assign.php" class="advance-tbtn" style="right: 130px;">Create Route</a>
		<div class="advance-tbtn" id="adv-s">Advance search</div>
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
			
			<div class="row adv-s" id="show-search-box" style="display:none;">
				<div class="col-md-2 pd-3">
					 <select class="form-control" id="manager1">
					<option value="">Select Manager</option>
					<?php foreach($getmanager->lstMemberResponse as $value){ ?>
					<option value="<?php echo $value->employeeId;?>"><?php echo $value->employeeName;?></option>
					<?php }?>
				  </select>
			   </div>
			   
			   <div class="col-md-2 pd-3">
					<select class="form-control" id="asm1">
						<option value="">ASM</option>
					</select>
			   </div>
			   <div class="col-md-2 pd-3">
					<select class="form-control" id="tsm1">
						<option value="">TSM</option>
					</select>
			   </div>
			   <div class="col-md-2 pd-3">
					<select class="form-control" id="route_namelist">
						<option value="">SR</option>
					</select>
			   </div>
			   <div class="col-md-2">
					<button type="submit" class="Adv-search-btn" id="Adv-search-btn" placeholder="Search">Search</button>
			   </div>
		   </div>

		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				<a href="export-allroute.php" id="ori_down"><button>Download CSV</button></a>
				<button id="search_download" style="display:none;">Download CSV</button>
				
			   </div>
		   </div>
	   
		   <div class="row" style="margin: 18px -15px;">
			   <!--<div class="col-md-8" style="padding:0px;">
			   <button class="add-btn">Delete Route</button>
			   </div>-->
			   <div class="col-md-4" style="padding:0px;">
			   
			   </div>
		   </div>
	   
	   
<div class="row" id="route_data">	   
  <table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		
        
        <th>Route Name </th>
        <th>No. Retailer on Route</th>
		<th>Representative Name</th>
        
		<th>Phone no.</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	    <?php
	if($_SESSION['userData']['roleId']=='1'){//admin login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
		}
		if($_SESSION['userData']['roleId']=='37'){//manager login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'managerid'=>$_SESSION['userData']['employeeId']);
		}
		if($_SESSION['userData']['roleId']=='38'){//asm login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'asmId'=>$_SESSION['userData']['employeeId']);
		}
		if($_SESSION['userData']['roleId']=='39'){//Tsm Login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'tsmid'=>$_SESSION['userData']['employeeId']);
		}
	
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getAllRoute";
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
	
	$data=curl_exec($ch);
	curl_close($ch);
	//print_r($manager);
	$getroute=json_decode($data);
	//echo '<pre>';print_r($getroute->routelist);
	
	?>
		<?php 	foreach($getroute->routelist as $value){ ?>
		<tr>
			
			
			<td><?php echo $value->routeName;?></td>
			<td><?php echo $value->countRetailer; ?></td>

			<td><?php echo $value->managerName;?></td>
			
			<td><?php echo $value->contactNumber;?></td>
			<td> 
			
			<button type="button" class="btn btn-success small-btn"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
			<a href="update-route.php?route_id=<?php echo $value->routeId;?>"><button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<!--<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>-->
			</td>
		</tr>
		<?php  } ?>
    </tbody>
  </table>
</div>
	</div>
	</div>
	<script>
	  $(document).ready(function() {
			$('#example').DataTable();
		});
		
		$('#manager1').on('change', function () {
	$('.loader-img').css('display','block');
	$('.loader-img').css('top','69%');
	var managerid=this.value;
	if(managerid!=''){
			$.ajax({
				type: "GET",
				url: 'ajax.php',
				data: 'managerid='+managerid+'&page=getAsmteam&req=2',
				success: function(res){
                    	$('.loader-img').css('display','none');				
                    console.log(res);				
					$('#asm1').html(res);
					$('#asm1').prop('disabled',false);
				}
			});
		}
	});
	
$('#asm1').on('change', function () {
	$('.loader-img').css('display','block');
	$('.loader-img').css('top','69%');
	var asmid=this.value;
	if(asmid!=''){
			$.ajax({
				type: "GET",
				url: 'ajax.php',
				data: 'asmid='+asmid+'&page=gettsmteam&req=3',
				success: function(res){	
				$('.loader-img').css('display','none');
                    console.log(res);
					$('#tsm1').html(res);
					$('#tsm1').prop('disabled',false);
					$('#asm1').prop('disabled',false);
				}
			});
		}
});

$('#tsm1').on('change', function () {
	$('.loader-img').css('display','block');
	$('.loader-img').css('top','69%');
	var tsmid=this.value;
	//alert(tsmid);
	var managerId=$('#manager').val();
	var asmId=$('#asm').val();
	if(tsmid!=''){
			$.ajax({
				type: "GET",
				url: 'ajax.php',
				data:{'tsmid':tsmid,'page':"getrouteName"},
				success: function(res){	
				$('.loader-img').css('display','none');
                    console.log(res);				
					$('#route_namelist').html(res);
					//$('#sr1').prop('disabled',false);
					//$('#route_name').prop('disabled',false);
					//$('#tsm1').prop('disabled',false);
				}
			});
		}
});

$('#sr1').on('change', function () {
	var srid=this.value;
	if(srid!=''){
			$('#sr1').prop('disabled',false);
		}
}); 

/******************************************GET getAllRoute ADVANCE SEARCH************************************************************/
$('#Adv-search-btn').on('click',function(){
	let manager1=$('#manager1').val();
	let asm1=$('#asm1').val();
	let tsm1=$('#tsm1').val();
	let sr1=$('#route_namelist').val();
	//alert(sr1);
    $.ajax({
	type:'POST',
    url:'ajax.php',
    data:{'manager':manager1,'asm':asm1,'tsm':tsm1,'sr':sr1,'page':'getallRouteadevanceSearch'},
    success: function(res){
		
	$('#route_data').html(res);	
	$('#ori_down').css('display','none');
	$('#search_download').css('display','block');
	}	
	});
	
});

/**************************************************SEARCH ITEAM ONLY DOWNLOAD*****************************************************************/
$('#search_download').on('click',function(){        
    let manager1=$('#manager1').val();
	let asm1=$('#asm1').val();
	let tsm1=$('#tsm1').val();
	let sr1=$('#route_namelist').val();
	
    self.location.href="search-export-route.php?manager="+manager1+'&asm='+asm1+'&tsm='+tsm1+'&sr='+sr1;
});
/***************************************************END ADVANCE SEARCH DOWNLOAD ***************************************************************/
/******************************************************END GET getAllRoute************************************************************/
	</script>
    <?php
	 include ('footer.php');
	?>