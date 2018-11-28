<?php
	 include ('header.php');
	 
	 
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
	//print_r($rowdataZone->lstRetailerDetailedData);
	//die;
	/*========================================================GET MANAGER DETAILS===========================================================*/
	$form_manager=array('roleId'=>'37','distributerId'=>$_SESSION['userData']['distributerId'],'employeeId'=>$_SESSION['userData']['employeeId']);
	$url="http://".$baseurl."/salesforceapi/getTeamByRole";	
	$manager_string=json_encode($form_manager);
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$manager_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$manager=curl_exec($ch);
	curl_close($ch);
	$getman=json_decode($manager);
	/*==========================================================END GET MANAGER DETAILS======================================================*/
	/*==========================================================GET RETAILER TYPE================================================================*/
      $_SESSION['userData']['distributerId'];
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
	 $data=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$rowdata=json_decode($data);
	//echo '<pre>';print_r($rowdata->lstRetailerDetailedData);
	/*===========================================================END RETAILER TYPE================================================================*/
	/*===========================================================GET RETAILER SUB TYPE============================================================*/
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
	 $data=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	//print_r($data);
	$rowdataSubtype=json_decode($data);
	//echo '<pre>';print_r($rowdataSubtype);
	/*===========================================================END RETAILER SUB TYPE=============================================================*/
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
	//Gat Asm List
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
	$getasm=json_decode($asm);
	//print_r($getasm);
// If tsm Login Then
     if($_SESSION['userData']['roleId']=='39'){
		 $form_designation=array('roleId'=>'39','distributerId'=>$_SESSION['userData']['distributerId'],'employeeId'=>$_SESSION['userData']['employeeId']);
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
	
	$tsm=curl_exec($ch);
	curl_close($ch);
	//print_r($manager);
	$gettsm=json_decode($tsm);
		 
	 }
	/*===========================================================END GET RETAILER CATEGORY =========================================================*/
	if($_SESSION['userData']['roleId']=='40'){
		$form_designation=array('roleId'=>'40','distributerId'=>$_SESSION['userData']['distributerId'],'employeeId'=>$_SESSION['userData']['employeeId']);
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
	 
	$sr=curl_exec($ch);
	curl_close($ch);
	//print_r($sr);
	$getsr=json_decode($sr);
	}
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
        <li class="breadcrumb-item active">Blocklist</li>
		<div class="advance-tbtn" id="adv-s">Advance search</div>
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
			<div class="row adv-s" id="show-search-box" style="display:none;"><!--RETAILER TYPE-->
			<div class="col-md-12">
			<p style="margin-bottom:10px;"> Retailer</p>
			<div class="col-md-3 pd-3">
					<select class="form-control" id="type">
					<option value="">Type</option>
					<?php
					 foreach($rowdata->lstRetailerDetailedData as $retailerType){
						 ?>
						 <option value="<?php echo $retailerType->id;?>"><?php echo $retailerType->name;?></option>
						 <?php
						 
					 }
					?>
					</select>
			</div>
			   <div class="col-md-3 pd-3">
					<select class="form-control" id="subtype">
						<option value="">Subtype</option>
						<?php
						 foreach($rowdataSubtype->lstRetailerDetailedData as $retailerSubType){
							 ?>
							 <option value="<?php echo $retailerSubType->id;?>"><?php echo $retailerSubType->name;?></option>
							 <?php
							 
						 }
						?>
					</select>
			   </div>
			   <div class="col-md-3 pd-3">
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
			
			</div>	   
			   <!--TEAM SEARCH-->
			   <div class="col-md-12">
			<p style="margin-bottom:10px;"> Team</p>
			
			<div class="col-md-3 pd-3">
					<select class="form-control" name="manager" id="manager"> 
							<option value="">Select Manager </option>
							
							<?php 					
								foreach($getman->lstMemberResponse as $memberList){?>
									<option value="<?php echo $memberList->employeeId;?>"><?php echo $memberList->employeeName;?></option>
							<?php }?>
						</select>
			   </div>
			
			<div class="col-md-3 pd-3">
					<select class="form-control" name="asm" id="asm"> 
						<option value="">Select ASM </option>
						<!--<option>All </option>-->
						<?php foreach($getasm->lstMemberResponse as $asmList){?>
						<option value="<?php echo $asmList->employeeId;?>"><?php echo $asmList->employeeName;?></option>
						<?php } ?>
					</select>
			   </div>
			   
			   <div class="col-md-3 pd-3" >
					<select class="form-control" id="tsm">
						<option value="">TSM</option>
						<?php foreach($gettsm->lstMemberResponse as $asmList){?>
						<option value="<?php echo $asmList->employeeId;?>"><?php echo $asmList->employeeName;?></option>
						<?php } ?>
					</select>
			   </div>
			   <div class="col-md-3 pd-3" >
					<select class="form-control" id="sr">
						<option value="">SR</option>
						<?php foreach($getsr->lstMemberResponse as $asmList){?>
						<option value="<?php echo $asmList->employeeId;?>"><?php echo $asmList->employeeName;?></option>
						<?php } ?>
					</select>
			   </div>
			   
			    <div class="col-md-3" style="padding:0px;">
			   <div class="col-md-12 pd-3">
			        
					<select class="form-control" id="zoneid">
					<option value="0">Please Select Zone</option>
					<?php
					foreach($rowdataZone->lstRetailerDetailedData as $value){
						//echo '<pre>';print_r($value);
						?>
						<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
						<?php
					}
					?>
					</select>
			   </div>
			   </div>
			   
			</div>
			<div class="col-md-12 padd0 ">
			   <div class="col-md-2 pull-right  mt-10">
					<button type="button" class="Adv-search-btn " id="adv_search" placeholder="Search" onclick="AdvanceSearch();">Search</button>
			   </div>
			   </div>
		   </div><!--END RETAILER TYPE-->
	   
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
				<a href="#" class="add-btn" id="Unblock_retailers">Unblock</a>
			   </div>
			   <div class="col-md-4" style="padding:0px;">
			   
			   </div>
		   </div>
	 <?php 
	extract($_POST);
	//print_r($_POST); die;
	if($_SESSION['userData']['roleId']=='1'){//admin login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'isSearch'=>'blocked');
		}
		if($_SESSION['userData']['roleId']=='37'){//manager login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'managerid'=>$_SESSION['userData']['employeeId'],'isSearch'=>'blocked');
		}
		if($_SESSION['userData']['roleId']=='38'){//asm login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'asmId'=>$_SESSION['userData']['employeeId'],'isSearch'=>'blocked');
		}
		if($_SESSION['userData']['roleId']=='39'){//Tsm Login
			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'tsmid'=>$_SESSION['userData']['employeeId'],'isSearch'=>'blocked');
		}
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getRetailer";
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
	$blocklist=curl_exec($ch);
	curl_close($ch);
	//print_r($blocklist);
	$getblocklist=json_decode($blocklist);
	   ?> 
	   <input type="hidden" id="csv_value">
	   <?php
	   if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[11]->view=='Y'){
		   ?>
		     <div class="row">	   
  <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
	  <td><input type="checkbox" id="checkAll"/></td>
		<th>Retailer</th>
        <th style="width: 84px;">Name</th> 
		<th>Email-ID</th>
        <th>Mobile</th>
		<th style="width: 115px;">Address</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Group Name</th>
		<th>Outstanding</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($getblocklist->lstRetailerRawData as $value){
		    //echo '<pre>';print_r($value);
		?>
	    <tr>
			<td><input type="checkbox" class="checkItem" value="<?php echo $value->retailerId;?>"/></td>
			<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&&source=edit"><?php echo $value->retailerName;?></a></td>
			<td><?php echo $value->email;?></td>
			<td><?php echo $value->mobile;?></td>
			<td><?php echo $value->address;?></td>
			<td><?php echo $value->srName;?></td>
			<td><?php echo $value->typeName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
			<td><?php echo $value->groupName;?></td>
			<td><?php echo $value->outStanding;?></td>
			
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
	
   
    <!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
    <!-- /.content-wrapper-->
    <?php
	 include ('footer.php');
	?>
	<script>
	/***************************************ADVANCE SEARCH************************************************/
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


function AdvanceSearch(){
var type=$('#type').val();
var subtype=$('#subtype').val();
var cat=$('#cat').val();
var manager=$('#manager').val();
var asm=$('#asm').val();
var tsm=$('#tsm').val();
var sr=$('#sr').val();
let zoneId=$('#zoneid').val();
    $.ajax({
	type:'POST',
    url:'ajax.php',
    data:{'type':type,'subtype':subtype,'cat':cat,'manager':manager,'asm':asm,'tsm':tsm,'sr':sr,'zoneId':zoneId,'page':'GetBlockretailerBysearchparam'},
	 
    async:false,
    success: function (res){
	$('#ori_down').css('display','none');
    $('#search_download').css('display','block');
	$('#show_retailer').html(res);	
	$('#show-search-box').css('display','none');
	}			
	});
}

/**************************************************SEARCH ITEAM ONLY DOWNLOAD*****************************************************************/
$('#search_download').on('click',function(){        
    let type=$('#type').val();
    let subtype=$('#subtype').val();
    let cat=$('#cat').val();
    let manager=$('#manager').val();
    let asm=$('#asm').val();
    let tsm=$('#tsm').val();
    let sr=$('#sr').val();
	let zoneId=$('#zoneid').val();
	
    self.location.href="search_export_all_retailers.php?manager="+manager+'&asm='+asm+'&tsm='+tsm+'&type='+type+'&subtype='+subtype+'&cat='+cat+'&sr='+sr+'&zoneId'+zoneId;
});
/***************************************************END ADVANCE SEARCH DOWNLOAD ***************************************************************/
	/**********************************************END ADVANCE SEARCH*************************************/
	
	$(document).ready(function() {
			$('#example').DataTable();
		});
		
		$('#checkAll').click(function() {
			
         $(':checkbox.checkItem').prop('checked', this.checked); 
		  checked = []
          $(".checkItem:checked").each(function () {
           checked.push($(this).val())
          });
		   $('#csv_value').val(checked.join(","));
		   var csv_val=checked.join(",");
       });
	/**********************IF USER UNCHECK THEN GET CSV VALUE*********************************/
	   $('.checkItem').click(function(){
		   
		   
		     checked = []
          $(".checkItem:checked").each(function () {
         checked.push($(this).val())
             });
           //alert(checked.join(","))
		   $('#csv_value').val(checked.join(","));
		  
		  
	   });
	   /**********************************END UNCHECKED VALUE*************************************/
	   $('#Unblock_retailers').on('click',function(){
		   let retailerId=$('#csv_value').val();
		   if(retailerId==''){
			   alert('Please Select checkbox');
			   return false;
			   
			   
		   }else{
			   let c=confirm('Do you want to block Retailer');
			 if(c==true){
			 $.ajax({
			type:'POST',
            url:'ajax.php',
			dataType:'json',
            data:{'retailerId':retailerId,'page':'makeactiveRetailers'},
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
	   });
	  
	   
  
	</script>
	