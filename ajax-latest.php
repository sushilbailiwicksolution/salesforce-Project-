 <?php
include('config.php');
if(isset($_REQUEST['page']) && $_REQUEST['page']=='non_assign_retailer'){
	$url="http://".$baseurl."/salesforceapi/getRetailer";
	$form_designation=array('distributerId'=>'1');
	$designation_string=json_encode($form_designation);
	$header=array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$data=curl_exec($ch);
	curl_close($ch);
	$rowdata=json_decode($data);
	print_r($data);
 }

  if(isset($_REQUEST['page']) && $_REQUEST['page']=='getsrroute'){
		extract($_POST);
		$form_data=array(
					'managerid'=>$managerid,
					'asmId'=>$asmId,
					'tsmid'=>$tsmid
			);
	$data_string = json_encode($form_data);
	//print_r($data_string); die;
	$url="http://".$baseurl."/salesforceapi/getNonAssignedRouteSR";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	//print_r($output); die;
	curl_close($ch);
	$rowdata=json_decode($output);
	$option='';
	foreach($rowdata->lstMemberResponse as $value){
			  $option.="<option value='".$value->employeeId."'>".$value->employeeName."</option>";
		
	}
	echo $option;
}
 
 if(isset($_REQUEST['page']) && $_REQUEST['page']=='create_route'){
		extract($_POST);
		$form_data=array(
		            'routeName'=>$route_name,
					'srId'=>$srId,
					'managerId'=>$manager_id,
					'asmId'=>$asm_id,
					'tsmId'=>$tsm_id,
					'createdbyid'=>1,
					'distributerid'=>1,
					'retailerId'=>$retailerIds,
			);
	$data_string = json_encode($form_data);
	//print_r($data_string); //die;
	$url="http://".$baseurl."/salesforceapi/addRoute";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}

 if(isset($_REQUEST['page']) && $_REQUEST['page']=='admin_login'){
		extract($_POST);
		$form_data=array(
		            'emailId'=>$username,
					'password'=>$password,
					'deviceId'=>'',
					'deviceName'=>'',
					'imeiId'=>'',
					'fcmId'=>''
			);
	$data_string = json_encode($form_data);
	$url="http://".$baseurl."/salesforceapi/loginRequest";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);$uData=array(); $login_array=array();
	$uData=json_decode($output);
	//echo '<pre>';print_r($uData); die;
	if($uData->statusCode==0){
		 session_start();
		 $login_array=array(
		      
			     'distributerId'=> $uData->distributerId,
			     'employeeId'=> $uData->employeeId,
			     'roleId'=>$uData->roleId ,
			     'statusCode'=> $uData->statusCode,
				 'status'=>$uData->status
		 );
		 
         $_SESSION['userData']=$login_array;
		
	}
	print_r($output);
	die;
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='verify_retailer'){
		extract($_POST);
			
		$form_data=array(
		            'retailerId'=>$retailerId,
					
					'isVerified'=>$verifyid,
					'latitude'=>'',
					'longitude'=>'',
					);
		$data_string = json_encode($form_data);  
		
	$url="http://".$baseurl."/salesforceapi/verifyRetailer";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='default_member'){
		extract($_POST);
			
		$form_data=array(
		            'retailerId'=>$_POST['retailerId'],
					'opertaionById'=>1,
					'remarks'=>'just like that'
					);
		$data_string = json_encode($form_data);  
		
	$url="http://".$baseurl."/salesforceapi/makeRetailerDefaulter";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}

 
 if(isset($_REQUEST['page']) && $_REQUEST['page']=='undefault_member'){
		extract($_POST);
			
		$form_data=array(
		            'retailerId'=>$_POST['retailerId']
					);
		$data_string = json_encode($form_data);  
		
	$url="http://".$baseurl."/salesforceapi/makeRetailerUnDefaulter";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}
 
if(isset($_REQUEST['page']) && $_REQUEST['page']=='active_member'){
		extract($_POST);
			
		$form_data=array(
		            'retailerId'=>$_POST['retailerId']
					);
		$data_string = json_encode($form_data);  
		
	$url="http://".$baseurl."/salesforceapi/makeRetailerActive";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}
 
 if(isset($_REQUEST['page']) && $_REQUEST['page']=='inactive_member'){
		extract($_POST);
			
		$form_data=array(
		            'retailerId'=>$_POST['retailerId']
					);
		$data_string = json_encode($form_data);  
		
	$url="http://".$baseurl."/salesforceapi/makeRetailerInactive";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='block_member'){
		extract($_POST);
			
		$form_data=array(
		            'retailerId'=>$_POST['retailerId'],
					'opertaionById'=>1,
					'remarks'=>'just like that'
					);
		$data_string = json_encode($form_data);  
		
	$url="http://".$baseurl."/salesforceapi/makeRetailerBlocked";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}
 
 if(isset($_REQUEST['page']) && $_REQUEST['page']=='unblock_member'){
		extract($_POST);
			
		$form_data=array(
		            'retailerId'=>$_POST['retailerId']
					);
		$data_string = json_encode($form_data);  
		
	$url="http://".$baseurl."/salesforceapi/makeRetailerUnBlocked";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_role'){
		extract($_POST);
			
		$form_data=array('name'=>$name,
					'description'=>$description);
			$data_string = json_encode($form_data);  

	$url="http://".$baseurl."/salesforceapi/addRole";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
	
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_designation'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addDesignation";
	$header=array(
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $designation=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($designation);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_retailertype'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addRetailerType";
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
	 $retailer=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailer);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_retailersubtype'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addRetailerSubType";
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
	 $retailersubtype=curl_exec($ch);
	curl_close($ch);
	print_r($retailersubtype);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_category'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addRetaileCat";
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
	 $retailercategory=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailercategory);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_retailerzone'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addZone";
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
	 $retailerzone=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailerzone);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='create_team'){
	//if(isset($_POST['page']) && $_POST['page']=='create_team'){
	extract($_POST);
	//print_r($_POST); die;
	$manager_team=array('employeeName'=>$fname.$lname,'emailId'=>$email,'mobile'=>$phone,'alternatemobileNumber'=>$mobile,'adddress'=>$address,'joiningDate'=>$doj,'roleId'=>$role,'password'=>$password,'designationId'=>$designation,'empId'=>$emp_id,'reportTo'=>$report,'state'=>$state,'distributerId'=>$distributerid);
	
	$manager_string=json_encode($manager_team);  
	$url="http://".$baseurl."/salesforceapi/addMember";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$manager_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $managerdata=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($managerdata);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='create_team_all'){
	extract($_POST);
	
	$manager_team=array('employeeName'=>$fname.$lname,'emailId'=>$email,'mobile'=>$phone,'alternatemobileNumber'=>$mobile,'adddress'=>$address,'joiningDate'=>$doj,'roleId'=>$role,'password'=>$password,'designationId'=>$designation,'empId'=>$emp_id,'reportTo'=>$report,'state'=>$state,'distributerId'=>$distributerid);
	
	$manager_string=json_encode($manager_team);  
	$url="http://".$baseurl."/salesforceapi/addMember";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$manager_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $managerdata=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($managerdata);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getReport')
{
	extract($_POST);
	//print_r($_POST); die;
	$form_designation=array('roleId'=>$roleid,'distributerId'=>'1');
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getTeamByRole ";
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
	$option="<option value=''>Report</option>";
	$option.="<option value='1'>Admin</option>";
	$option.="<option value='-5'>Self</option>";
	$getreport=curl_exec($ch);
	curl_close($ch);
	//print_r($getreport);
	$rowdata=json_decode($getreport);
	foreach($rowdata->lstMemberResponse as $value){
		$option.="<option value='".$value->employeeId."'>".$value->employeeName."</option>";
	}
	echo $option;
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getManagers')
{
	extract($_POST);
	//print_r($_POST); die;
	$form_designation=array('roleId'=>'37','distributerId'=>'1');
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getTeamByRole ";
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
	$option="<option value=''>Report</option>";
	//$option.="<option value='1'>Admin</option>";
	//$option.="<option value='-5'>Self</option>";
	$getreport=curl_exec($ch);
	curl_close($ch);
	//print_r($getreport);
	$rowdata=json_decode($getreport);
	foreach($rowdata->lstMemberResponse as $value){
		$option.="<option value='".$value->employeeId."'>".$value->employeeName."</option>";
	}
	echo $option;
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getAsmteam')
{
	extract($_POST);
	//print_r($_POST); die;
	//print_r($_GET['page']); print_r($_GET['managerid']);die;
	if($_REQUEST['req']=='2'){
		$form_designation=array('roleId'=>'37','id'=>$_GET['managerid']);
		$url="http://".$baseurl."/salesforceapi/getListForProfile";
	}else{
		$form_designation=array('roleId'=>'38','distributerId'=>'1');
		$url="http://".$baseurl."/salesforceapi/getTeamByRole";
	}
	//$form_designation=array('roleId'=>'38','distributerId'=>'1');
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$asmid= ' asmid: ' . $asmid;
	error_log($asmid,3,'meralog.log');
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
	$getreport=curl_exec($ch);
	curl_close($ch);
	//print_r($getreport);
	$rowdata=json_decode($getreport);
	//print_r($rowdata); die;
	
	$option="<option value=''>Select ASM</option>";
	//$option.="<option value='1'>Admin</option>";
	//$option.="<option value='-5'>Self</option>";
	
	foreach($rowdata->lstMemberResponse as $value){
		  if($value->roleId==38){
			  $option.="<option value='".$value->employeeId."'>".$value->employeeName."</option>";
		  }
		
	}
	echo $option;
}
/****************************************GET TSM TEAM LIST BY ASM ID******************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='gettsmteam')
{
	extract($_POST);
	//print_r($_POST); die;
	//$form_designation=array('roleId'=>'39','distributerId'=>'1');
	if($_REQUEST['req']=='3'){
		$form_designation=array('roleId'=>'38','id'=>$_GET['asmid']);//asm id
		$url="http://".$baseurl."/salesforceapi/getListForProfile";
	}else{
		$form_designation=array('roleId'=>'39','distributerId'=>'1');
		$url="http://".$baseurl."/salesforceapi/getTeamByRole";
	}
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	//$url="http://103.206.248.235/salesforceapi/getTeamByRole";
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
	$option="<option value=''>Select TSM</option>";
	//$option.="<option value='1'>Admin</option>";
	//$option.="<option value='-5'>Self</option>";
	$getreport=curl_exec($ch);
	curl_close($ch);
	//print_r($getreport);
	$rowdata=json_decode($getreport);
	foreach($rowdata->lstMemberResponse as $value){
		  if($value->roleId==39){
			  $option.="<option value='".$value->employeeId."'>".$value->employeeName."</option>";
		  }
		
	}
	echo $option;
}
/*****************************************************END TSM LIST DETAILS***************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getsrteam')
{
	extract($_POST);
	//print_r($_POST); die;
	//$form_designation=array('roleId'=>'39','distributerId'=>'1');
	if($_REQUEST['req']=='3'){
		$form_designation=array('roleId'=>'39','id'=>$_GET['tsmid']);
		$url="http://".$baseurl."/salesforceapi/getListForProfile";
	}else{
		$form_designation=array('roleId'=>'40','distributerId'=>'1');
		$url="http://".$baseurl."/salesforceapi/getTeamByRole";
	}
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	//$url="http://103.206.248.235/salesforceapi/getTeamByRole";
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
	$option="<option value=''>Select SR</option>";
	//$option.="<option value='1'>Admin</option>";
	//$option.="<option value='-5'>Self</option>";
	$getreport=curl_exec($ch);
	curl_close($ch);
	//print_r($getreport);
	$rowdata=json_decode($getreport);
	foreach($rowdata->lstMemberResponse as $value){
		  if($value->roleId==40){
			  $option.="<option value='".$value->employeeId."'>".$value->employeeName."</option>";
		  }
		
	}
	echo $option;
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_retailers'){
	//echo "hii";
	extract($_POST);
	
	//print_r($_POST); die;
	$form_retailer=array('retailerShopname'=>$retailer_licence_name,'contactPersaonName1'=>$person_name_one,'contactPersaonName2'=>$person_name_two,'contactPersaonName3'=>$person_name_three,'retailerExciseCode'=>$retailer_excise_code,'retailerEmailId'=>$retailer_email,'creditDays'=>$credit_days,'mobileNumber'=>$mobile_one,'alternateMobileNumber1'=>$mobile_two,'alternateMobileNumber2'=>$mobile_three,'landline'=>$landline_no,'locality'=>$locality,'street'=>$street,'city'=>$city,'distinct'=>$district,'pincode'=>$pin_code,'zoneId'=>$zone,'stateId'=>$state,'typeId'=>$type,'subTypeId'=>$sub_type,'categoryid'=>$category,'groupId'=>$group_name,'managerId'=>$manager,'asmId'=>$asm,'tsmId'=>$tsm,'srId'=>$route_name,'distributerId'=>$distributerid);
	$retailer_string=json_encode($form_retailer);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addRetaler";
	$header=array(
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$retailer_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailer=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailer);
	die;
	
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_groupname'){
$form_designation=array('distributerId'=>'1');
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getAllGroup";
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
$getreport=curl_exec($ch);
curl_close($ch);
//print_r($getreport);
$rowdata=json_decode($getreport);
//print_r($rowdata);
foreach($rowdata->lstRetailerRawData as $value){
$option.="<option value='".$value->retailerId."'>".$value->retailerName."</option>";
}
echo $option;
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_group'){
	
	extract($_POST);
	//print_r($_POST); die;
	$isgroup='2';	
	//$uniqueexcise=uniqid();
	$form_retailer=array('retailerShopname'=>$group_name,'contactPersaonName1'=>$contact_preson_name1,'contactPersaonName2'=>$contact_preson_name2,'contactPersaonName3'=>$contact_preson_name3,'retailerEmailId'=>$group_email,'creditDays'=>$credit_days,'mobileNumber'=>$mobile_one,'alternateMobileNumber1'=>$mobile_two,'alternateMobileNumber2'=>$mobile_three,'landline'=>$landline,'locality'=>$locality,'street'=>$street,'city'=>$city,'distinct'=>$district,'pincode'=>$pin_code,'zoneId'=>$zone,'stateId'=>$state,'managerId'=>$manager,'asmId'=>$asm,'tsmId'=>$tsm,'isGroup'=>$isgroup,'srId'=>$route_name,'distributerId'=>$distributerid,'retailerExciseCode'=>$group_code);
	$retailer_string=json_encode($form_retailer);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addRetaler";
	$header=array(
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$retailer_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $group=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($group);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_brand'){
	
	extract($_POST);
	
	$form_brand=array('brandName'=>$brand_name,'brandCode'=>$brand_code,'internalBrandCode'=>$internal_brand_code,'principal'=>$principle,'licenseId'=>$license,'brandowner'=>$brand_owner,'description'=>$description,'stateId'=>$state,'distributerId'=>$distributerid);
	
	$brand_string=json_encode($form_brand);
	
	$url="http://".$baseurl."/salesforceapi/addBrand";
	$header=array(
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $brand=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($brand);
	die;
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_products'){
	
	extract($_POST);
	
	$form_product=array('productName'=>$product_name,'branId'=>$brand_name,'productCategoryId'=>$product_category,'qtyMl'=>$qyt_ml,'boxSize'=>$number,'productStatus'=>$status,'createById'=>$employee,'distributerId'=>$distributerid,'packagetypeId'=>$package_type,'productCode'=>$product_code,'cif'=>$ex_factory,'wsp'=>$wholesale_price,'mrp'=>$maximum_retail,'productSegmentCode'=>$product_segment,'productTypeId'=>$pro_type,'productSubtypeid'=>$subtype,'exciseDuty'=>$excise_duty,'licenseId'=>$license);
	//productSubtypeid
	$product_string=json_encode($form_product);
	
	$url="http://".$baseurl."/salesforceapi/addProduct";
	$header=array(
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$product_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $product=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($product);
	die;
}


if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_license_name'){
	extract($_POST);
	$id=$_GET['license'];
	//echo $id; die;
	
$form_designation=array('distributerId'=>'1','licenseId'=>$id);
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getBrand";
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

$option_name='';	
$option_name='<option value="">Select Brand Name</option>';

$option='';	
$option='<option value="">Select Brand Code</option>';

$option_internal='';
$option_internal='<option value="">Select Internal Brand Code</option>';	
$brand=curl_exec($ch);
curl_close($ch);
//print_r($brand); die;
$getbrand=json_decode($brand);
//print_r($getbrand); die;

$brandName=array();
foreach($getbrand->brandList as $value){
	$select1='';
	if( $id == $value->brandId ){
		$select1='selected';
	}
	$brandName[]='<option value="' . $value->brandId . '" ' . $select1 . ' >' . $value->brandName .'</option>' ;	
}

foreach($brandName as $value){
	$option_name.=$value;
}

$brandList=array();
foreach($getbrand->brandList as $value){
	$select1='';
	if( $id == $value->brandId ){
		$select1='selected';
	}
	$brandList[]='<option value="' . $value->brandId . '" ' . $select1 . ' >' . $value->brandCode .'</option>' ;	
}

foreach($brandList as $value){
	$option.=$value;
}


$internal_brand_code=array();
foreach($getbrand->brandList as $value){
	$select='';
	if( $id == $value->brandId ){
		$select='selected';
	}
	$internal_brand_code[]='<option value="' . $value->brandId . '" ' . $select . ' >' . $value->internalBrandCode .'</option>' ;	
}

foreach($internal_brand_code as $value){
	$option_internal.=$value;
}
$response_array=array('brand_id'=>$option,'internal_brand'=>$option_internal,'brand_name'=>$option_name);
echo json_encode($response_array);

}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_internal_brand_name'){
	extract($_POST);
	$id=$_GET['internal_brand_code'];
	//echo $id; die;
	
$form_designation=array('distributerId'=>'1');
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getBrand";
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
$option='<option value="">Select Brand Code</option>';
$option_name='';
$option_name='<option value="">Select Brand Name</option>';	

$license_option='';	
$license_option='<option value="">Select License</option>';

$brand=curl_exec($ch);
curl_close($ch);
//print_r($getreport);
$getbrand=json_decode($brand);
//print_r($getbrand);

$brandList=array();
foreach($getbrand->brandList as $value){
	$select1='';
	if( $id == $value->brandId ){
		$select1='selected';
	}
	$brandList[]='<option value="' . $value->brandId . '" ' . $select1 . ' >' . $value->brandCode .'</option>' ;	
}

foreach($brandList as $value){
	$option.=$value;
}


$brand_name=array();
foreach($getbrand->brandList as $value){
	$select='';
	if( $id == $value->brandId ){
		$select='selected';
	}
	$brand_name[]='<option value="' . $value->brandId . '" ' . $select . ' >' . $value->brandName .'</option>' ;	
}

foreach($brand_name as $value){
	$option_name.=$value;
}

$licenseList=array(); $arr=array();
foreach($getbrand->brandList as $value){
	$select2='';
	if( $id == $value->brandId ){
		$select2='selected';
	}
	
	if(!in_array($value->licenseId,$arr,TRUE)){
		
	$licenseList[]='<option value="' . $value->licenseId . '" ' . $select2 . ' >' . $value->licenseName .'</option>' ;
	}	
	array_push($arr,$value->licenseId);
}

foreach($licenseList as $value){
	$license_option.=$value;
}

$response_array=array('brand_id'=>$option,'internal_brand'=>$option_name,'license_name'=>$license_option);
echo json_encode($response_array);

}


if(isset($_REQUEST['page']) && $_REQUEST['page']=='getbrandname'){
	extract($_POST);
	$id=$_GET['brand_code'];
	//echo $id; die;
	
$form_designation=array('distributerId'=>'1');
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getBrand";
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
$option='<option value="">Select Brand Name</option>';
$option_internal='';
$option_internal='<option value="">Select Internal Brand Code</option>';	

$license_option='';	
$license_option='<option value="">Select License</option>';

$brand=curl_exec($ch);
curl_close($ch);
//print_r($getreport);
$getbrand=json_decode($brand);
//print_r($getbrand);

$brandList=array();
foreach($getbrand->brandList as $value){
	$select1='';
	if( $id == $value->brandId ){
		$select1='selected';
	}
	$brandList[]='<option value="' . $value->brandId . '" ' . $select1 . ' >' . $value->brandName .'</option>' ;	
}

foreach($brandList as $value){
	$option.=$value;
}


$internal_brand_code=array();
foreach($getbrand->brandList as $value){
	$select='';
	if( $id == $value->brandId ){
		$select='selected';
	}
	$internal_brand_code[]='<option value="' . $value->brandId . '" ' . $select . ' >' . $value->internalBrandCode .'</option>' ;	
}

foreach($internal_brand_code as $value){
	$option_internal.=$value;
}

$licenseList=array(); $arr=array();
foreach($getbrand->brandList as $value){
	$select2='';
	if( $id == $value->brandId ){
		$select2='selected';
	}
	
	if(!in_array($value->licenseId,$arr,TRUE)){
		
	$licenseList[]='<option value="' . $value->licenseId . '" ' . $select2 . ' >' . $value->licenseName .'</option>' ;
	}	
	array_push($arr,$value->licenseId);
}

foreach($licenseList as $value){
	$license_option.=$value;
}

$response_array=array('brand_id'=>$option,'internal_brand'=>$option_internal,'license_name'=>$license_option);
echo json_encode($response_array);

}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='getbrandcode'){
	extract($_POST);
	$id=$_GET['brandid'];
	//echo $id; die;
	
$form_designation=array('distributerId'=>'1');
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getBrand";
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
$option='<option value="">Select Brand Code</option>';
$option_internal='';
$option_internal='<option value="">Select Internal Brand Code</option>';
$license_option='';	
$license_option='<option value="">Select License</option>';	
$brand=curl_exec($ch);
curl_close($ch);
//print_r($getreport);
$getbrand=json_decode($brand);
//print_r($getbrand);

$brandList=array();
foreach($getbrand->brandList as $value){
	$select1='';
	if( $id == $value->brandId ){
		$select1='selected';
	}
	$brandList[]='<option value="' . $value->brandId . '" ' . $select1 . ' >' . $value->brandCode .'</option>' ;	
}

foreach($brandList as $value){
	$option.=$value;
}


$internal_brand_code=array();
foreach($getbrand->brandList as $value){
	$select='';
	if( $id == $value->brandId ){
		$select='selected';
	}
	$internal_brand_code[]='<option value="' . $value->brandId . '" ' . $select . ' >' . $value->internalBrandCode .'</option>' ;	
}

foreach($internal_brand_code as $value){
	$option_internal.=$value;
}

$licenseList=array(); $arr=array();
foreach($getbrand->brandList as $value){
	$select2='';
	if( $id == $value->brandId ){
		$select2='selected';
	}
	
	if(!in_array($value->licenseId,$arr,TRUE)){
		
	$licenseList[]='<option value="' . $value->licenseId . '" ' . $select2 . ' >' . $value->licenseName .'</option>' ;
	}	
	array_push($arr,$value->licenseId);
}

foreach($licenseList as $value){
	$license_option.=$value;
}

$response_array=array('brand_id'=>$option,'internal_brand'=>$option_internal,'license_name'=>$license_option);
echo json_encode($response_array);

}


if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_pro_type_name'){
	extract($_POST);
	$id=$_GET['pro_type'];
	//echo $id; die;
	
$url="http://".$baseurl."/salesforceapi/getQtyPcs";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
//curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
); 
$option='';	
$option='<option value="">Select QTY</option>';
$option_name='';
$option_name='<option value="">Select </option>';	

$brand=curl_exec($ch);
curl_close($ch);
$getbrand=json_decode($brand);

$brandList=array();
foreach($getbrand->listQtyInPcs as $value){

	$brandList[]='<option value="' . $value->id . '">' . $value->qtyMl .'</option>' ;	
}

foreach($brandList as $value){
	$option.=$value;
}


$brand_name=array();
foreach($getbrand->listQtyInPcs as $value){
	$brand_name[]='<option value="' . $value->id . '">'.$value->pcs.'</option>' ;	
}

foreach($brand_name as $value){
	$option_name.=$value;
}

$response_array=array('qty'=>$option,'qty_num'=>$option_name);
echo json_encode($response_array);
}


if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_feedback'){
		extract($_POST);
			
		$form_data=array('name'=>$name,
					'description'=>$description);
			$data_string = json_encode($form_data);  

	$url="http://".$baseurl."/salesforceapi/addFeedbackType";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
	
}


if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_feedback_rating'){
		extract($_POST);
			
		$form_data=array('name'=>$name,
					'description'=>$description);
			$data_string = json_encode($form_data);  

	$url="http://".$baseurl."/salesforceapi/addFeedbackRating";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='delete_member'){
	extract($_POST);
	//print_r($_POST); die;
	$employee_data=array('id'=>$employeeid);
	$employee_string=json_encode($employee_data);
	
	$url="http://".$baseurl."/salesforceapi/deleteTeamMember";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$employee_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='delete_designation'){
	extract($_POST);
	//print_r($_POST); die;
	$designation_data=array('id'=>$designationid);
	$designation_string=json_encode($designation_data);
	
	$url=" http://".$baseurl."/salesforceapi/deleteDesignation";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}


if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_allmember'){
	
	extract($_POST);
	//print_r($_POST); die;
	$designation_data=array('updateById'=>$update_id,'employeeId'=>$empl_id,'employeeName'=>$employeename,'mobile'=>$mobile,'alternatemobileNumber'=>$alternatemobile,'adddress'=>$address,'state'=>$state,'joiningDate'=>$doj,'designationId'=>$designation,'reportTo'=>$report,'roleId'=>$role_id);
	$designation_string=json_encode($designation_data);
	$url="http://".$baseurl."/salesforceapi/updateMember";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updatemember=curl_exec($ch);
	curl_close($ch);
	print_r($updatemember);
	die;
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='getManagersbyASM')
{
	extract($_POST);
	//print_r($_GET); die;
	$managerid=$_GET['asmid'];
	//echo $managerid;
	
	$form_designation=array('roleId'=>'37','distributerId'=>'1');
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	
	$url="http://".$baseurl."/salesforceapi/getTeamByRole ";
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
$option='<option value="">Select Managers</option>';

$managers=curl_exec($ch);
curl_close($ch);
$getmanagers=json_decode($managers);
//print_r($getmanagers);
$managerList=array();
foreach($getmanagers->lstMemberResponse as $value){
	$select='';
	if( $managerid == $value->employeeId ){
		$select='selected';
		
	}
	
	$managerList[]='<option value="' . $value->employeeId . '" ' . $select . ' >' . $value->employeeName .'</option>' ;
	//$managerList[]='<option value="' . $value->employeeId . '" ' . $select . ' >' . $value->employeeName .'</option>' ;	
}

foreach($managerList as $value){
	$option.=$value;
}
$response_array=array('employee_id'=>$option);
echo json_encode($response_array);
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_designation'){
	
	extract($_POST);
	//print_r($_POST); die;
	$designation_data=array('id'=>$desgination_id,'name'=>$name,'description'=>$description,'detailStatus'=>$status);
	$designation_string=json_encode($designation_data);
	$url="http://".$baseurl."/salesforceapi/updateDesignation";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updateDesignation=curl_exec($ch);
	curl_close($ch);
	print_r($updateDesignation);
	die;
	
}



if(isset($_REQUEST['page']) && $_REQUEST['page']=='team_activity'){
	extract($_POST);
	$form_team_activity=array('retailerId'=>60,'fromDate'=>$from_date,'toDate'=>$to_date);
	$team_activity_string=json_encode($form_team_activity);
	$url="http://".$baseurl."/salesforceapi/getTeamActivityHistoryBy";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$team_activity_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $team_activity=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($team_activity);
	die;
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_product'){
	extract($_POST);
	$form_update_product=array('productId'=>$productID,'branId'=>$brand_name,'productCode'=>$product_code,'productCategoryId'=>$product_category,'productSegmentCode'=>$product_segment,'qtyMl'=>$qyt_ml,'boxSize'=>$number,'productStatus'=>$status,'updateById'=>$updateID,'packagetypeId'=>$package_type,'productTypeId'=>$pro_type,'cif'=>$ex_factory,'wsp'=>$wholesale_price,'mrp'=>$maximum_retail,'exciseDuty'=>$excise_duty,'licenseId'=>$license,'productSubtypeid'=>$subtype);
	$update_product_string=json_encode($form_update_product);
	$url="http://".$baseurl."/salesforceapi/updateProduct";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$update_product_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updateProduct=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($updateProduct);
	die;
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_survey'){
	extract($_POST); 
	//print_r($_POST);die;
	$survey=array('distributerId'=>$distributerid,'description'=>$description,'startDate'=>$start_date,'endDate'=>$end_date,'title'=>$title);	
	$survey_string=json_encode($survey);	
	//echo $designation_string;
	$url="http://".$baseurl."./salesforceapi/addSurvey";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$survey_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$survey=curl_exec($ch);	 
	curl_close($ch);
	//echo $designation;
	print_r($survey);
	die;
}
// bhanu added code //
	
	if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_productbybrandId'){
	extract($_POST);
	//print_r($_GET); die;
	$id=$_GET['brandid'];
	//print_r($id);	
$form_designation=array('distributerId'=>'1','brandId'=>$id);
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getProduct";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
); 
$option='';	
$option.='<option value="">Select Product</option>';

$product=curl_exec($ch);
curl_close($ch);
//print_r($product);
$getproduct=json_decode($product);
//print_r($getproduct);


$productlist=array();
foreach($getproduct->listProduct as $value){
	//$select='';
	if( $id == $value->branId ){
		//$select='selected';
	}
	$productlist[]='<option value="' . $value->productId . '" >' . $value->productName .'</option>' ;	
	//print_r($productlist);
}

foreach($productlist as $value){
	$option.=$value;
}

$response_array=array('productID'=>$option);
echo json_encode($response_array);

}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_assets'){
	extract($_POST);
	$form_assets=array('assetType'=>$assets_type,'assetName'=>$assets,'productId'=>$product,'brandId'=>$brand_name,'description'=>$description,'distributorId'=>$distributerid);
	$assets_string=json_encode($form_assets);
	$url="http://".$baseurl."/salesforceapi/addAsset ";
	$header=array('Accept: application/json',
	'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$assets_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
	'Content-Type: application/json')                                                                    
	); 
	$addAsset=curl_exec($ch);	 
	curl_close($ch);
	//echo $designation;
	print_r($addAsset);
	die;
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='assign_assets'){
	extract($_POST);
	//error_log("post data is ".print_r($_POST,true));
	//print_r($_POST);die;
	$form_assets=array('assetId'=>$assets,'qty'=>$qty,'amount'=>$amount,'retailerList'=>$retailer_list);
	//print_r($form_assets);
	$assets_string=json_encode($form_assets);
	$url="http://".$baseurl."/salesforceapi/assignAssets";
	$header=array('Accept: application/json',
	'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$assets_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
	'Content-Type: application/json')                                                                    
	); 
	$assignAssets=curl_exec($ch);	 
	curl_close($ch);
	//echo $designation;
	print_r($assignAssets);
	die;
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_assetsbyproductId'){
	extract($_POST);
	//print_r($_GET); die;
	$id=$_GET['proid'];
	//print_r($id);	
$form_designation=array('distributerId'=>'1','id'=>$id);
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getAsset";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
); 
$option='';	
$option.='<option value="">Select Asset</option>';

$assets=curl_exec($ch);
curl_close($ch);
//print_r($product);
$getassets=json_decode($assets);
//print_r($getproduct);


$assetslist=array();
foreach($getassets->listAssetByretailerData as $value){
	//$select='';
	if( $id == $value->id ){
		//$select='selected';
	}
	$assetslist[]='<option value="' . $value->id . '"  >' . $value->assetName .'</option>' ;	
	//print_r($productlist);
}

foreach($assetslist as $value){
	$option.=$value;
}

$response_array=array('assetsID'=>$option);
echo json_encode($response_array);

}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_brand'){
	extract($_POST);
	$form_update_product=array('brandId'=>$brandid,'brandName'=>$brand_name,'brandCode'=>$brand_code,'internalBrandCode'=>$internal_brand_code,'principal'=>$principle,'licenseId'=>$license,'brandowner'=>$brand_owner,'description'=>$description,'stateId'=>$state);
	$update_product_string=json_encode($form_update_product);
	$url="http://".$baseurl."/salesforceapi/updateProduct";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$update_product_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updateProduct=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($updateProduct);
	die;
}

// bhanu added code //



// Prince Start/////////////Please Stop
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_product_pacakage_type'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addPackagetype";
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
	 $retailer=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailer);
	die;
	
}
/// Add product sub type
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_product_sub_type'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addProductSubType";
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
	 $retailer=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailer);
	die;
	
}

/// Add product Piece and Qty
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_product_peice_qty'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('qtyMl'=>$product_ml,'pcs'=>$product_pieces,'description'=>$product_description);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addQtyPcs";
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
	 $retailer=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailer);
	die;
	
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_product_page'){
	extract($_POST);
	//print_r($_POST); die;
	$id=$_GET['brandid'];
	//print_r($id);
	
$form_designation=array('distributerId'=>'1');
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getProduct";
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
//	$option.="<option value='1'>Admin</option>";
	//$option.="<option value='-5'>Self</option>";
	$getproduct=curl_exec($ch);
	curl_close($ch);
	//print_r($getreport);
	$rowdata=json_decode($getproduct);
	foreach($rowdata->listProduct as $value){
		$option.="<option value='".$value->productId."'>".$value->productName."</option>";
	}
	echo $option;
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_product_segment'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addProductSegment";
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
	 $retailer=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailer);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_product_catagory'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addProductCategory";
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
	 $retailer=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailer);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_product_pack_type'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addProductType";
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
	 $retailer=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailer);
	die;
	
}
// Prince End///////////////

//awdhesh stat
/******************************************************ADD TARGET****************************************************************************/

if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_target'){
	extract($_POST);
	//print_r($_POST);die;
	$form_update_product=array('targetMonth'=>$month,'targetYear'=>$year,'brandId'=>$brand_name,'qty'=>$cases,'assignId'=>$manager,'createdById'=>$employee,'roleId'=>37);
	$update_product_string=json_encode($form_update_product);
	$url="http://".$baseurl."/salesforceapi/addTarget";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$update_product_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updateProduct=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($updateProduct);
	die;
}

/*************************************************************END ADD TARGET************************************************************************/


/************************************************************ADD TEAM TARGET FOR ASM****************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_team_target'){
	//echo '<pre>';print_r($_POST);die;
	extract($_POST);
	//print_r($_POST);die;
	$form_update_product=array('targetMonth'=>$month,'targetYear'=>$year,'brandId'=>$brand_name,'qty'=>$cases,'assignId'=>$employee,'createdById'=>$manager,'roleId'=>37);
	$update_product_string=json_encode($form_update_product);
	$url="http://".$baseurl."/salesforceapi/addTarget";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$update_product_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updateProduct=curl_exec($ch);
	curl_close($ch);
	//echo $designation;
	print_r($updateProduct);
	$qty=$_POST['restCase'];
	$brand_id=$_POST['brand_name'];
	$manager_id=$_POST['manager'];
	$query="update from tbl_target set target_qty=".$qty." where assigned_id=".$manager_id." and brand_id=".$brand_id."";
	$result=mysqli_query($conn,$query);
	die;
}
/*************************************************************END TEAM TARGET FOR ASM END***********************************************************/	
	
	if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_retailer'){
		extract($_POST);
		//print_r($_POST);die;
		
		$form_update_retailer=array('retailerId'=>$retailerID,'retailerShopname'=>$retailer_shop,'contactPersaonName1'=>$contact_person_name,'creditDays'=>$credit_days,'retailerEmailId'=>$retailer_email,'mobileNumber'=>$mobile_one,'alternateMobileNumber1'=>$mobile_two,'alternateMobileNumber2'=>$mobile_three,'landline'=>$landline_no,'srId'=>$route_name,'tsmId'=>$tsm,'asmId'=>$asm,'typeId'=>$type,'subTypeId'=>$sub_type,'categoryid'=>$category,'locality'=>$locality,'street'=>$street,'city'=>$city,'pincode'=>$pin_code,'zoneId'=>$zone,'updatedById'=>$updateID,'distributerId'=>$distributerid,'retailerExciseCode'=>$retailer_excise_code,'managerId'=>$manager,'isGroup'=>$group,'groupId'=>$group_name);
		
		$update_retailer_string=json_encode($form_update_retailer);
		//print_r($update_retailer_string);
		$url="http://".$baseurl."/salesforceapi/updateRetailer";
		$header=array('Accept: application/json',
			'Content-Type: application/json');
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($ch,CURLOPT_POSTFIELDS,$update_retailer_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
		curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
			'Content-Type: application/json')                                                                    
		);                               		
		 $updateRETAILER=curl_exec($ch);
		 
		curl_close($ch);
		//echo $designation;
		print_r($updateRETAILER);
		die;
	}
		if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_scheme'){
		extract($_POST);
		//print_r($_POST);die;
		$form_scheme=array('title'=>$title,'retailerList'=>$retailer_list,'description'=>$description,'fromDate'=>$from_date,'toDate'=>$to_date,'brandId'=>$brand_id,'productId'=>$product_id);
		$scheme_string=json_encode($form_scheme);
		$url="http://".$baseurl."/salesforceapi/addScheme";
		$header=array('Accept: application/json',
			'Content-Type: application/json');
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($ch,CURLOPT_POSTFIELDS,$scheme_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
		curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
			'Content-Type: application/json')                                                                    
		);                               		
		 $scheme=curl_exec($ch);
		 
		curl_close($ch);
		//echo $designation;
		//print_r($scheme);
		die;
	}
	
	/******************************************GET VISIT ACTIVITY BY DATE************************************************/
	if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_Date'){
     extract($_GET); 
//print_r($_GET);die;
$team_activity=array('distributerId'=>'1','roleId'=>'37','startDate'=>$fromDate,'endDate'=>$toDate);	
$team_activity_string=json_encode($team_activity);	
//echo $designation_string;
$url="http://".$baseurl."/salesforceapi/getTeamActivity";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$team_activity_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$date=curl_exec($ch);

curl_close($ch);
//echo $designation;
print_r($date);
die;
}
	/*****************************************END ***********************************************************************/
	
	/*****************************************************GET QUANTITY BY BRAND ID****************************************/
	if(isset($_POST['brand_id']) && $_POST['page']=='GetQty'){
		
		$brand_id=$_POST['brand_id'];
		$manager_id=$_POST['maneger_id'];
		$query="select * from tbl_target where brand_id=".$brand_id." AND assigned_id=".$manager_id;
		$data=mysqli_query($conn,$query);
		$d=mysqli_fetch_array($data);
		$qtyArray=array();
		array_push($qtyArray,$d);
		$qtyArray['TARGET_LIST']=$d;
		echo json_encode($qtyArray);
	}
	/******************************************************END BRAND ID****************************************************/
?>