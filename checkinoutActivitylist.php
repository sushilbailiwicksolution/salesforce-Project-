<?php
     error_reporting(E_ERROR | E_PARSE);
	 include ('header.php');
	  $date=date('Y-m-d');
	// $yeararray = explode("-", $date);
	
	 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'name'=>$_REQUEST['activityId']);
	 $designation_string=json_encode($form_designation);
	//echo $designation_string;
	
	$url="http://".$baseurl."/salesforceapi/getCheckActivityList";
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
	$get_checkinout=curl_exec($ch);
	//echo '<pre>';print_r($get_collection->list);
	
	//echo 'target-'.$remaning_amount['list'];
	curl_close($ch);
	//print_r($manager);
	$get_checkinoutactivity=json_decode($get_checkinout);
	
	//echo '<pre>';print_r($get_checkinoutactivity);
	   //echo 'messagellll'.$get_collection_amount->statusCode;
	
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
	?>
  
  <!-------------------------------------navbar ends here------------------------------------------------->
  
  <div class="content-wrapper">
	<div class="container">
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Team</a>
        </li>
        <li class="breadcrumb-item active">Visit </li>
        <li class="breadcrumb-item active">Check In Out Activity List </li>
		<div class="advance-tbtn" id="adv-s">Advance search</div>
      </ol>
	   <!-----ddddddd--------->
	   
	   
	   <div class="container">
	   
			<div class="row adv-s" id="show-search-box" style="display:none;"><!--RETAILER TYPE-->
			   
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
					</select>
			   </div>
			   <div class="col-md-3 pd-3" >
					<select class="form-control" id="tsm">
						<option value="">TSM</option>
					</select>
			   </div>
			   <div class="col-md-3 pd-3" >
					<select class="form-control" id="sr">
						<option value="">SR</option>
					</select>
			   </div>
			</div>
			<div class="col-md-12 padd0 ">
			   <div class="col-md-2 pull-right  mt-10">
					<button type="button" class="Adv-search-btn " id="adv_search" placeholder="Search">Search</button>
			   </div>
			    <!--DATE PARAM-->
			    <div class="row" style="margin: 18px -15px;">
			   <div class="col-sm-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">From Date</label>
					<input type="date" class="form-control"  id="from_date">
			</div>
			   <div class="col-sm-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">To Date</label>
					<input type="date" class="form-control" id="to_date">
			</div>   
			   <div class="col-md-4" style="padding-top: 32px;">
			   
			   </div>
		   </div>
			   <!--END DATE PARAM-->
			   </div>
			   
			  
			   
			   
		   </div><!--END RETAILER TYPE-->
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				
				<a href="export_finance-report.php" id="ori_down"><button>Download CSV</button></a>
				<button id="search_download" style="display:none;">Download CSV</button>
			   </div>
		   </div>
		  
	     <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h6 class="modal-title">Define the Reason For Disapprove</h6>
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<label style="position: absolute; top: 15px;"> Message </label>
					<textarea rows="5" cols="40" style=" margin:15px 0; position:relative; right:-100px;" id="reason_message"></textarea>
				</div>
			</div>
		</div>
        <div class="modal-footer">
			<button class="btn btn-default" style="position: relative; left: -25px;" id="Disapprove_payment">Submit</button>
		</div>
        
      </div>
      
    </div>
  </div>
  <!--END MODEL-->
		   <?php
		   if($get_collection_amount->statusCode!=0){
			 
             ?>
			 <p style="color:red;text-align: center;;"><?php echo $get_collection_amount->message;?></p>
              <?php			 
		   }
		   ?>
	   
<div class="row" id="showtables">	   
  <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th style="width: 130px;">Activity Name</th>
		<th>Description </th>
		
		
		
        <!--<th>Date</th>-->
      </tr>
    </thead>
    <tbody>
	<?php
	  //echo '<pre>';print_r($get_collection_amount->list);
	 foreach($get_checkinoutactivity->lstCommnodetail as $checkinoutactivity){
		//echo '<pre>';print_r($checkinoutactivity); 
		 ?>
		 <tr>
			<td><?php echo $checkinoutactivity->name;?></td>
			<td><?php echo $checkinoutactivity->description;?> </td>
			
			
			
		</tr>	
		 <?php
	 }
	?>
          		  
			
    </tbody>
	

  </table>
  
</div>
	</div>
	   <input type="hidden" id="paymentId">
	</div>
	<script>
	function Disapprove(paymentId){
		
		$('#paymentId').val(paymentId);
		
	}
	/*******************************************APPROVE FINANCE REPORT********************************************************/
	function Getapprove(paymentId,retailerId,visitorId,paymentAmount,paymentMode,licenseId,refrenceNo,paymentAmountType){
  // alert(paymentId+'-'+retailerId+'-'+visitorId+'-'+paymentAmount+'-'+paymentMode+'-'+licenseId+'-'+refrenceNo+'-'+paymentAmountType);
     let c=confirm('Do You Want to approve');
       if(c==true){
		 $.ajax({
		 type:'POST',
          url:'ajax.php',
          data:{'PaymentId':paymentId,'retailerId':retailerId,'visitorId':visitorId,'paymentAmount':paymentAmount,'paymentMode':paymentMode,'licenseId':licenseId,'refrenceNo':refrenceNo,'paymentAmountType':paymentAmountType,'page':'approvePayment'},
          async:false,
          success:function(target){
			  self.location.href='';
			  console.log(target);
			  alert(target.statusCode);
			  if(target.statusCode == 0) {
							swal("Success",target.message, "success");
								setTimeout(function(){
									window.location.reload();
								}, 2000);								
						}else{
								swal("Action failed",target.message, "error");
							}
			  
	        		  
		  }		  
		 });
         		   
	   }
	}
	/*********************************************END FINANCE APPROVE REPORT**************************************************/
	/********************************************Disapprove_payment***********************************************************/
	$('#Disapprove_payment').on('click',function(){
		let payemntId=$('#paymentId').val();
		let reason_message=$('#reason_message').val();
		if(reason_message==''){
			alert('Please Enter Message reason for Dis Approve');
			return false;
		}
		else if(reason_message.length>=196){
			alert('You can not Enter More Then 200 words');
			return false;
		}else{
		  $.ajax({
		type:'POST',
		url:'ajax.php',
		data:{'payemntId':payemntId,'reason_message':reason_message,'page':'Disaprrove_payment'},
		async:false,
		success:function(res){
			//alert(res);
			self.location.href="";
		}
		});	
	}
		
	});
	/********************************************END Disapprove_payment********************************************************/
	/*********************************************SET CURRENT DATE IN DATE PICKER******************************************/
	$(document).ready(function(){
		
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
	});
	/******************************************END DATE PICKER**************************************************************/
	$('#cityId').on('change',function(){
		var cityId=$('#cityId').val();
		//alert(cityId);
		$.ajax({
		type:'POST',
        url:'ajax.php',
        data:{'CityId':cityId,'page':'getfinanance_report'},
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
        data:{'LicenceId':licenceId,'page':'getfinanance_report'},
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
        data:{'retailerCat':retailerCat,'page':'getfinanance_report'},
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
        data:{'type':type,'page':'getfinanance_report'},
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
        data:{'subtype':subtype,'page':'getfinanance_report'},
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
        data:{'from_date':from_date,'to_date':to_date,'page':'getfinanance_report'},
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
        data:{'from_date':from_date,'to_date':to_date,'asmId':asmId,'page':'getfinanance_report'},
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
    data:{'type':type,'subtype':subtype,'cat':cat,'manager':manager,'asm':asm,'tsm':tsm,'from_date':from_date,'to_date':to_date,'sr':sr,'licence':licence,'page':'getfinanance_report'},
	 
    async:false,
    success: function (res){
		//alert();
	$('#ori_down').css('display','none');
	$('#search_download').css('display','block');
	$('#showtables').html(res);	
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
self.location.href="search_export_finance-report.php?manager="+manager+'&asm='+asm+'&tsm='+tsm+'&sr='+sr+'&type='+type+'&subtype='+subtype+'&cat='+cat+'&licence='+licence+'&from_date='+from_date+'&to_date='+to_date;
});
/***************************************************END ADVANCE SEARCH DOWNLOAD ***************************************************************/

$(document).ready(function() {
			$('#example').DataTable();
		});	
</script>
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
    <!-- /.content-wrapper-->
    <?php
	 include ('footer.php');
	?>