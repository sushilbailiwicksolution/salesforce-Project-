<?php
	 include ('header.php');
	 $date_year=date('Y');
     //$month = 201002; 
     $m=date('M');
    //echo 'month=>'.$date = DateTime::createFromFormat('Yd', $month);  
	// echo '<pre>';print_r($_SESSION);
	//echo 'id-'.$_SESSION['userData']['employeeId'];
	//echo 'iddis-'.$_SESSION['userData']['roleId'];
	if($_SESSION['userData']['employeeId']==1){
	$form_designation=array('roleId'=>'37','distributerId'=>$_SESSION['userData']['distributerId']);	
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getTeamByRole";	
	}
	else{
	$form_designation=array('roleId'=>$_SESSION['userData']['roleId'],'id'=>$_SESSION['userData']['employeeId']);	
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getListForProfile";		
	}
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
	//$option="<option value=''>Report</option>";
	//$option.="<option value='1'>Admin</option>";
	//$option.="<option value='-5'>Self</option>";
	$getreport=curl_exec($ch);
	curl_close($ch);
	//print_r($getreport);
	$tsmData=json_decode($getreport);
	//echo '<pre>';print_r($tsmData);
	/*********************************************GET OUTSTANDING AMOUNT***************************************************/
	if($_SESSION['userData']['roleId']==1){
		$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);	
	 $designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getDistributerOutstanding";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
		
	}else{
	 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'id'=>$_SESSION['userData']['employeeId']);	
	 $designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getMemberOutstandingById";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	}
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               	
	$outsanding=curl_exec($ch);
	curl_close($ch);
	//print_r($manager);
	$outsandingAmount=json_decode($outsanding);
	//echo '<pre>';print_r($outsandingAmount['list']);
	//echo 'outstanding'.$outsandingAmount->list;
	/*************************************************END OUTSTANDING AMOUNT***********************************************/
	/**********************************************REMANING TARGET AMOUNT**************************************************/
	 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'id'=>$_SESSION['userData']['employeeId']);	
	 $designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getMemberOutstandingById";
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
	$remaning_amount=curl_exec($ch);
	//echo 'target-'.$remaning_amount['list'];
	curl_close($ch);
	//print_r($manager);
	$remaning_traget_amount=json_decode($remaning_amount);
    //echo 'target'.$remaning_traget_amount->list;
	/*********************************************END REMANING AMOUNT*****************************************************/
	/******************************************GET COLLECTION TARGET*******************************************************/
    $month = 201002; 
    $date = DateTime::createFromFormat('Yd', $month);  
    $monthName = $date->format('M'); // will get Month name
    //$date_year=$_REQUEST['year'];	
    //$monthName=$_REQUEST['month'];
    $date_year=date('Y');
	//echo 'month-'.$monthName;
	//echo 'id-'.$_SESSION['userData']['employeeId'];
	if($_SESSION['userData']['employeeId']==1){
	    $form_designation=array('month'=>$monthName,
	                        'year'=>$date_year,
							'id'=>$_SESSION['userData']['employeeId'],
							'roleId'=>1);	
	 	
	}else{
		$form_designation=array('month'=>$monthName,
	                        'year'=>$date_year,
							'id'=>$_SESSION['userData']['employeeId'],
							'roleId'=>$_SESSION['userData']['roleId']);
		
	}
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	
	$url="http://".$baseurl."/salesforceapi/getPaymentTarget";
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
	//echo '<pre>';print_r($get_collection_amount->targetList);
	/******************************************END COLLECTION TARGET*******************************************************/
	
	// Start Get License 
	
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
    $urls="http://".$baseurl."/salesforceapi/getLicenseByDistributerId";
    $header=array('Accept: application/json',
		'Content-Type: application/json');

	$ch1=curl_init();
	curl_setopt($ch1,CURLOPT_URL,$urls);
	curl_setopt($ch1,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch1,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch1,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                              
   $license=curl_exec($ch1);
	curl_close($ch1);
	$getlicense=json_decode($license);
	//echo '<pre>';print_r($getlicense->list);
	
	// End Get License
	?>
  
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  
  <style>
  .amount-pan {
	  padding:15px;
  }
  .amount-pan h3{
	      font-size: 18px;
  }
  .amount-pan span{
	      font-size: 24px;
    color: #079227;
    border: solid 1px #cacaca;
    padding: 7px 20px;
    border-radius: 4px;
	  
  }
  </style>
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">sales & collection  / Collection Target </a>
        </li>
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
	   <div class="row abc">
<div class="col-sm-12 amount-pan">
		<h3>My Collection Target Amount <span> <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $outsandingAmount->list;?></span></h3>
		</div>
	  <?php $date_year=date('Y')?>
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Year</label>
				
					<select class="form-control" id="year">
					    <option value="2018"<?php if($date_year=='2018'){echo 'selected';}?>><?php echo $date_year;?></option>
						<option value="2017"<?php if($date_year=='2017'){echo 'selected';}?>>2016</option>
						<option value="2016"<?php if($date_year=='2016'){echo 'selected';}?>>2017</option>
						
					</select>
			</div>
			<?php     
			?>
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Month</label>
					<select class="form-control" id="month">
						<option value="Jan" <?php if($m=='Jan'){echo 'selected';}?>>Jan</option>
						<option value="Feb" <?php if($m=='Feb'){echo 'selected';}?>>Feb</option>
						<option value="Mar" <?php if($m=='Mar'){echo 'selected';}?>>Mar</option>
						<option value="Apr" <?php if($m=='Apr'){echo 'selected';}?>>Apr</option>
						<option value="May" <?php if($m=='May'){echo 'selected';}?>>May</option>
						<option value="Jun" <?php if($m=='Jun'){echo 'selected';}?>>Jun</option>
						<option value="July" <?php if($m=='July'){echo 'selected';}?>>July</option>
						<option value="Aug" <?php if($m=='Aug'){echo 'selected';}?>>Aug</option>
						<option value="Sep" <?php if($m=='Sep'){echo 'selected';}?>>Sep</option>
						<option value="Out" <?php if($m=='Out'){echo 'selected';}?>>Out</option>
						<option value="Nov" <?php if($m=='Nov'){echo 'selected';}?>>Nov</option>
						<option value="Dec" <?php if($m=='Dec'){echo 'selected';}?>>Dec</option>
					</select>
			</div>

			<?php
			if($_SESSION['userData']['roleId']==38){
				?>
                   <div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">TSM</label>
				<select class="form-control" id="employeeId">
				<?php 
				foreach($tsmData->lstMemberResponse as $asmList){
					//echo '<pre>';print_r($asmList);
					//echo 'mana-'.$l=$asmList->employeeId;
					
					
						?>
						<?php
						if($asmList->roleId=='39'){
							?>
								<option value=<?php echo $asmList->employeeId;?>><?php echo $asmList->employeeName;?></option>
							<?php	
						}
						?>
				
					<?php
				}
				
				?>	
					</select>
			</div>
				<?php
			}if($_SESSION['userData']['roleId']==37){
				?>
				<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">ASM</label>
				<select class="form-control" id="employeeId">
				<?php 
				foreach($tsmData->lstMemberResponse as $asmList){
					//echo '<pre>';print_r($asmList);
					//echo 'mana-'.$l=$asmList->employeeId;
					
					if($asmList->roleId=='38'){
						?>
					<option value=<?php echo $asmList->employeeId;?>><?php echo $asmList->employeeName;?></option>
					<?php
					}	
				}
				
				?>
						
						
					</select>
			</div>
				<?php
			}
			/*****************************************GET SR DETAILS********************************************************/
			if($_SESSION['userData']['roleId']==39){
				?>
              <div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">SR</label>
				<select class="form-control" id="employeeId">
				<?php 
				foreach($tsmData->lstMemberResponse as $asmList){
					//echo '<pre>';print_r($tsmList);
					//echo 'mana-'.$l=$asmList->employeeId;
					
					
						?>
						<?php
						if($asmList->roleId==40){
							?>
						<option value=<?php echo $asmList->employeeId;?>><?php echo $asmList->employeeName;?></option>
							<?php	
						}
						?>
					<?php
				}
				?>	
					</select>
			</div>
				<?php
			}
			/*********************************************END SR DETAILS****************************************************/
			/**********************************SHOW MANAGER LIST************************************************************/
			if($_SESSION['userData']['roleId']==1){
				?>
                   <div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Manager</label>
				<select class="form-control" id="employeeId">
				<?php 
				foreach($tsmData->lstMemberResponse as $asmList){
					//echo '<pre>';print_r($asmList);
					//echo 'mana-'.$l=$asmList->employeeId;
					
					
						?>
						<?php
						if($asmList->roleId==37){
							?>
						<option value=<?php echo $asmList->employeeId;?>><?php echo $asmList->employeeName;?></option>
							<?php
							
						}
						
						?>
				
					<?php					
				}
				
				?>	
					</select>
			</div>
				<?php
			}
			/*******************************************END MANAGER**********************************************************/
			?>
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">License</label>
				<select class="form-control" name="license" id="license">
						<option value=""> Select License </option>
                          <?php
						  foreach($getlicense->list as $licence){
							  ?>
							  <option value="<?php echo $licence->licenseId;?>"><?php echo $licence->licenseName;?></option>
							  <?php
							  
						  }
						  ?>						
							
				</select>
			</div>
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Add Amount</label>
				<input type="text" id="add_amount" class="form-control" placeholder="Add Amount" onchange="Calculate_amount()">	
			</div>
			<div class="col-sm-4">
				<label for="defaultFormLoginEmailEx" class="grey-text">Remaining Amount</label>
				<input type="text" id="show_rest_amount" class="form-control" value="" readonly>	
			</div>
		
		
			<input type="hidden" id="rest_amount">
	    <div class="col-md-12" style="margin-top: 3px; margin-bottom:20px;">
			 <label for="defaultFormLoginEmailEx" class="grey-text">&nbsp;</label>
			 <?php
			 if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[42]->add=='Y'){
				 ?>
				 <a href="#"><button style="padding:8px 50px;" class="add-btn btn-primary" id="create_collection">Save</button></a>	
				 <?php
				 
			 }
			 ?>
			 
			 
			 <a href="#"><button style="padding:8px 50px;margin-top: 8px;" class="add-btn btn-primary" id="show_collection">Show</button></a></div>
			 <div class="row " style="width: 100%; padding:10px;">
			 <div class="col-md-6 " >
			 <p >Remaining Target Amount <span style=" border: solid 1px #cacaca; padding: 5px 15px; border-radius: 15px;"> <i class="fa fa-inr" aria-hidden="true"></i><?php echo $remaning_traget_amount->list;?></span></p>
			 </div>
			 <div class="col-md-6 " >
			  <p >Amount License Wise:-<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<span id="show_amount" style=" border: solid 1px #cacaca; padding: 5px 15px; border-radius: 15px;"></span></p>
			  </div>
			</div>
		</div>
	      
<div class="row" style="margin-top:20px;">	   
  <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
	   
		<th>Target Year</th>
		<th>Target Month </th>
		<th>LicenceName</th>
        <th>Member Name</th>
        <th>Role</th>
		<th>Designation</th>
		<th>Target Amount</th>
       <th>Action</th>
        
      </tr>
    </thead>
    <tbody>
	<?php
	   foreach($get_collection_amount->targetList as $collection){
		     //echo '<pre>';print_r($collection);die;
		     $roll=$collection->roleId;
			  //echo 'roll-'.$roll;
		    if($_SESSION['userData']['roleId']==1){
				$rolename='Manager';
				/********************************TABLE LIST FOR MANAGER********************************************/
				   if($roll==1 && $roll!=37 && $roll!=38 && $roll!=39 && $roll!=40){
					   ?>
				<tr>
			      <td><?php echo $collection->targetYear;?></td>
			      <td><?php echo $collection->targetMonth;?></td>
				  <td><?php echo $collection->licenceName;?></td>
			      <td><?php echo $collection->assignName;?></td>
			      <td><?php echo $rolename;?></td>
			      <td><?php echo $collection->designationNAme;?></td>
			      <td><?php echo $collection->amount?></td>
			      <td>
			     <a><button type="button" class="btn btn-primary small-btn" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			     <button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			     </td>
		        </tr>   
					   <?php
					   
				   }
				/**********************************END TABLE LIST***************************************/
			}
			if($_SESSION['userData']['roleId']==37){
				$rolename='ASM';
				/********************************TABLE LIST FOR ASM********************************************/
				   if($roll!=1 && $roll==37 && $roll!=38 && $roll!=39 && $roll!=40){
					   ?>
				<tr>
			      <td><?php echo $collection->targetYear;?></td>
			      <td><?php echo $collection->targetMonth;?></td>
				  <td><?php echo $collection->licenceName;?></td>
			      <td><?php echo $collection->assignName;?></td>
			      <td><?php echo $rolename;?></td>
			      <td><?php echo $collection->designationNAme;?></td>
			      <td><?php echo $collection->amount?></td>
			      <td>
			     <a><button type="button" class="btn btn-primary small-btn" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			     <button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			     </td>
		        </tr>   
					   <?php
					   
				   }
				/**********************************END TABLE LIST***************************************/
			}
			if($_SESSION['userData']['roleId']==38){
				$rolename='TSM';
				/********************************TABLE LIST FOR TSM********************************************/
				   if($roll!=1 && $roll!=37 && $roll==38 && $roll!=39 && $roll!=40){
					   ?>
				<tr>
			      <td><?php echo $collection->targetYear;?></td>
			      <td><?php echo $collection->targetMonth;?></td>
				  <td><?php echo $collection->licenceName;?></td>
			      <td><?php echo $collection->assignName;?></td>
			      <td><?php echo $rolename;?></td>
			      <td><?php echo $collection->designationNAme;?></td>
			      <td><?php echo $collection->amount?></td>
			      <td>
			     <a><button type="button" class="btn btn-primary small-btn" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			     <button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			     </td>
		        </tr>   
					   <?php
					   
				   }
				/**********************************END TABLE LIST***************************************/
			}
			if($_SESSION['userData']['roleId']==39){
				$rolename='SR';
				/********************************TABLE LIST FOR SR********************************************/
				   if($roll!=1 && $roll!=37 && $roll!=38 && $roll==39 && $roll!=40){
					   ?>
				<tr>
			      <td><?php echo $collection->targetYear;?></td>
			      <td><?php echo $collection->targetMonth;?></td>
				  <td><?php echo $collection->licenceName;?></td>
			      <td><?php echo $collection->assignName;?></td>
			      <td><?php echo $rolename;?></td>
			      <td><?php echo $collection->designationNAme;?></td>
			      <td><?php echo $collection->amount?></td>
			      <td>
			     <a><button type="button" class="btn btn-primary small-btn" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			     <button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			     </td>
		        </tr>   
					   <?php
					   
				   }
				/**********************************END TABLE LIST***************************************/
			}
			
		   ?>
		   <?php
		   
	   }
	?>
	    
		
    </tbody>
  </table>
</div>
	</div>
	</div>
	<input type="hidden" id="outstanding" value="<?php echo $outsandingAmount->list;?>">
	<input type="hidden" id="remaining_amount" value="<?php echo $remaning_traget_amount->list;;?>">
	<input type="hidden" id="Created_id" value="<?php echo $_SESSION['userData']['employeeId'];?>">
   <script>
   $(document).ready(function() {
	
			$('#example').DataTable();
		});
   function Calculate_amount(){
	   let add_amount=$('#add_amount').val();
	   let show_rest_amount=$('#show_rest_amount').val();
	   //let add_amount=200000;
	   //let show_rest_amount=4000;
	   alert(add_amount+'<='+show_rest_amount);
	   
	    let c=parseInt(add_amount)<parseInt(show_rest_amount);
	
	   if(c==true){
		   alert('add Target');
	   }else{
		  
		   alert('You Can Not Add More then Remaining Amount');
		   $('#add_amount').val('')
		   
	   }
   }
   /**********************************************GET AMOUNT LICENSE WISE******************************/
   $('#license').on('change',function(){
	    let emplyee_id='<?php echo $_SESSION['userData']['employeeId'];?>';
	    let license=$('#license').val();
		let year=$('#year').val();
	    let month=$('#month').val();
	    $.ajax({
		type:'POST',
        url:'ajax.php',
        data:{'emplyee_id':emplyee_id,'license':license,'year':year,'month':month,'page':'Get_collection_amount'},
        cache:false,
        success:function(res){
			//alert(res);
			$('#show_rest_amount').val(res);
			//$('#rest_amount').val(res);
		}		
	   });
   });
   /***********************************************END GET AMOUNT LICENSE WISE**************************/ 
   /************************************SHOW COLLECTION**********************************************/
   $('#show_collection').on('click',function(){
	 var year=$('#year').val();
	 var month=$('#month').val();
	 var emplyee_id=$('#employeeId').val();
	 var license=$('#license').val();
	 if(emplyee_id!="" && license!=""){
		 $.ajax({
		type:'POST',
        url:'ajax.php',
        data:{'year':year,'month':month,'emplyee_id':emplyee_id,'license':license,'page':'show_collection'},
        cache:false,
        success:function(res){
         //alert(res);	
          $('#show_amount').html(res);		 
		}		
		 });
		 
	 }else{
		 alert('Please Select date & Member By LicenceName');
	 }
	 
   });
   /*****************************************END SHOW COLLECTION**************************************/
   $('#create_collection').on('click',function(){
	 var year=$('#year').val();
	 var month=$('#month').val();
	 var emplyee_id=$('#employeeId').val();
	 var addamount=$('#add_amount').val();
	 var outstanding=$('#outstanding').val();
	 var remaining_amount=$('#remaining_amount').val();
	 var Created_id=$('#Created_id').val();
	 var license=$('#license').val();
	 //alert(Created_id);
	 var continu='';
	//alert(year+'-'+month+'-'+emplyee_id+'-'+outstanding+'-'+remaining_amount+'-'+addamount+'-'+Created_id);
	 
	 if(year!="" && month!="" && emplyee_id!="" && addamount!="" && Created_id!="" && license!=""){
		             $.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'year':year,'month':month,'Created_id':Created_id,'emplyee_id':emplyee_id,'addamount':addamount,'remaining_amount':remaining_amount,'outstanding':outstanding,'continu':continu,'license':license,'page':"create_collection"},
					 cache: false,
					 success: function(output){ 
						if(output.statusCode == 0) {
							swal("Success",output.message, "success");
								setTimeout(function(){
								window.location.reload();
							}, 2000);
							}else {
								//swal("Action failed",output.message, "error");
								//swal("Action failed",target.message, "error");
								var c=confirm('Do you want to continue');
								if(c==true){
								var continu='y';
                                 /*******************************UPDATE QTY**************************************/
								   $.ajax({
					               type: 'POST',
					               url:"ajax.php",
					               dataType:'json',
					               data:{'year':year,'month':month,'Created_id':Created_id,'emplyee_id':emplyee_id,'addamount':addamount,'remaining_amount':remaining_amount,'outstanding':outstanding,'continu':continu,'license':license,'page':"create_collection"},
					               cache: false,
					               success: function(output){ 
						          if(output.statusCode == 0) {
							      swal("Success",output.message, "success");
								setTimeout(function(){
								window.location.reload();
							    }, 2000);
							    }else {
								//swal("Action failed",output.message, "error");
								swal("Action failed",target.message, "error");
									
								
							}
					}
				});
		 
	 }
                     /*********************************END QTY*****************************************/								 
								
							}
					}
				});
		 
	 }else{
		 alert('please select all field');
	 }
   });
   </script>
   
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
    <!-- /.content-wrapper-->
    <?php
	 include ('footer.php');
	?>
	
	
	
	<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title text-left" id="myModalLabel">Edit</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="    background: none; margin: 0px;">
        <div class="row ">	   
			<div class="col-sm-6">
				<label for="defaultFormLoginEmailEx" class="grey-text">Year</label>
					<select class="form-control">
						<option>2016</option>
						<option>2017</option>
						<option>2018</option>
					</select>
			</div>
			<div class="col-sm-6">
				<label for="defaultFormLoginEmailEx" class="grey-text">Month</label>
					<select class="form-control">
						<option>Jan</option>
						<option>Feb</option>
						<option>Mar</option>
						<option>Apr</option>
						<option>May</option>
						<option>Jun</option>
						<option>July</option>
						<option>Aug</option>
						<option>Sep</option>
						<option>Out</option>
						<option>Nov</option>
						<option>Dec</option>
					</select>
			</div>
			
			
			
			
			<div class="col-sm-6">
				<label for="defaultFormLoginEmailEx" class="grey-text">Manager</label>
				<select class="form-control">
						<option>Manager 1</option>
						<option>Manager 2</option>
					</select>
			</div>
			
			<div class="col-sm-6">
				<label for="defaultFormLoginEmailEx" class="grey-text">Amount</label>
				<input type="email" id="defaultFormLoginEmailEx" class="form-control" placeholder="50,000">
			</div>
			
			
			
			
			
			
			
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>