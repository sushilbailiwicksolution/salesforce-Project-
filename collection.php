<?php
     error_reporting(E_ERROR | E_PARSE);
	 include ('header.php');
	  $date=date('Y-m-d');
	  $first_day_this_month =  date('Y-m-01');	
	  $last_day_this_month  = date('Y-m-t');
	// $yeararray = explode("-", $date);
	if($_SESSION['userData']['roleId']=='1'){//admin login
	
			 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'startDate'=>$first_day_this_month,'endDate'=>$last_day_this_month);
		}
		if($_SESSION['userData']['roleId']=='37'){//manager login
		    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'startDate'=>$first_day_this_month,'endDate'=>$last_day_this_month,'managerid'=>$_SESSION['userData']['employeeId']);
			
		}
		if($_SESSION['userData']['roleId']=='38'){//asm login
	
			 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'startDate'=>$first_day_this_month,'endDate'=>$last_day_this_month,'asmId'=>$_SESSION['userData']['employeeId']);
		}
		if($_SESSION['userData']['roleId']=='39'){//Tsm Login

			$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'startDate'=>$first_day_this_month,'endDate'=>$last_day_this_month,'tsmid'=>$_SESSION['userData']['employeeId']);
		}
	
	
	 
	 $designation_string=json_encode($form_designation);
	//echo $designation_string;
	
	$url="http://".$baseurl."/salesforceapi/getCollectionDetails";
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

	$get_collection=curl_exec($ch);
	
	//echo 'target-'.$remaning_amount['list'];
	curl_close($ch);
	//print_r($manager);
	$get_collection_amount=json_decode($get_collection);
	//echo '<pre>';print_r($get_collection_amount->list);
	
	/*****************************************GET License************************************/
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
    $urls="http://".$baseurl."/salesforceapi/getLicenseByDistributerId";
    $header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$urls);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                              
	$licence=curl_exec($ch);
	curl_close($ch);
	$getlicense=json_decode($licence);
	//echo '<pre>';print_r($getlicense->list);
	/***************************************END GET License***********************************/
	/****************************************GET ALL STATE************************************/
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
	//echo '<pre>';print_r($getState->lstCommnodetail);
	
	/****************************************END GET ALL STATE********************************/
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
	/**************************************GET RETAILER CATEGORY*******************************/
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
	$catrowdata=json_decode($data);
	//echo '<pre>';print_r($rowdata->lstRetailerDetailedData);
	/*************************************END GET RETAILER****************************************/
	/***************************************************GET COLLECION BY RETAILER TYPE*******************/
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
	$typerowdata=json_decode($data);
	//echo '<pre>';print_r($typerowdata->lstRetailerDetailedData);
	/***************************************************END RETAILER YPE**********************************/
	/*********************************************GET COLLECTION BY SUBTYPE********************************/
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
	$subTyperowdata=json_decode($data);
	//echo '<pre>';print_r($rowdata->lstRetailerDetailedData);
	/************************************************END GET SUB TYPE**************************************/
	/***********************************************GET COLLECTION BY TSM***************************************************/
	$form_designation=array('roleId'=>'38','distributerId'=>$_SESSION['userData']['distributerId']);
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
	$getasm=json_decode($tsm);
	//echo '<pre>';print_r($gettsm->lstMemberResponse);
	/**********************************************END COLLECTION BY TSM*****************************************************/
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
  
  <div class="content-wrapper">
	<div class="container">
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Retailers Sales</a>
        </li>
        <li class="breadcrumb-item active">Collection</li>
		<div class="advance-tbtn" id="adv-s">Advance search</div>
      </ol>
	   <!-----ddddddd--------->
	   
	   
	   <div class="container">
	   
			<div class="row adv-s" id="show-search-box" style="display:none;"><!--RETAILER TYPE-->
			<div class="col-md-10">
			<p style="margin-bottom:10px;"> Retailer</p>
			<div class="col-md-4 pd-3">
					<select class="form-control" id="type">
					<option value="">Type</option>
					<?php
					 foreach($typerowdata->lstRetailerDetailedData as $retailerType){
						 ?>
						 <option value="<?php echo $retailerType->id;?>"><?php echo $retailerType->name;?></option>
						 <?php
						 
					 }
					?>
						
						
						
					</select>
			   </div>
			   <div class="col-md-4 pd-3">
					<select class="form-control" id="subtype">
						<option value="">Subtype</option>
						<?php
						 foreach($subTyperowdata->lstRetailerDetailedData as $retailerSubType){
							 ?>
							 <option value="<?php echo $retailerSubType->id;?>"><?php echo $retailerSubType->name;?></option>
							 <?php
							 
						 }
						?>
					</select>
			   </div>
			   <div class="col-md-4 pd-3">
					<select class="form-control" id="cat">
						<option value="">Category</option>
						<?php
						  foreach($catrowdata->lstRetailerDetailedData as $category){
							  ?>
							  <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
							  <?php
							  
						  }
						?>
						
					</select>
			   </div>
			
			</div>	   
			   <!--TEAM SEARCH-->
			   <div class="col-md-10">
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
					<select class="form-control" id="asm">
						<option value="">ASM</option>
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
			</div>
			<div class="col-sm-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">From Date</label>
					<input type="date" class="form-control"  id="from_date" value="<?php echo $first_day_this_month; ?>">
			</div>
			   <div class="col-sm-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">To Date</label>
					<input type="date" class="form-control" id="to_date" value="<?php echo $last_day_this_month; ?>">
			</div>
			<div class="col-sm-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">License</label>
					<select class="form-control" id="licence">
						<option>Select</option>
						<?php
						   foreach($getlicense->list as $licence){
							   ?>
							   <option value="<?php echo $licence->licenseId;?>"><?php echo $licence->licenseName;?></option>
							   <?php
							   
						   }
						?>
					</select>
			</div>
			
			<div class="col-md-12 padd0 ">
			   <div class="col-md-2 pull-right  mt-10">
					<button type="button" class="Adv-search-btn " id="adv_search" placeholder="Search">Search</button>
			   </div>
			   </div>
			   
		   </div><!--END RETAILER TYPE-->
		   <?php
		   if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[37]->download=='Y'){
			   ?>
			   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				
				<a href="export_collection.php" id="ori_down"><button>Download CSV</button></a>
				<button id="search_download" style="display:none;">Download CSV</button>
			   </div>
		   </div>
			   <?php
		   }
		   ?>
		   
		   
	   <?php
	   if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[37]->view=='Y'){
		   ?>
		   <div class="row" id="showtable">	   
  <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th style="width: 130px;">Retailer Name</th>
		<th>SR Name</th>
		<th>Visited By</th>
		<th>City</th>
		<th>License</th>
        <th>Collection Amount <i class="fa fa-sort" aria-hidden="true"></i></th>
		<th>Outstanding Amount <i class="fa fa-sort" aria-hidden="true"></i></th>  
		<th>Type</th>
		<th>Subtype</th>
		<th>Category</th>
        <th>Group Name</th>
        <!--<th>Date</th>-->
      </tr>
    </thead>
    <tbody>
	   <?php
	   //echo 'date-'.$date;
	      foreach($get_collection_amount->list as $collection){
			  //echo '<pre>';print_r($collection);
			  
			  ?>
          <tr>
			<td><?php echo $collection->retailerName;?></td>
			<td><?php echo $collection->srName;?></td>
			<td><?php echo $collection->visitorName;?></td>
		
			<td><?php echo $collection->city;?></td>
			<td><?php echo $collection->licenceName;?></td>
			<td><?php echo $collection->paymentAmount;?></td>
			<td><?php echo $collection->amount;?></td>
			<td><?php echo $collection->retailerType;?></td>
			<td><?php echo $collection->retailerSubType;?></td>
			<td><?php echo $collection->retailerCatagory;?></td>
			<td><?php echo $collection->groupName;?></td>
			
		</tr>			  
			  <?php    
			  
		  }
	   ?>
	    
		 
	    
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
	/*********************************************SET CURRENT DATE IN DATE PICKER******************************************/
	/*$(document).ready(function(){
		
		var today = new Date();
        var dd = today.getDate();

        var mm = today.getMonth()+1; 
        var yyyy = today.getFullYear();
        if(dd<10) 
       {
       dd='0'+dd;
        }  

     if(mm<10) 
    {
    mm='0'+mm;
    } 
    today = yyyy+'-'+mm+'-'+dd;
    console.log(today);
    //alert(today);
	$('#to_date').val(today);
	$('#from_date').val(today);
	});*/
	/******************************************END DATE PICKER**************************************************************/
	$('#cityId').on('change',function(){
		var cityId=$('#cityId').val();
		//alert(cityId);
		$.ajax({
		type:'POST',
        url:'ajax.php',
        data:{'CityId':cityId,'page':'getcollection_byCityId'},
        async:false,
        success: function(res){
			//alert(res);
			//$('#showtable').html(res);
			
		}		
			
		});
	});
	
	/*********************************************GET COLLECTION BY LICENCE ***********************************************/
	$('#licence').on('change',function(){
		var licenceId=$('#licence').val();
		$.ajax({
		type:'POST',
        url:'ajax.php',
        data:{'LicenceId':licenceId,'page':'getcollection_byCityId'},
        async:false,
        success:function(res){
			//$('#showtable').html(res);
		}		
		});
	});
	/**************************************************END COLLECION ID****************************************************/
	/*****************************************GET COLLECTION BY CATEGORY***************************************************/
	$('#retailer_cat').on('change',function(){
	var retailerCat=$('#retailer_cat').val();
    // alert(retailerCat);
      $.ajax({
		type:'POST',
        url:'ajax.php',
        data:{'retailerCat':retailerCat,'page':'getcollection_byCityId'},
        async:false,
        success:function(res){
			//$('#showtable').html(res);
		}		
		});	
	});
	/****************************************************END GET COLLECTION CATEGORY****************************************/
	/*****************************************************GET COLLECTION BY TYPE*******************************************/
	$('#type').on('change',function(){
		var type=$('#type').val();
		$.ajax({
		type:'POST',
        url:'ajax.php',
        data:{'type':type,'page':'getcollection_byCityId'},
        async:false,
        success:function(res){
			//$('#showtable').html(res);
		}		
		});
	});
	/*****************************************************END GET COLLECTION TYPE******************************************/
	/******************************************************GET COLLECTION BY SUBTYPE***************************************/
	$('#sub_type').on('change',function(){
		var subtype=$('#sub_type').val();
		$.ajax({
		type:'POST',
        url:'ajax.php',
        data:{'subtype':subtype,'page':'getcollection_byCityId'},
        async:false,
        success:function(res){
			//$('#showtable').html(res);
		}		
		});
		
	});
	/*******************************************************END GET COLLECTION BY SUBTYPE***********************************/
	/*****************************************************GET COLLECTION BY DATE*********************************************/
	$('#to_date').on('change',function(){
		var from_date=$('#from_date').val();
		var to_date=$('#to_date').val();
		$.ajax({
		type:'POST',
        url:'ajax.php',
        data:{'from_date':from_date,'to_date':to_date,'page':'getcollection_byCityId'},
        async:false,
        success:function(res){
		//$('#showtable').html(res);
		}		
		});
	});
	/********************************************************END COLLECTION DATE*********************************************/
	/**************************************************************GET COLLECTION BY TSM************************************/
	$('#asm_id').on('change',function(){
		var asmId=$('#asm_id').val();
		alert(asmId);
		var from_date=$('#from_date').val();
		var to_date=$('#to_date').val();
		$.ajax({
		type:'POST',
        url:'ajax.php',
        data:{'from_date':from_date,'to_date':to_date,'asmId':asmId,'page':'getcollection_byCityId'},
        async:false,
        success:function(res){
			//$('#showtable').html(res);
		}		
		});
		
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

/**************************************************************END COLLECTION BY TSM*************************************/
/*============================================================ADVANCE SEARCH OF COLLECTION======================================*/
$('#adv_search').on('click',function(){
let type=$('#type').val();
let subtype=$('#subtype').val();
let cat=$('#cat').val();
let manager=$('#manager').val();
let asm=$('#asm').val();
let tsm=$('#tsm').val();
let sr=$('#sr').val();
let from_date=$('#from_date').val();
let licence=$('#licence').val();
let to_date=$('#to_date').val();

    $.ajax({
	type:'POST',
    url:'ajax.php',
    data:{'type':type,'subtype':subtype,'cat':cat,'manager':manager,'asm':asm,'tsm':tsm,'from_date':from_date,'to_date':to_date,'sr':sr,'licence':licence,'page':'GetCollectionBysearchparam'},
	 
    async:false,
    success: function (res){
	$('#ori_down').css('display','none');
	$('#search_download').css('display','block');
	$('#showtable').html(res);	
	$('#show-search-box').css('display','none');
	}			
	});
});
/*============================================================END ADVANCE SEARCH OF COLLECTION==================================*/
/**************************************************SEARCH ITEAM ONLY DOWNLOAD*****************************************************************/
$('#search_download').on('click',function(){
let type=$('#type').val();
let subtype=$('#subtype').val();
let cat=$('#cat').val();
let manager=$('#manager').val();
let asm=$('#asm').val();
let tsm=$('#tsm').val();
let sr=$('#sr').val();
let from_date=$('#from_date').val();
let licence=$('#licence').val();
let to_date=$('#to_date').val();	  
self.location.href="search_export_collection.php?manager="+manager+'&asm='+asm+'&tsm='+tsm+'&sr='+sr+'&type='+type+'&subtype='+subtype+'&cat='+cat+'&licence='+licence+'&from_date='+from_date+'&to_date='+to_date;
});
/***************************************************END ADVANCE SEARCH DOWNLOAD ***************************************************************/
	
	
	</script>
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
    <!-- /.content-wrapper-->
    <?php
	 include ('footer.php');
	?>