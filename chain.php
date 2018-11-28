<?php
	 include ('header.php');
	 	//print_r($_POST); die;
	error_reporting(E_ERROR | E_PARSE);
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
	 $data=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$rowdataZone=json_decode($data);
		//print_r($getmanager);
	
	
	/***************************************GET MANAGER*******************************************************************/
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
	$getAllmanager=json_decode($manager);
	
	/**************************************************END GET MANAGER****************************************************/
	/*===========================================================GET RETAILER CATEGORY=============================================================*/
	$_SESSION['userData']['distributerId'];
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
	 $data=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	 //echo $data;

	//print_r($data);
	$rowdataCat=json_decode($data);
	//echo '<pre>';print_r($rowdataCat->lstRetailerDetailedData);
	/*===========================================================END GET RETAILER CATEGORY =========================================================*/
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
        <li class="breadcrumb-item active">Group</li>
		<div class="advance-tbtn" id="adv-s">Advance search</div>
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
	   
			<div class="row adv-s" id="show-search-box" style="display:none;">
				
			   <div class="col-md-2 pd-3">
					<select class="form-control" name="manager" id="manager">
						<option value="">Select Manager</option>
						<?php foreach($getAllmanager->lstMemberResponse as $value){ ?>
						<option value="<?php echo $value->employeeId;?>"><?php echo $value->employeeName;?></option>
						<?php }?>
						
					</select>
			   </div>
			  
			   <div class="col-md-2 pd-3">
					<select class="form-control" id="asm">
						<option value="">ASM</option>
						
					</select>
			   </div>
			   <div class="col-md-2 pd-3">
					<select class="form-control" id="tsm">
						<option value="">TSM</option>
						
					</select>
			   </div>
			   <div class="col-md-2 pd-3">
					<select class="form-control" id="sr">
						<option value="">SR</option>
						
					</select>
			   </div>
			    <div class="col-md-2 pd-3">
					<select class="form-control" id="cat">
						<option value="">Category</option>
						<?php
						  foreach($rowdataCat->lstRetailerDetailedData as $category){
							  ?>
							  <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
							  <?php
							  
						  }
						?>
						
					</select>
			   </div>
			   
			   <div class="col-sm-3" style="margin-top: 35px;">
				
					<select class="form-control" id="zoneID">
					<option value="">Zone</option>
						<?php
						foreach($rowdataZone->lstRetailerDetailedData as $zone){
							?>
							<option value="<?php echo $zone->id?>"><?php echo $zone->name?></option>
							<?php
							
						}
						?>
					</select>
			</div>
			
			 <div class="col-sm-3" style="margin-top: 35px;">
					<button type="button" class="btn-primary" id="group_search" placeholder="Search">Search</button>
			   </div>
			   
			    
			   
		   </div>
		  
            <?php
			if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[10]->download=='Y' && $rowdatapermissionValid->list[10]->add=='Y'){
				
				?>
				   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				<a href="export_all_retailersByzone.php"  id="ori_down">
				<button>Download CSV</button>
				</a>
				<button id="search_download" style="display:none;">Download CSV</button>
			   </div>
		   </div>
	   
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   <div class="col-md-7 pull-left" style="padding:0px;">
				<a href="add-chain.php" class="add-btn">Add Group</a>
				<a href="#" class="add-btn">Blacklist</a>
				
				</div>
				
    <div class="col-md-5 pull-left" style="padding:0px;">
     
        </span> 
           </div>       
			   </div>
			   <div class="col-md-4" style="padding:0px;">
			  
			   </div>
		   </div>
				<?php
				
			}else if($rowdatapermissionValid->list[10]->download=='Y' && $rowdatapermissionValid->list[10]->add=='N'){
				?>
				 <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				<a href="export_all_retailersByzone.php"  id="ori_down">
				<button>Download CSV</button>
				</a>
				<button id="search_download" style="display:none;">Download CSV</button>
			   </div>
		   </div>
				<?php
				
			}else if($rowdatapermissionValid->list[10]->download=='N' && $rowdatapermissionValid->list[10]->add=='Y'){
				?>
				 <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   <div class="col-md-7 pull-left" style="padding:0px;">
				<a href="add-chain.php" class="add-btn">Add Group</a>
				<a href="#" class="add-btn">Blacklist</a>
				
				</div>
				
    <div class="col-md-5 pull-left" style="padding:0px;">
     
        </span> 
           </div>       
			   </div>
			   <div class="col-md-4" style="padding:0px;">
			  
			   </div>
		   </div>
				<?php
				
			}
			?>
		  
		   
		   
	   <?php 
	 
$url="http://".$baseurl."/salesforceapi/getRetailer";
//Login Validation member wise all module
     if($_SESSION['userData']['roleId']=='1'){//admin login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'isSearch'=>'groupWise');
		}
		if($_SESSION['userData']['roleId']=='37'){//manager login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'isSearch'=>'groupWise','managerid'=>$_SESSION['userData']['employeeId']);
		}
		if($_SESSION['userData']['roleId']=='38'){//asm login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'isSearch'=>'groupWise','asmId'=>$_SESSION['userData']['employeeId']);
		}
		if($_SESSION['userData']['roleId']=='39'){//Tsm Login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'isSearch'=>'groupWise','tsmid'=>$_SESSION['userData']['employeeId']);
		}

$designation_string=json_encode($form_designation);
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
$option='';	
//$option="<option value=''>Report</option>";
$group=curl_exec($ch);
curl_close($ch);
//print_r($group);
$getGroup=json_decode($group);
//print_r($rowdata);
	   
	   ?>
	   <?php
	   if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[10]->view=='Y'){
		   ?>
		   <div class="row" id="show_retailer">	   
  <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
        <th style="width: 84px;">Name</th>
        <th>Group ExciseCode</th>
        <th>Email</th>
        <th>Mobile</th>
       <!-- <th>State</th>
        <th>No of Retailer</th> -->
		<th>SR</th>
      <?php
	  if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[10]->edit=='Y'){
		  ?>
		    <th>Action</th>  
		  <?php
		  
	  }
	  ?>
		
      </tr>
    </thead>
    <tbody>
	<?php	foreach($getGroup->lstRetailerRawData as $value){
		
				if($value->srName=="null"){
					$srName="NA";
				}else{
					$srName=$value->srName;
				}
		?>
	    <tr>
			<td><input type="checkbox" /></td>
			<td width='150px'>
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit&group=2"><?php echo $value->retailerName;?></a>
			</td>
			<td><?php echo $value->exciseCode;?></td>
			<td><?php echo $value->email;?></td>
			<td><?php echo $value->mobile;?></td>
			<!--<td><?php  echo $value->state;?></td>
			<td style="text-align:center;"><a href="#"><?php echo $value->typeName;?></a></td> -->
			<td><?php echo $srName;?></td>
			<!--<td><?php //echo $value->typeName;?></td>
			<td><?php //echo $value->subTypeName;?></td>
			<td><?php //echo $value->catogoryName;?></td>-->
			<!--<td><?php //echo $value->groupId;?></td>
			<td><?php //echo $value->groupName;?></td> 
			<td><?php //echo $value->;?></td>-->
			<?php
			if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[10]->edit=='Y'){
			   ?>
			   <td> 
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit">
			   <button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
			<button type="button" class="btn btn-danger small-btn" onclick="retailersDelete(<?php echo $value->retailerId;?>)"><i class="fa fa-times" aria-hidden="true"></i></button>
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
	<script>
	$(document).ready(function() {
			$('#example').DataTable();
		});
		
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

$('#group_search').on('click',function(){
	    var manager=$('#manager').val();
		var asm=$('#asm').val();
		var tsm=$('#tsm').val();
		var sr=$('#sr').val();
		var cat=$('#cat').val();
		let zoneID=$('#zoneID').val();
		$.ajax({
	    type:'POST',
        url:'ajax.php',
        data:{'manager':manager,'asm':asm,'tsm':tsm,'sr':sr,'cat':cat,'zoneID':zoneID,'page':'GetgroupBysearchparam'},
        async:false,
        success: function (res){
	    $('#ori_down').css('display','none');
		$('#search_download').css('display','block');
	    $('#show-search-box').css('display','none');
	    $('#show_retailer').html(res);	
	   }			
	   });
});

/**************************************************SEARCH ITEAM ONLY DOWNLOAD*****************************************************************/
$('#search_download').on('click',function(){        
        var manager=$('#manager').val();
		var asm=$('#asm').val();
		var tsm=$('#tsm').val();
		var sr=$('#sr').val();
		var cat=$('#cat').val();
		let zoneID=$('#zoneID').val();
	
    self.location.href="search_export_all_retailersByZone.php?manager="+manager+'&asm='+asm+'&tsm='+tsm+'&cat='+cat+'&sr='+sr+'&zoneId='+zoneID;
});
/***************************************************END ADVANCE SEARCH DOWNLOAD ***************************************************************/
/********************************************DELETE RETAILER******************************************************/
function retailersDelete(retailerId){
	let c=confirm('Do you want to block Retailer');
	
	if(c==true){
	$.ajax({
	type:'POST',
    url:'ajax.php',
	dataType:'json',
    data:{'retailerId':retailerId,'page':'block_member'},
    async:false,
    success:function(res){
		if(res.statusCode == 0) {
							swal("Success",res.message, "success");
								setTimeout(function(){
								  window.location.href='retailers.php';
								}, 2000);								
							}else {
								swal("Action failed",res.message, "error");
								}
		
		
	}	
	});
   
	
}
}	
/*******************************************END DELETE RETAILER****************************************************/
</script>
	
    <?php
	 include ('footer.php');
	?>