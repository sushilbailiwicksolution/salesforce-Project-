 <?php
  session_start();
include('config.php');
error_reporting(E_ERROR | E_PARSE);
//$port='8080';
//$baseurl="103.206.248.235:".$port."";
//echo $baseurl;
//print_r($_REQUEST);

//echo 'ddddddd-'.$distibuter_session_id=$_SESSION['userData']['distributerId'];
if(isset($_REQUEST['page']) && $_REQUEST['page']=='non_assign_retailer'){
	$url="http://".$baseurl."/salesforceapi/getRetailer";
	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
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
	//print_r($data_string);die;
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	echo $output=curl_exec($ch);
	print_r($output);
	curl_close($ch);
	$rowdata=json_decode($output);
	//echo '<pre>';print_r($rowdata);
	$option='';
	$option="<option value=''>Select SR</option>";
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
					'createdbyid'=>$_SESSION['userData']['distributerId'],
					'distributerid'=>$_SESSION['userData']['distributerId'],
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}
/*===========================================================UPDATE ROUTE=======================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_route'){
		extract($_POST);
		$form_data=array(
		            'routeName'=>$route_name,
					'srId'=>$srId,
					'managerId'=>$manager_id,
					'asmId'=>$asm_id,
					'tsmId'=>$tsm_id,
					'updateById'=>$_SESSION['userData']['employeeId'],
					'distributerid'=>$_SESSION['userData']['distributerId'],
					'retailerId'=>$retailerIds,
					'routeId'=>$route_id
			);
			//echo '<pre>';print_r($form_data);
	$data_string = json_encode($form_data);
	//print_r($data_string); //die;
	$url="http://".$baseurl."/salesforceapi/updateRoute";
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}
/*===========================================================END UPDATE ROUTE===================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='admin_login'){
	error_log('user name: ',3,'mylog.log');	
	error_log($_POST['username'],3,'mylog.log');
	error_log('password: ',3,'mylog.log');	
	error_log($_POST['password'],3,'mylog.log');
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
	//print_r($data_string );
	$url="http://".$baseurl."/salesforceapi/loginRequest";
	//error_log($url,3,'mylog.log');
	//echo 'url-'.$url="http://".$baseurl."/salesforceapi/loginRequest";
	
	//error_log($url,3,'mylog.log');
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	//print_r($output);
	error_log('status: ',3,'mylog.log');
	//error_log($uData->statusCode,3,'mylog.log');
	
	curl_close($ch);
	$uData=array(); 
	$login_array=array();
	$uData=json_decode($output);

	//echo '<pre>';print_r($uData);
	if($uData->statusCode==0){
		
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
	//die;
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
		//echo '<pre>';print_r($data_string);
		
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}
 /**********************************************MAKE RETAILERS ACTIVE****************************************************/
 if(isset($_REQUEST['page']) && $_REQUEST['page']=='makeactiveRetailers'){
	     extract($_POST);
		
	     $form_data=array(
		 'retailerId'=>$retailerId,
		 'opertaionById'=>$_SESSION['userData']['employeeId']);
		 $data_string = json_encode($form_data);  
		 //echo '<pre>';print_r($form_data);
		
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
	 
 }
 /****************************************************END MAKE ALL RETAILES ACTIVE***************************************/
 
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
	
}
/*===========================================ADD CITY==============================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='Create_city'){
	//echo '<pre>';print_r($_REQUEST);
	extract($_POST);
			
		$form_data=array('distributerId'=>$_SESSION['userData']['distributerId'],
					'name'=>$City_name);
			$data_string = json_encode($form_data);  

	$url="http://".$baseurl."/salesforceapi/addCity";
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
	
}
/*===========================================END ADD CITY===========================================*/
/*===========================================APPROVE PAYMENT STATUS===================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='approvePayment'){
	extract($_POST);		
		$form_data=array('distributerId'=>$_SESSION['userData']['distributerId'],
					'paymentId'=>$PaymentId,
					'retailerId'=>$retailerId,
					'visitorId'=>$visitorId,
					'paymentAmount'=>$paymentAmount,
					'paymentMode'=>$paymentMode,
					'licenseId'=>$licenseId,
					'refrenceNo'=>$refrenceNo,
					
					'updatedId'=>$_SESSION['userData']['employeeId'],
					'paymentAmountType'=>$paymentAmountType);
					
	$data_string = json_encode($form_data);  
	$url="http://".$baseurl."/salesforceapi/PaymentApprove";
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}
/*********************************************END APPROVE PAYMENT STATUS===============================*/

/*********************************************TAKE PAYMENT **********************************************/
if(($_REQUEST['page']) && $_REQUEST['page']=='take_payment'){
        extract($_POST);		
		$form_data=array('distributerId'=>$_SESSION['userData']['distributerId'],
					'paymentId'=>$PaymentId,
					'retailerId'=>$retailer_name,
					'visitorId'=>$_SESSION['userData']['employeeId'],
					'paymentAmount'=>$payment_amount,
					'paymentMode'=>$Payment_Mode,
					'licenseId'=>$licence,
					'refrenceNo'=>$refrenceNo,
					'updatedId'=>$_SESSION['userData']['employeeId'],
					'paymentAmountType'=>$payment_type);
               //echo '<pre>';print_r($form_data);
					
			$data_string = json_encode($form_data);  

	$url="http://".$baseurl."/salesforceapi/takePaymentForWeb";
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}
/*********************************************END TAKE PAYMENT*******************************************/
/*===========================================APPROVE PAYMENT STATUS===================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='Disaprrove_payment'){
	extract($_POST);
	$form_data=array('distributerId'=>$_SESSION['userData']['distributerId'],
					'id'=>$payemntId,
					'name'=>$reason_message,
					'updatedId'=>$_SESSION['userData']['employeeId']);
					$data_string = json_encode($form_data);  
if($_REQUEST['status']=='temporary'){
	$url="http://".$baseurl."/salesforceapi/PaymentDisApprove";
	
}else{
	$url="http://".$baseurl."/salesforceapi/permanentPaymentDisApprove";
}	
//echo $url; 	
					//echo '<pre>';print_r($form_data);
					
			

	
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}
/*********************************************END APPROVE PAYMENT STATUS===============================*/
/*===========================================UPDATE CITY==============================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_city'){
	//echo '<pre>';print_r($_REQUEST);
	extract($_POST);
			
		$form_data=array('distributerId'=>$_SESSION['userData']['distributerId'],
					'name'=>$City_name,
					'id'=>$city_id);
			$data_string = json_encode($form_data);  

	$url="http://".$baseurl."/salesforceapi/updateCity";
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $output=curl_exec($ch);
	curl_close($ch);
	print_r($output);
	die;
}
/*===========================================END UPDATE CITY===========================================*/

if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_designation'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailer=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailer);
	die;	
}
/****************************************************************UPDATE RETAILER TYPE********************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_retailertype'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId'],'id'=>$id);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/updateRetailerType";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailer=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailer);
	die;	
}
/*****************************************************************END UPDATE RETAILER TYPE***************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_retailersubtype'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailersubtype=curl_exec($ch);
	curl_close($ch);
	print_r($retailersubtype);
	die;
	
}
/****************************************************UPDATE RETAILER SUB TYPE********************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_retailersubtype'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId'],'id'=>$id);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/updateRetailerSubType";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailersubtype=curl_exec($ch);
	curl_close($ch);
	print_r($retailersubtype);
	die;
	
}
/****************************************************END UPDATE RETAILER SUB TYPE*****************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_category'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailercategory=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailercategory);
	die;
	
}
/***********************************************************UPDATE RETAILER CATEGORY****************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_category'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId'],'id'=>$id);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/updateRetailerCategory";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailercategory=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailercategory);
	die;
	
}
/***********************************************************END RETAILER UPDATE CATEGORY************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_retailerzone'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailerzone=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailerzone);
	die;
	
}
/************************************************************UPDATE ZONE*******************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_retailerzone'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId'],'id'=>$id);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/updateZone";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailerzone=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($retailerzone);
	die;
	
}

/*************************************************************END UPDATE END***************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='create_team'){
	//if(isset($_POST['page']) && $_POST['page']=='create_team'){
	extract($_POST);
	//print_r($_POST); die;
	$manager_team=array('employeeName'=>$fname.' '.$lname,'emailId'=>$email,'mobile'=>$phone,'alternatemobileNumber'=>$mobile,'adddress'=>$address,'joiningDate'=>$doj,'roleId'=>$role,'password'=>$password,'designationId'=>$designation,'empId'=>$emp_id,'reportTo'=>$report,'state'=>$state,'distributerId'=>$_SESSION['userData']['distributerId']);
	//echo '<pre>';print_r($manager_team);
	$manager_string=json_encode($manager_team);  
	$url="http://".$baseurl."/salesforceapi/addMember";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$manager_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
	
	$manager_team=array('employeeName'=>$fname.' '.$lname,'emailId'=>$email,'mobile'=>$phone,'alternatemobileNumber'=>$mobile,'adddress'=>$address,'joiningDate'=>$doj,'roleId'=>$role,'password'=>$password,'designationId'=>$designation,'empId'=>$emp_id,'reportTo'=>$report,'state'=>$state,'distributerId'=>$_SESSION['userData']['distributerId']);
	
	$manager_string=json_encode($manager_team);  
	$url="http://".$baseurl."/salesforceapi/addMember";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$manager_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
	$form_designation=array('roleId'=>$roleid,'distributerId'=>$_SESSION['userData']['distributerId']);
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);	
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
	$form_designation=array('roleId'=>'37','distributerId'=>$_SESSION['userData']['distributerId']);
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);	
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
if(isset($_REQUEST['page']) && $_REQUEST['page']=='advance_search'){
	extract($_POST);
	$form_search=array('managerid'=>$managerid,'asmId'=>$asmid,'tsmid'=>$tsmid);
	$search_string=json_encode($form_search);
	$url="http://".$baseurl."/salesforceapi/getTeamByAdvanceSearch";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$search_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $search=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($search);
	die;
}
/************************************************GET ATTENDENCE****************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getAttendence'){
		extract($_POST);
	//print_r($_POST);
		$memberId=$_POST['memberid'];
		$date=$_POST['date'];
		$timestamp    = strtotime($date);
		$first_date = date('y-m-01', $timestamp);
		$last_date  = date('y-m-t', $timestamp);


		$form_attendence=array('id'=>$memberId,'startDate'=>$first_date,'endDate'=>$last_date);	
		$attendence_string=json_encode($form_attendence);
		//print_r($attendence_string);
		//echo $designation_string;
		$url="http://".$baseurl."/salesforceapi/getAttendence";
		$header=array('Accept: application/json',
			'Content-Type: application/json');
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($ch,CURLOPT_POSTFIELDS,$attendence_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
		curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
			'Content-Type: application/json')                                                                    
		);                               		
		$attendence=curl_exec($ch);
		curl_close($ch);
		//print_r($attendence);
		$getAttendence=json_decode($attendence); 
		// table
		?>
		
		<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;" id="member_attendence">
		<?php 
		if(empty($getAttendence)){
			//echo "No data found";
		}else{
		?>
  <thead>
      <tr>
		<th>Date</th>
        <th>First Activity </th>
        <th>First Activity Time</th>
		<th>Last Activity </th>
        <th>Last Activity Time</th>
		<th>Hour</th>
		<th>Distance</th>
      </tr>
    </thead>
    <tbody>
		<?php }
		
		

		foreach($getAttendence->lstAttendence as $attendenceList){?>
	    <tr>
			<td style="width:160px";><?php echo $attendenceList->inDate;?></td>
			<td><a href=""><?php echo $attendenceList->inRetailerName;?></a></td>
			<td><?php echo $attendenceList->attendenceInTime;?></td>
			<td><?php echo $attendenceList->outRetailerName;?></td>
			<td><?php echo $attendenceList->attendenceOutTime;?></td>
			<td><?php echo $attendenceList->diffrence;?></td>		
			<td><?php //echo $attendenceList;?></td>			
		</tr>
		<?php }?>
	</tbody>
		
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
		
	
		<?php
		
		//die;
}
/****************************************************END GET ATTENDENCE****************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getAsmteambymanagerId')
{
	extract($_GET);
	//print_r($_POST); die;
	if($_REQUEST['req']=='2'){		
		$form_designation=array('roleId'=>'37','id'=>$_GET['managerid']);
		$url="http://".$baseurl."/salesforceapi/getListForProfile";
	}else{
		$form_designation=array('roleId'=>'38','distributerId'=>$_SESSION['userData']['distributerId']);
		$url="http://".$baseurl."/salesforceapi/getTeamByRole";
	}
	
	$designation_string=json_encode($form_designation);
	//print_r($designation_string);
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	); 
	$getreport=curl_exec($ch);
	curl_close($ch);
	$rowdata=json_decode($getreport);	
	//print_r($rowdata);
	$option="<option value=''>Select ASM</option>";	
	foreach($rowdata->lstMemberResponse as $value){
		  if($value->roleId==38){
			  $option.="<option value='".$value->employeeId."'>".$value->employeeName."</option>";
		  }
		
	}
	$option;
	$final_array=array();
	
		?>
	
	<?php
	$final_array['OPTION_DATA']=$option;
    $dat=sizeof($rowdata->lstMemberResponse);
	$final_array['TABLE_DATA']=$rowdata->lstMemberResponse;
	echo $data_json=json_encode($final_array);
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getAsmteam')
{
	
	extract($_POST);
	if($_REQUEST['req']=='2'){
		$form_designation=array('roleId'=>'37','id'=>$_GET['managerid']);
		$url="http://".$baseurl."/salesforceapi/getListForProfile";
	}else{
		$form_designation=array('roleId'=>'38','distributerId'=>$_SESSION['userData']['distributerId']);
		$url="http://".$baseurl."/salesforceapi/getTeamByRole";
	}
	
	$designation_string=json_encode($form_designation);
	$asmid= ' asmid: ' . $asmid;
	error_log($asmid,3,'meralog.log');
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	); 
	$getreport=curl_exec($ch);
	curl_close($ch);
	$rowdata=json_decode($getreport);
	
	$option="<option value=''>Select ASM</option>";
	
	foreach($rowdata->lstMemberResponse as $value){
		  if($value->roleId==38){
			  $option.="<option value='".$value->employeeId."'>".$value->employeeName."</option>";
		  }
		
	}
	echo $option;
	?>
	<table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>		
        <th>Name</th>
        <th>Emp-Role-Id</th>
        <th>Role Name</th>
		<th>Email</th>
        <th>Mobile</th>
		<th>Reports To</th>
        <th>Designation</th>
		<th>Retailer</th>
        <th>City</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdata->lstMemberResponse as $value){?>
	    <tr>			
		<?php 
			
			
			//manage self reporting prince		
		
			$sendUrl; 
			$rollid =$value->roleId;
			if($rollid==1) {
			$sendUrl = "profile_managers.php";
			}else if($rollid==37){
				$sendUrl="profile_managers.php";
			}else if($rollid==38){
				$sendUrl="profile_asm.php";
			}else if($rollid==39){
				$sendUrl="profile_tsm.php";
			}else if($rollid==40){
				$sendUrl="profile_sr.php";
			}
			//echo $sendUrl;
			//echo $employeeId=$value->employeeId;
				?>
		
		
			<td><a href="<?php echo $sendUrl;?>?empid=<?php echo $value->employeeId;?>"><?php echo $value->employeeName;?></td>
			<td><?php echo $value->empId;?></td>
			<td><?php echo $value->roleName;?></td>
			<td><?php echo $value->emailId;?></td>
			<td><?php echo $value->mobile;?></td>

			
				<?php 
			//manage self reporting prince		
		
			$sendUrl1; 
			$rollid =$value->roleId;
			if($rollid==1) {
			$sendUrl1 = "profile_managers.php";
			}else if($rollid==37){
				$sendUrl1="profile_managers.php";
			}else if($rollid==38){
				$sendUrl1="profile_managers.php";
			}else if($rollid==39){
				$sendUrl1="profile_asm.php";
			}else if($rollid==40){
				$sendUrl1="profile_tsm.php";
			}
			$sendUrl1;
			 $employeeId=$value->employeeId;
						$mycheck = $value->reportTo;
			if($mycheck==-5) {
			$mycheck=	$value->employeeId;
			}
			
			if($value->reportToName=='null'){
				$reportto="NA";
			}else{
				$reportto=$value->reportToName;
			}
			?>
		
			<td><a href="<?php echo $sendUrl1?>?empid=<?php echo $mycheck;?>"><?php echo $reportto;?></td>
			<td><?php echo $value->designationname;?></td>
			<td><a href="retailers.php?retailerid=<?= $value->employeeId; ?>"><?php echo $value->retailerCount;?></td>
			<td><?php echo $value->state;?></td>
			<td> 
			<a href="<?php echo $sendUrl;?>?empid=<?php echo $value->employeeId;?>&source=edit"><button type="button" class="btn btn-primary small-btn" id="edit_member"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<!--<button type="button" class="btn btn-danger small-btn" onclick="memberdelete('<?//= $value->employeeId; ?>');"><i class="fa fa-times" aria-hidden="true"></i></button>-->
			</td>
		</tr>
	<?php }?>
    </tbody>
  </table>
	<?php
	
}
/****************************************GET TSM TEAM LIST BY ASM ID******************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='gettsmteambyasmId')
{
	extract($_POST);
	//print_r($_POST); die;
	//$form_designation=array('roleId'=>'39','distributerId'=>'1');
	if($_REQUEST['req']=='3'){
		$form_designation=array('roleId'=>'38','id'=>$_POST['asmid']);//asm id
		$url="http://".$baseurl."/salesforceapi/getListForProfile";
	}else{
		$form_designation=array('roleId'=>'39','distributerId'=>$_SESSION['userData']['distributerId']);
		$url="http://".$baseurl."/salesforceapi/getTeamByRole";
	}
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	//$url="http://61.246.34.205:8185/salesforceapi/getTeamByRole";
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
	$option;
	$final_array['OPTION_DATA']=$option;
    $dat=sizeof($rowdata->lstMemberResponse);
	$final_array['TABLE_DATA']=$rowdata->lstMemberResponse;
	echo $data_json=json_encode($final_array);
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='gettsmteam')
{
	extract($_POST);
	//print_r($_POST); die;
	//$form_designation=array('roleId'=>'39','distributerId'=>'1');
	if($_REQUEST['req']=='3'){
		$form_designation=array('roleId'=>'38','id'=>$_GET['asmid']);//asm id
		$url="http://".$baseurl."/salesforceapi/getListForProfile";
	}else{
		$form_designation=array('roleId'=>'39','distributerId'=>$_SESSION['userData']['distributerId']);
		$url="http://".$baseurl."/salesforceapi/getTeamByRole";
	}
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	//$url="http://103.206.248.235:8080/salesforceapi/getTeamByRole";
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
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getsrteambysrId')
{
	extract($_POST);
	//print_r($_POST); die;
	//$form_designation=array('roleId'=>'39','distributerId'=>'1');
	if($_REQUEST['req']=='3'){
		$form_designation=array('roleId'=>'39','id'=>$_POST['tsmid']);
		$url="http://".$baseurl."/salesforceapi/getListForProfile";
	}else{
		$form_designation=array('roleId'=>'40','distributerId'=>$_SESSION['userData']['distributerId']);
		$url="http://".$baseurl."/salesforceapi/salesforceapi/getTeamByRole";
	}
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	//$url="http://61.246.34.205:8185/salesforceapi/getTeamByRole";
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
		  if($value->roleId==40){
			  $option.="<option value='".$value->employeeId."'>".$value->employeeName."</option>";
		  }
		
	}
	$option;
	$final_array['OPTION_DATA']=$option;
    $dat=sizeof($rowdata->lstMemberResponse);
	$final_array['TABLE_DATA']=$rowdata->lstMemberResponse;
	echo $data_json=json_encode($final_array);
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getsrteam')
{
	extract($_GET);
	//print_r($_GET); die;
	//$form_designation=array('roleId'=>'39','distributerId'=>'1');
	
		$form_designation=array('roleId'=>'39','id'=>$tsmid);
		$url="http://".$baseurl."/salesforceapi/getListForProfile";
	   echo '<pre>';print_r($form_designation);
		
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	//$url="http://103.206.248.235:8080/salesforceapi/getTeamByRole";
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
	//echo '<pre>';print_r($rowdata);
	foreach($rowdata->lstMemberResponse as $value){
		 // echo '<pre>';print_r($value->roleId);
		  if($value->roleId==40){
			  $option.="<option value='".$value->employeeId."'>".$value->employeeName."</option>";
		  }
		
	}
	echo $option;
	
}
/***********************************************************GET ROUTE DETAILS BY TSM************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getrouteName'){
	extract($_GET);
	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'tsmid'=>$tsmid);

	echo $designation_string=json_encode($form_designation);
	
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
	$option="<option value=''>Select Route</option>";
	
	$getreport=curl_exec($ch);
	curl_close($ch);
	//print_r($getreport);
	$rowdata=json_decode($getreport);
	foreach($rowdata->routelist as $value){
		      $idDetail=$value->routeId.'-'.$value->srId;
			  $option.="<option value='".$idDetail."'>".$value->routeName."</option>";
		  
		
	}
	echo $option;
	
}
/************************************************************END GET ROUTE DETAILS BY TSM********************************************/


if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_retailers'){
	//echo "hii";
	extract($_POST);
	$routeId=explode('-',$route_name);
	//echo '<pre>';print_r($routeId);
	//print_r($_POST); die;
	$form_retailer=array('retailerShopname'=>$retailer_licence_name,'contactPersaonName1'=>$person_name_one,'contactPersaonName2'=>$person_name_two,'contactPersaonName3'=>$person_name_three,'retailerExciseCode'=>$retailer_excise_code,'retailerEmailId'=>$retailer_email,'creditDays'=>$credit_days,'mobileNumber'=>$mobile_one,'alternateMobileNumber1'=>$mobile_two,'alternateMobileNumber2'=>$mobile_three,'landline'=>$landline_no,'locality'=>$locality,'street'=>$street,'city'=>$city,'distinct'=>$district,'pincode'=>$pin_code,'zoneId'=>$zone,'stateId'=>$state,'typeId'=>$type,'subTypeId'=>$sub_type,'categoryid'=>$category,'groupId'=>$group_name,'managerId'=>$manager,'asmId'=>$asm,'tsmId'=>$tsm,'srId'=>$routeId[1],'routeId'=>$routeId[0],'distributerId'=>$_SESSION['userData']['distributerId']);
	//echo '<pre>';print_r($form_retailer);
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);	
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
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getAllGroup";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
	$form_retailer=array('retailerShopname'=>$group_name,'contactPersaonName1'=>$contact_preson_name1,'contactPersaonName2'=>$contact_preson_name2,'contactPersaonName3'=>$contact_preson_name3,'retailerEmailId'=>$group_email,'creditDays'=>$credit_days,'mobileNumber'=>$mobile_one,'alternateMobileNumber1'=>$mobile_two,'alternateMobileNumber2'=>$mobile_three,'landline'=>$landline,'locality'=>$locality,'street'=>$street,'city'=>$city,'distinct'=>$district,'pincode'=>$pin_code,'zoneId'=>$zone,'stateId'=>$state,'managerId'=>$manager,'asmId'=>$asm,'tsmId'=>$tsm,'isGroup'=>$isgroup,'srId'=>$route_name,'distributerId'=>$_SESSION['userData']['distributerId'],'retailerExciseCode'=>$group_code);
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);	
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
	
	$form_brand=array('brandName'=>$brand_name,'brandCode'=>$brand_code,'internalBrandCode'=>$internal_brand_code,'principal'=>$principle,'licenseId'=>$license,'brandowner'=>$brand_owner,'description'=>$description,'stateId'=>$state,'distributerId'=>$_SESSION['userData']['distributerId']);
	
	$brand_string=json_encode($form_brand);
	
	$url="http://".$baseurl."/salesforceapi/addBrand";
	$header=array(
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $brand=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($brand);
	die;
}
/*=========================================================EDIT BRAND=============================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='edit_brand'){
	extract($_POST);
	
	 $form_brand=array('brandName'=>$brand_name,
	 'brandCode'=>$brand_code,
	 'internalBrandCode'=>$internal_brand_code,
	 'principal'=>$principle,
	 'licenseId'=>$license,
	 'brandowner'=>$brand_owner,
	 'description'=>$description,
	 'stateId'=>$state,
	 'brandId'=>$brandId,
	 'distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);
	
	$url="http://".$baseurl."/salesforceapi/updateBrand";
	$header=array(
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $brand=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($brand);
	
}
/*=========================================================END EDIT BRAND==========================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_products'){
	
	extract($_POST);
	
	$form_product=array('productName'=>$product_name,'branId'=>$brand_name,'productCategoryId'=>$product_category,'qtyMl'=>$qyt_ml,'boxSize'=>$number,'productStatus'=>$status,'createById'=>$employee,'distributerId'=>$_SESSION['userData']['distributerId'],'packagetypeId'=>$package_type,'productCode'=>$product_code,'cif'=>$ex_factory,'wsp'=>$wholesale_price,'mrp'=>$maximum_retail,'productSegmentCode'=>$product_segment,'productTypeId'=>$pro_type,'productSubtypeid'=>$subtype,'exciseDuty'=>$excise_duty,'licenseId'=>$license);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
	
	//echo 'id-'.$id;
	
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getBrand";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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

$getbrand=json_decode($brand);
//echo '<pre>';print_r($getbrand->brandList); die;

$brandName=array();
foreach($getbrand->brandList as $value){
	//echo 'licence-'.$value->licenseId;
	$id=trim($_GET['license']);
	//echo 'licence-'.$id == $value->licenseId;
	$select1='';
	if( $id == $value->licenseId ){
		$select1='selected';
		$brandName[]='<option value="' . $value->brandId . '" ' . $select1 . ' >' . $value->brandName .'</option>' ;
	}
	
	//echo '<pre>';print_r($brandName);
	
}

foreach($brandName as $value){
	$option_name.=$value;
}

$brandList=array();
foreach($getbrand->brandList as $value){
	$select1='';
	if( $id == $value->licenseId ){
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
	if( $id == $value->licenseId ){
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
	$id=trim($_GET['internal_brand_code']);
	//echo $id; die;
	
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getBrand";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
print_r($getbrand);

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
	$id=trim($_GET['brand_code']);
	//echo $id; die;
	
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
$designation_string=json_encode($form_designation);
$url="http://".$baseurl."/salesforceapi/getBrand";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);	
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
	$id=trim($_GET['brandid']);
	//echo $id; die;
	
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
$designation_string=json_encode($form_designation);
$url="http:///".$baseurl."/salesforceapi/getBrand";
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
//echo '<pre>';print_r($getbrand);die;

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

$licenseList=array(); 
$arr=array();
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
//echo '<pre>';print_r($license_option);

}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_pro_type_name'){
	extract($_POST);
$id=trim($_GET['pro_type']);
//echo $id; die;
$form_data=array('distributerId'=>$_SESSION['userData']['distributerId']);
$data_string = json_encode($form_data); 
$url="http://".$baseurl."/salesforceapi/getQtyPcs";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);	
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
					'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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
					'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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

$designation_data=array('updateById'=>$update_id,'employeeId'=>$empl_id,'employeeName'=>$employeename,'mobile'=>$mobile,'alternatemobileNumber'=>$alternatemobile,'adddress'=>$address,'state'=>$state,'joiningDate'=>$doj,'designationId'=>$designation,'reportTo'=>$report,'roleId'=>$role_id,'managerId'=>$managerId,'asmId'=>$asmId,'memberStatus'=>$Status);
//echo '<pre>';print_r($designation_data);
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
	
	$form_designation=array('roleId'=>'37','distributerId'=>$_SESSION['userData']['distributerId']);
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
	$designation_data=array('id'=>$desgination_id,'name'=>$name,'description'=>$description,'detailStatus'=>$status,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	$form_update_product=array('productId'=>$productID,'branId'=>$brand_name,'productCode'=>$product_code,'productCategoryId'=>$product_category,'productSegmentCode'=>$product_segment,'qtyMl'=>$qyt_ml,'boxSize'=>$number,'productStatus'=>$status,'updateById'=>$updateID,'packagetypeId'=>$package_type,'productTypeId'=>$pro_type,'cif'=>$ex_factory,'wsp'=>$wholesale_price,'mrp'=>$maximum_retail,'exciseDuty'=>$excise_duty,'licenseId'=>$license,'productSubtypeid'=>$subtype,'productName'=>$product_name,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	$survey=array('distributerId'=>$_SESSION['userData']['distributerId'],'description'=>$description,'startDate'=>$start_date,'endDate'=>$end_date,'title'=>$title);	
	$survey_string=json_encode($survey);	
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addSurvey";
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
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_survey_question'){
	extract($_POST); 
	//print_r($_POST); die;
	//$image=$_POST['image'];
	if($_POST['image']=='on'){
		$image='N';
	}
	if($_POST['edit_box']=='on'){
		$edit_box='N';
	}
	if($_POST['objective']=='on'){
		$objective='N';
	}
	if($_POST['yes_no']=='on'){
		$yes_no='N';
	}
	
	//print_r($_POST); die;
	$survey_question=array('serveyId'=>$surveyId,'question'=>$question,'editable'=>$edit_box,'objective'=>$objective,'image'=>$image,'answerList'=>$answer,'twoChoiceType'=>$yes_no);	
	$question_string=json_encode($survey_question);	
	//print_r($question_string);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/addQuestion";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$question_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$surveyQuestion=curl_exec($ch);	 
	curl_close($ch);
	
	
	
	$form_survey=array('id'=>$surveyId);
	$survey_string=json_encode($form_survey);
	$url="http://".$baseurl."/salesforceapi/getQestionAndAnswerByServeyId";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$survey_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);              
	$question=curl_exec($ch);
	curl_close($ch);
	$getquestion=json_decode($question);	
	?>
	<table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<th>Que id</th>
        <th>Question</th>
		<th>Option 1</th>
		<th>Option 2</th>
		<th>Option 3</th>
		<th>Option 4</th>
		<th>Yes / No</th>
		<th>Objective</th>
		<th>Edit_box</th>
		<th>image</th>
		<th>Action</th>
		
      </tr>
    </thead>
    <tbody>
	     
		<?php 
		 
		foreach($getquestion->questionList as $questionData){
						
						if($questionData->twoChoiceType=='null' || $questionData->twoChoiceType==''){
								$yesNo="NA";

							}else{
								$yesNo=$questionData->twoChoiceType;
							}
							
						
							?>
			<tr>
			<?php $answerdata=$questionData->answer ?>
		    <td><?php echo $questionData->questionId;?></td>
			<td><a href="#"></a> <?php echo $questionData->question;?></td>
			<td><?php echo $questionData->answer[0]->answer;?></td>
			<td><?php echo $questionData->answer[1]->answer;?></td>
			<td><?php echo $questionData->answer[2]->answer;?></td>
			<td><?php echo $questionData->answer[3]->answer;?></td>
			<td><?php echo $yesNo;?></td>
			<td><?php echo $questionData->objective;?></td>
			<td><?php echo $questionData->editable;?></td>
			<td><?php echo $questionData->image;?></td>
			<td> 
			<button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
							<?php
						 }
						 ?>
		
		
		
    </tbody>
  </table>
	
	<?php
	
	//echo $designation;
	//print_r($surveyQuestion);
	//die;
}
// bhanu added code //
if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_retailerinscheme'){
	extract($_POST);
	//print_r($_POST); die;
	$scheme_data=array('isSearch'=>'inScheme','distributerId'=>$_SESSION['userData']['distributerId']);
	$scheme_string=json_encode($scheme_data);
	$url="http://".$baseurl."/salesforceapi/getRetailer";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$scheme_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$updateScheme=curl_exec($ch);
	curl_close($ch);	
	$getupdateScheme=json_decode($updateScheme); ?>
	 <table class="table table-striped"  id="example" style="border:1px solid #ddd; font-size:12px;" id="table_id">
    <thead>
      <tr>
		<td><input type="checkbox"></td>
        <th>Shop Name</th>      
		<th style="width: 20%;">Address</th>		
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Outstanding</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach($getupdateScheme->lstRetailerRawData as $retailerdata){?>
	    <tr>
			<td><input type="checkbox" name="retailer_list[]" id="retailer_list[]" value="<?php echo $retailerdata->retailerId; ?>"></td>			
			<td><?php echo $retailerdata->retailerName;?></td>
			<td><?php echo $retailerdata->address;?></td>
			<td><?php echo $retailerdata->typeName;?></td>
			<td><?php echo $retailerdata->subTypeName;?></td>
			<td><?php echo $retailerdata->catogoryName;?></td>
			<td><?php echo $retailerdata->outStanding;?></td>	
			
		</tr>
		<?php }?>
		
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	<?php 
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_retaileroutscheme'){
	extract($_POST);
	//print_r($_POST); die;
	$scheme_data=array('isSearch'=>'outScheme','distributerId'=>$_SESSION['userData']['distributerId']);
	$scheme_string=json_encode($scheme_data);
	$url="http://".$baseurl."/salesforceapi/getRetailer";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$scheme_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$updateScheme=curl_exec($ch);
	curl_close($ch);	
	$getupdateScheme=json_decode($updateScheme); ?>
	 <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;" id="table_id">
    <thead>
      <tr>
		<td><input type="checkbox"></td>
        <th>Shop Name</th>      
		<th style="width: 20%;">Address</th>		
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Outstanding</th>
		
      </tr>
    </thead>
    <tbody>
		<?php foreach($getupdateScheme->lstRetailerRawData as $retailerdata){?>
	    <tr>
			<td><input type="checkbox" name="retailer_list[]" id="retailer_list[]" value="<?php echo $retailerdata->retailerId; ?>"></td>			
			<td><?php echo $retailerdata->retailerName;?></td>
			<td><?php echo $retailerdata->address;?></td>
			<td><?php echo $retailerdata->typeName;?></td>
			<td><?php echo $retailerdata->subTypeName;?></td>
			<td><?php echo $retailerdata->catogoryName;?></td>
			<td><?php echo $retailerdata->outStanding;?></td>	
			
		</tr>
		<?php }?>
		
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	<?php 
}
/*============================================survey_status_update=====================================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='survey_status_update'){
extract($_POST);
//print_r($_POST); die;
$survey_data=array('id'=>$id,'name'=>$status);
$survey_string=json_encode($survey_data);
$url="http://".$baseurl."/salesforceapi/updateServeyStatus";

$header=
array(
'Accept: application/json',
'Content-Type: application/json',
);

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$survey_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$updateSurvey=curl_exec($ch);
curl_close($ch);
print_r($updateSurvey);
die;

}
/*==========================================END SURVEY====================================================================*/
/*******************************************scheme_status_update==================================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='scheme_status_update'){
extract($_POST);
//print_r($_POST); die;
$scheme_data=array('id'=>$id,'operationtype'=>$status);
$scheme_string=json_encode($scheme_data);
$url="http://".$baseurl."/salesforceapi/updateSchemeStatus";

$header=
array(
'Accept: application/json',
'Content-Type: application/json',
);

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$scheme_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$updateScheme=curl_exec($ch);
curl_close($ch);
print_r($updateScheme);
die;

}
/*==========================================scheme_status_update================================================================*/
/*********************************************TARGET PERFORMANCE**********************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getMonthyear'){
	extract($_POST);
	//print_r($_POST); die;
	$date=$_POST['date'];
	$empId=$_POST['empid'];
	$roleId=$_POST['roleid'];
	$yeararray = explode("-", $date);
	$year= $yeararray[0];
	$month= date( 'M', mktime(0, 0, 0, $yeararray[1]));// M use for get three letters of months
	//echo $year;
	//echo $month; 
	$form_member=array('roleId'=>$roleId,'distributerId'=>$_SESSION['userData']['distributerId'],'month'=>$month,'year'=>$year,'id'=>$empId);
	$member_string=json_encode($form_member);
	//print_r($member_string); die;
	$url="http://".$baseurl."/salesforceapi/getTarget";
	
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$member_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$target=curl_exec($ch);
	curl_close($ch);
	$getTarget=json_decode($target);
	?>
		
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;" >
				<thead>
					<tr>
						<th style="width: 130px;">Member Name</th>
						<th>Role</th>
						<th>Brand Name</th>
						<th>License Name</th>
						<th>Sales <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Target <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Status </th>  		
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($getTarget->targetList as $targelList){
							
							if($targelList->roleId=='37'){
								$roleName="Manager";
							}elseif($targelList->roleId=='38'){
								$roleName="ASM";
							}elseif($targelList->roleId=='39'){
								$roleName="TSM";
							}elseif($targelList->roleId=='40'){
								$roleName="SR";
							}
					
					?>
					<tr>
						<td><a href=""><?php echo $targelList->assignName;?></td></a>
						<td><?php echo $roleName;?></td>
						<td><?php echo $targelList->brandName;?></td>
						<td><?php echo $targelList->licenceName;?></td>
						<td><?php ?></td>
						<td><?php echo $targelList->qty;?></td>
						<td><i class="fa fa-arrow-up color-g" aria-hidden="true"></i> <i class="fa fa-arrow-down color-r" aria-hidden="true"></i></td>
						<td><a href="order_listing.php"><button>View Details</button></a></td>			
					</tr>
				<?php }?>	
				</tbody>
			</table>
			<script>
			$(document).ready(function() {
			$('#example').DataTable();
		});
			</script>
	
	<?php 		
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='gettaregt'){	
	extract($_POST);
	//print_r($_POST); die;
	@$date=$_POST['date'];
	$empId=$_POST['empid'];
	$roleId=$_POST['roleid'];
	$yeararray = explode("-", $date);
	$year= $yeararray[0];
	@$month= date( 'M', mktime(0, 0, 0, $yeararray[1]));// M use for get three letters of months
	//echo $year;
	//echo $month; 
	$form_member=array('roleId'=>$roleId,'distributerId'=>$_SESSION['userData']['distributerId'],'month'=>$month,'year'=>$year,'id'=>$empId);
	$member_string=json_encode($form_member);
	//print_r($member_string);
	$url="http://".$baseurl."/salesforceapi/getTarget";
	
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$member_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$target=curl_exec($ch);
	curl_close($ch);
	$getTarget=json_decode($target);
	?>
		
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;" >
				<thead>
					<tr>
						<th style="width: 130px;">Member Name</th>
						<th>Role</th>
						<th>Brand Name</th>
						<th>License Name</th>
						<th>Sales <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Target <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Status </th>  		
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($getTarget->targetList as $targelList){
							
							if($targelList->roleId=='37'){
								$roleName="ASM";
							}elseif($targelList->roleId=='38'){
								$roleName="TSM";
							}elseif($targelList->roleId=='39'){
								$roleName="SR";
							}elseif($targelList->roleId=='40'){
								$roleName="SR";
							}
					
					?>
					<tr>
						<td><a href=""><?php echo $targelList->assignName;?></td></a>
						<td><?php echo $roleName;?></td>
						<td><?php echo $targelList->brandName;?></td>
						<td><?php echo $targelList->licenceName;?></td>
						<td><?php ?></td>
						<td><?php echo $targelList->qty;?></td>
						<td><i class="fa fa-arrow-up color-g" aria-hidden="true"></i> <i class="fa fa-arrow-down color-r" aria-hidden="true"></i></td>
						<td><a href="order_listing.php"><button>View Details</button></a></td>			
					</tr>
				<?php }?>	
				</tbody>
			</table>
			<script>
			$(document).ready(function() {
			$('#example').DataTable();
		});
			</script>
	
	<?php 	
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='gettarget'){	
	extract($_POST);
	//print_r($_POST); die;
	@$date=$_POST['date'];
	$empId=$_POST['empid'];
	$roleId=$_POST['roleid'];
	$yeararray = explode("-", $date);
	$year= $yeararray[0];
	@$month= date( 'M', mktime(0, 0, 0, $yeararray[1]));// M use for get three letters of months
	//echo $year;
	//echo $month; 
	$form_member=array('roleId'=>$roleId,'distributerId'=>$_SESSION['userData']['distributerId'],'month'=>$month,'year'=>$year,'id'=>$empId);
	$member_string=json_encode($form_member);
	//print_r($member_string);
	$url="http://".$baseurl."/salesforceapi/getTarget";
	
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$member_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$target=curl_exec($ch);
	curl_close($ch);
	$getTarget=json_decode($target);
	?>
		
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;" >
				<thead>
					<tr>
						<th style="width: 130px;">Member Name</th>
						<th>Role</th>
						<th>Brand Name</th>
						<th>License Name</th>
						<th>Sales <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Target <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Status </th>  		
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($getTarget->targetList as $targelList){
							
							if($targelList->roleId=='37'){
								$roleName="ASM";
							}elseif($targelList->roleId=='38'){
								$roleName="TSM";
							}elseif($targelList->roleId=='39'){
								$roleName="SR";
							}elseif($targelList->roleId=='40'){
								$roleName="SR";
							}
					
					?>
					<tr>
						<td><a href=""><?php echo $targelList->assignName;?></td></a>
						<td><?php echo $roleName;?></td>
						<td><?php echo $targelList->brandName;?></td>
						<td><?php echo $targelList->licenceName;?></td>
						<td><?php ?></td>
						<td><?php echo $targelList->qty;?></td>
						<td><i class="fa fa-arrow-up color-g" aria-hidden="true"></i> <i class="fa fa-arrow-down color-r" aria-hidden="true"></i></td>
						<td><a href="order_listing.php"><button>View Details</button></a></td>			
					</tr>
				<?php }?>	
				</tbody>
			</table>
			<script>
			$(document).ready(function() {
			$('#example').DataTable();
		});
			</script>
	
	<?php 	
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='gettargetbytsm'){	
	extract($_POST);
	//print_r($_POST); die;
	@$date=$_POST['date'];
	$empId=$_POST['empid'];
	$roleId=$_POST['roleid'];
	$yeararray = explode("-", $date);
	$year= $yeararray[0];
	@$month= date( 'M', mktime(0, 0, 0, $yeararray[1]));// M use for get three letters of months
	//echo $year;
	//echo $month; 
	$form_member=array('roleId'=>$roleId,'distributerId'=>$_SESSION['userData']['distributerId'],'month'=>$month,'year'=>$year,'id'=>$empId);
	$member_string=json_encode($form_member);
	//print_r($member_string);
	$url="http://".$baseurl."/salesforceapi/getTarget";
	
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$member_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$target=curl_exec($ch);
	curl_close($ch);
	$getTarget=json_decode($target);
	
	?>
		
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;" >
				<thead>
					<tr>
						<th style="width: 130px;">Member Name</th>
						<th>Role</th>
						<th>Brand Name</th>
						<th>License Name</th>
						<th>Sales <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Target <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Status </th>  		
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($getTarget->targetList as $targelList){
							//print_r($targelList);
							if($targelList->roleId=='37'){
								$roleName="ASM";
							}elseif($targelList->roleId=='38'){
								$roleName="TSM";
							}elseif($targelList->roleId=='39'){
								$roleName="SR";
							}elseif($targelList->roleId=='40'){
								$roleName="SR";
							}
							
					
					?>
					<tr>
						<td><a href=""><?php echo $targelList->assignName;?></td></a>
						<td><?php
						echo $roleName;?></td>
						<td><?php echo $targelList->brandName;?></td>
						<td><?php echo $targelList->licenceName;?></td>
						<td><?php ?></td>
						<td><?php echo $targelList->qty;?></td>
						<td><i class="fa fa-arrow-up color-g" aria-hidden="true"></i> <i class="fa fa-arrow-down color-r" aria-hidden="true"></i></td>
						<td><a href="order_listing.php"><button>View Details</button></a></td>			
					</tr>
				<?php }?>	
				</tbody>
			</table>
			<script>
			$(document).ready(function() {
			$('#example').DataTable();
		});
			</script>
	
	<?php 	
	
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='gettargetbrand'){	
	extract($_POST);
	//print_r($_POST); die;
	@$date=$_POST['date'];
	$empId=$_POST['empid'];
	$roleId=$_POST['roleid'];
	$brandId=$_POST['brandid'];
	$yeararray = explode("-", $date);
	$year= $yeararray[0];
	@$month= date( 'M', mktime(0, 0, 0, $yeararray[1]));// M use for get three letters of months
	//echo $year;
	//echo $month; 
	$form_member=array('roleId'=>$roleId,'distributerId'=>$_SESSION['userData']['distributerId'],'month'=>$month,'year'=>$year,'id'=>$empId);
	$member_string=json_encode($form_member);
	//print_r($member_string);
	$url="http://".$baseurl."/salesforceapi/getTarget";
	
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$member_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$target=curl_exec($ch);
	curl_close($ch);
	$getTarget=json_decode($target);
	//print_r($getTarget);
	
	?>
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;" >
				<thead>
					<tr>
						<th style="width: 130px;">Member Name</th>
						<th>Role</th>
						<th>Brand Name</th>
						<th>License Name</th>
						<th>Sales <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Target <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Status </th>  		
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php

					$targetList=array();
					foreach($getTarget->targetList as $targetList){		
						if($brandId == $targetList->brandId ){				
							//echo $targetList->roleId;
							if($roleId=='1'){
								$roleName="Manager";
							}elseif($roleId=='37'){								
								$roleName="ASM";							
							}elseif($roleId=='38'){								
								$roleName="TSM";							
							}elseif($roleId=='39'){								
								$roleName="SR";							
							}
							elseif($roleId=='40'){								
								$roleName="SR";							
							}
							
					
					?>
					<tr>
						<td><a href=""><?php echo $targetList->assignName;?></td></a>
						<td><?php echo $roleName;?></td>
						<td><?php echo $targetList->brandName;?></td>
						<td><?php echo $targetList->licenceName;?></td>
						<td><?php ?></td>
						<td><?php echo $targetList->qty;?></td>
						<td><i class="fa fa-arrow-up color-g" aria-hidden="true"></i> <i class="fa fa-arrow-down color-r" aria-hidden="true"></i></td>
						<td><a href="order_listing.php"><button>View Details</button></a></td>			
					</tr>
				<?php }}?>	
				</tbody>
			</table>
			<script>
			 $(document).ready(function() {
			$('#example').DataTable();
		});
			</script>
	<?php
}
//end get list for target
if(isset($_REQUEST['page']) && $_REQUEST['page']=='gettargetlicenceid'){	
	extract($_POST);
	//print_r($_POST); die;
	@$date=$_POST['date'];
	$empId=$_POST['empid'];
	$roleId=$_POST['roleid'];
	$licenceid=$_POST['licenceid'];
	$yeararray = explode("-", $date);
	$year= $yeararray[0];
	@$month= date( 'M', mktime(0, 0, 0, $yeararray[1]));// M use for get three letters of months
	//echo $year;
	//echo $month; 
	$form_member=array('roleId'=>$roleId,'distributerId'=>$_SESSION['userData']['distributerId'],'month'=>$month,'year'=>$year,'id'=>$empId);
	$member_string=json_encode($form_member);
	//print_r($member_string);
	$url="http://".$baseurl."/salesforceapi/getTarget";
	
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$member_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$target=curl_exec($ch);
	curl_close($ch);
	$getTarget=json_decode($target);
	?>
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;" >
				<thead>
					<tr>
						<th style="width: 130px;">Member Name</th>
						<th>Role</th>
						<th>Brand Name</th>
						<th>License Name</th>
						<th>Sales <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Target <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Status </th>  		
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php

					$targetList=array();
					foreach($getTarget->targetList as $targetList){	
							
						if($licenceid == $targetList->licenseId ){				
							
							if($roleId=='1'){
								$roleName="Manager";
							}elseif($roleId=='37'){								
								$roleName="ASM";							
							}elseif($roleId=='38'){								
								$roleName="TSM";							
							}elseif($roleId=='39'){								
								$roleName="SR";							
							}
							elseif($roleId=='40'){								
								$roleName="SR";							
							}
							
					
					?>
					<tr>
						<td><a href=""><?php echo $targetList->assignName;?></td></a>
						<td><?php echo $roleName;?></td>
						<td><?php echo $targetList->brandName;?></td>
						<td><?php echo $targetList->licenceName;?></td>
						<td><?php ?></td>
						<td><?php echo $targetList->qty;?></td>
						<td><i class="fa fa-arrow-up color-g" aria-hidden="true"></i> <i class="fa fa-arrow-down color-r" aria-hidden="true"></i></td>
						<td><a href="order_listing.php"><button>View Details</button></a></td>			
					</tr>
				<?php }}?>	
				</tbody>
			</table>
			<script>
			  $(document).ready(function() {
			$('#example').DataTable();
		});
			</script>
	<?php
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='gettargetinternalcode'){	
	extract($_POST);
	//print_r($_POST); die;
	@$date=$_POST['date'];
	$empId=$_POST['empid'];
	$roleId=$_POST['roleid'];
	$internalcodeId=$_POST['internalcode'];
	$yeararray = explode("-", $date);
	$year= $yeararray[0];
	@$month= date( 'M', mktime(0, 0, 0, $yeararray[1]));// M use for get three letters of months
	//echo $year;
	//echo $month; 
	$form_member=array('roleId'=>$roleId,'distributerId'=>$_SESSION['userData']['distributerId'],'month'=>$month,'year'=>$year,'id'=>$empId);
	$member_string=json_encode($form_member);
	//print_r($member_string);
	$url="http://".$baseurl."/salesforceapi/getTarget";
	
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$member_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$target=curl_exec($ch);
	curl_close($ch);
	$getTarget=json_decode($target);
	//print_r($getTarget);
	
	?>
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;" >
				<thead>
					<tr>
						<th style="width: 130px;">Member Name</th>
						<th>Role</th>
						<th>Brand Name</th>
						<th>License Name</th>
						<th>Sales <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Target <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Status </th>  		
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php

					$targetList=array();
					foreach($getTarget->targetList as $targetList){		
						if($internalcodeId == $targetList->brandId ){				
							
							if($roleId=='1'){
								$roleName="Manager";
							}elseif($roleId=='37'){								
								$roleName="ASM";							
							}elseif($roleId=='38'){								
								$roleName="TSM";							
							}elseif($roleId=='39'){								
								$roleName="SR";							
							}
							elseif($roleId=='40'){								
								$roleName="SR";							
							}
							
					
					?>
					<tr>
						<td><a href=""><?php echo $targetList->assignName;?></td></a>
						<td><?php echo $roleName;?></td>
						<td><?php echo $targetList->brandName;?></td>
						<td><?php echo $targetList->licenceName;?></td>
						<td><?php ?></td>
						<td><?php echo $targetList->qty;?></td>
						<td><i class="fa fa-arrow-up color-g" aria-hidden="true"></i> <i class="fa fa-arrow-down color-r" aria-hidden="true"></i></td>
						<td><a href="order_listing.php"><button>View Details</button></a></td>			
					</tr>
				<?php }}?>	
				</tbody>
			</table>
			<script>
			 $(document).ready(function() {
			$('#example').DataTable();
		});
			</script>
	<?php
}
/********************************************************END TARGET PERFORMANCE*************************************************/
	
	if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_productbybrandId'){
	extract($_POST);
	//print_r($_GET); die;
	$id=$_GET['brandid'];
	//print_r($id);	
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'brandId'=>$id);
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
	$form_assets=array('assetType'=>$assets_type,'assetName'=>$assets,'productId'=>$product,'brandId'=>$brand_name,'description'=>$description,'distributorId'=>$_SESSION['userData']['distributerId']);
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
	$form_assets=array('assetId'=>$assets,'qty'=>$qty,'amount'=>$amount,'retailerList'=>$retailer_list,'distributerId'=>$_SESSION['userData']['distributerId']);
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
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'id'=>$id);
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
if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_product_sub_type'){
	
	extract($_POST);
	//print_r($_POST); die;
	$subtype_data=array('id'=>$subid,'name'=>$name,'description'=>$description);
	$subtype_string=json_encode($subtype_data);
	$url="http://".$baseurl."/salesforceapi/updateProductSubType";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$subtype_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updateproductSubtype=curl_exec($ch);
	curl_close($ch);
	print_r($updateproductSubtype);
	die;
	
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_product_package_type'){
	
	extract($_POST);
	//print_r($_POST); die;
	$package_data=array('id'=>$packageid,'name'=>$name,'description'=>$description);
	$package_string=json_encode($package_data);
	$url="http://".$baseurl."/salesforceapi/updatePackagetype";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$package_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updateproductpackage=curl_exec($ch);
	curl_close($ch);
	print_r($updateproductpackage);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_product_type'){
	
	extract($_POST);
	//print_r($_POST); die;
	$proType_data=array('id'=>$proTypeid,'name'=>$name,'description'=>$description);
	$proType_string=json_encode($proType_data);
	$url="http://".$baseurl."/salesforceapi/updateProductType";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$proType_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updateproductType=curl_exec($ch);
	curl_close($ch);
	print_r($updateproductType);
	die;
	
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_product_category'){
	
	extract($_POST);
	//print_r($_POST); die;
	$proType_data=array('id'=>$proCatid,'name'=>$name,'description'=>$description);
	$proType_string=json_encode($proType_data);
	$url="http://".$baseurl."/salesforceapi/updateProductCategory";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$proType_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updateproductType=curl_exec($ch);
	curl_close($ch);
	print_r($updateproductType);
	die;
	
}

if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_product_segment'){
	
	extract($_POST);
	//print_r($_POST); die;
	$proType_data=array('id'=>$prosegid,'name'=>$name,'description'=>$description);
	$proType_string=json_encode($proType_data);
	$url="http://".$baseurl."/salesforceapi/updateProductSegment";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$proType_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updateproductType=curl_exec($ch);
	curl_close($ch);
	print_r($updateproductType);
	die;
	
}
if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_product_quantity'){
	
	extract($_POST);
	//print_r($_POST); die;
	$pieces_data=array('id'=>$piecesId,'qtyMl'=>$product_ml,'pcs'=>$product_pcs,'description'=>$description);
	$pieces_string=json_encode($pieces_data);
	$url="http://".$baseurl."/salesforceapi/updateQtyPcs";
	
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$pieces_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $updatepieces=curl_exec($ch);
	curl_close($ch);
	print_r($updatepieces);
	die;
	
}
//bhanu added code 07-08-18

// Prince Start/////////////Please Stop
if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_product_pacakage_type'){
	//echo "hii";
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	$form_designation=array('qtyMl'=>$product_ml,'pcs'=>$product_pieces,'description'=>$product_description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
/*******************************************************UPDATE edit_product_peice_qty**********************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='edit_product_peice_qty'){
	
	extract($_POST);
	//print_r($_POST);
	$form_designation=array('qtyMl'=>$product_ml,
	'pcs'=>$product_pieces,
	'description'=>$product_description,
	'id'=>$id);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/updateQtyPcs";
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
/*********************************************************END edit_product_peice_qty*****************************************************/

if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_product_page'){
	extract($_POST);
	//print_r($_POST); die;
	$id=$_GET['brandid'];
	//print_r($id);
	
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
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
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']
);
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
	$form_designation=array('name'=>$name,'description'=>$description,'distributerId'=>$_SESSION['userData']['distributerId']);
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
	if($continu){
		$form_update_product=array('targetMonth'=>$month,'targetYear'=>$year,'brandId'=>$brand_name,'qty'=>$cases,'assignId'=>$employee,'createdById'=>$manager,'roleId'=>$_SESSION['userData']['roleId'],'okProceed'=>$continu);
	}
	else{
		$form_update_product=array('targetMonth'=>$month,'targetYear'=>$year,'brandId'=>$brand_name,'qty'=>$cases,'assignId'=>$employee,'createdById'=>$manager,'roleId'=>$_SESSION['userData']['roleId']);
	}
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
/*************************************************************END TEAM TARGET FOR ASM END***********************************************************/	
	if(isset($_REQUEST['page']) && $_REQUEST['page']=='update_retailer'){
		extract($_POST);
		//print_r($_POST);die;
		$routeId=explode('-',$route_name);
        $form_update_retailer=array('retailerId'=>$retailerID,'retailerShopname'=>$retailer_shop,'contactPersaonName1'=>$contact_person_name,'creditDays'=>$credit_days,'retailerEmailId'=>$retailer_email,'mobileNumber'=>$mobile_one,'alternateMobileNumber1'=>$mobile_two,'alternateMobileNumber2'=>$mobile_three,'landline'=>$landline_no,'routeId'=>$routeId[0],'srId'=>$routeId[1],'tsmId'=>$tsm,'asmId'=>$asm,'typeId'=>$type,'subTypeId'=>$sub_type,'categoryid'=>$category,'locality'=>$locality,'street'=>$street,'pincode'=>$pin_code,'zoneId'=>$zone,'updatedById'=>$updateID,'distributerId'=>$_SESSION['userData']['distributerId'],'retailerExciseCode'=>$retailer_excise_code,'managerId'=>$manager,'isGroup'=>$group,'groupId'=>$group_name);
		//echo '<pre>';print_r($form_update_retailer);
		$update_retailer_string=json_encode($form_update_retailer);
		//echo '<pre>';print_r($update_retailer_string);
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
		$form_scheme=array('title'=>$title,'retailerList'=>$retailer_list,'description'=>$description,'fromDate'=>$from_date,'toDate'=>$to_date,'brandId'=>$brand_id,'productId'=>$product_id,'qty'=>$qty,'distributerId'=>$_SESSION['userData']['distributerId']);
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
		print_r($scheme);
		die;
	}
	
	/******************************************GET VISIT ACTIVITY BY DATE************************************************/
	if(isset($_REQUEST['page']) && $_REQUEST['page']=='get_Date'){
     extract($_GET); 
//print_r($_GET);die;
$team_activity=array('distributerId'=>$_SESSION['userData']['distributerId'],'roleId'=>'37','startDate'=>$fromDate,'endDate'=>$toDate);	
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
	if(isset($_POST['brand_id']) && $_POST['page']=='GetQtyupdate'){
		
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

	/***********************************************ADD DISTIBUTER ********************************************************/
	if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_distributors'){
	//echo '<pre>';print_r($_POST);die;
	extract($_POST);
	//print_r($_POST);die;
	$form_update_product=array('distrinuterName'=>$Distributor_name,'mobileNumber'=>$Distributor_mobile,'emailId'=>$Distributor_email,'state'=>$state,'address'=>$Distributor_Address,'cityName'=>'');
	$update_product_string=json_encode($form_update_product);
	$url="http://".$baseurl."/salesforceapi/addDistributer";
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
	/******************************************************END DISTIBUTER*********************************************/

	/*******************************************************************ADD LICENCE************************************/
	//add_licensce
	if(isset($_REQUEST['page']) && $_REQUEST['page']=='add_licensce'){
		extract($_POST);
		$form_update_product=array('distributerId'=>$_SESSION['userData']['distributerId'],'licenseNumber'=>$licence_name);
	$update_product_string=json_encode($form_update_product);
	$url="http://".$baseurl."/salesforceapi/addDistributerLicense";
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
	 print_r($updateProduct);
	curl_close($ch);

	}
	/*******************************************************END ADD LICENCE*********************************************/
	/********************************SET SEEION IF DISTRIBUTER SELECT***************************************************/
	if(isset($_REQUEST['page']) && $_REQUEST['page']=='setdistributer_session'){
	
		//setdistributer_se
		 //session_start();
		//$distributerId=$_POST['distributerId'];
		
	      $distributer_id=$_POST['distributerId'];
          $roleid=$_SESSION['userData']['roleId'];
          $employeeId=$_POST['Emplyee_id'];
           

          $login_array=array(
     
          'distributerId'=>$distributer_id,
          'statusCode'=> '0',
          'employeeId'=>$employeeId,
          'roleId'=>$roleid,
          'status'=>'success'
   
         );
		 $_SESSION['userData']=$login_array;
		 if($_SESSION['userData']['distributerId']==0){
            
		 }
		
           //print_r($_SESSION['userData']);
      
         //echo 'se-'.$_SESSION['userData'];
	}
	/********************************************END DISTRIBUTER********************************************************/
	
	/******************************************************DOWNLOAD CSV VALUE OF PRODUCTS***********************************/
	   if(isset($_REQUEST['page']) &&  $_REQUEST['page']=='download_csv'){
		   
		 echo '<pre>';print_r($_POST);
		   $csv=$_POST['csv_val'];
		   header('Location: export_csv.php?csv='.$csv);
	   }
	/************************************************************END PRODUCT CSV VALUE***************************************/
	
	/***********************************************************GET TARGET QTY************************************************/
	if(isset($_REQUEST['page']) &&  $_REQUEST['page']=='getqty'){
		extract($_POST);
$brand_id=$_POST['brandid'];
$form_target=array('createdById'=>$manager_id,'targetMonth'=>$month,'targetYear'=>$year,'brandId'=>$brandid);	
$target_string=json_encode($form_target);
$url="http://".$baseurl."/salesforceapi/getUpdatedtargetQty";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$target_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                           
$target=curl_exec($ch);
curl_close($ch);
print_r($target);
//$gettarget=json_decode($target);
//echo '<pre>';print_r($gettarget);die;

// echo json_encode($target);
		
	}
	/*******************************************************END TARGET QTY****************************************************/
	
	/**************************************************CREAT COLLECTION TARGET***************************************************/
if(isset($_REQUEST['page']) &&  $_REQUEST['page']=='create_collection'){
extract($_POST);
//echo '<pre>';print_r($_POST);die;
if($continu==''){
	$form_target=array('targetMonth'=>$month,
                   'targetYear'=>$year,
				   'createDate'=>$year,
				   'assignId'=>$emplyee_id,
				   'createdById'=>$Created_id,
				   'roleId'=>$_SESSION['userData']['roleId'],
				   'amount'=>$addamount,
				   'licenseId'=>$license,
				   'okProceed'=>'');
}

else{
$form_target=array('targetMonth'=>$month,
                   'targetYear'=>$year,
				   'createDate'=>$year,
				   'assignId'=>$emplyee_id,
				   'createdById'=>$Created_id,
				   'roleId'=>$_SESSION['userData']['roleId'],
				   'amount'=>$addamount,
				   'licenseId'=>$license,
				   'okProceed'=>$continu);	
}				   
$target_string=json_encode($form_target);
$url="http://".$baseurl."/salesforceapi/addPaymentTarget";
$header=array('Accept: application/json',
'Content-Type: application/json');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$target_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                           
$target=curl_exec($ch);
curl_close($ch);
print_r($target);	
		
	}
/**********************************************END COLLECTION TARGET*********************************************************/
/********************************************SHOW COLLECTION TARGET**********************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='show_collection'){
	//echo '<pre>';print_r($_POST);die;
    extract($_POST);	
	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
	'id'=>$emplyee_id,
	'licenseId'=>$license);	
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
	echo $remaning_traget_amount->list;
}
/**********************************************END SHOW COLLECTION TARGET****************************************************/
/***********************************************GET COLLECTION TARGET AMOUNT LICENCE WISE************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='Get_collection_amount'){
	extract($_POST);	
	$form_designation=array('id'=>$emplyee_id,
	'licenseId'=>$license,
	'year'=>$year,
	'month'=>$month);	
	 $designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getRemainingDistributionAmountForCollectionTarget";
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
	//echo $remaning_traget_amount->list;
	
}
/***********************************************END GET COLLECTION TARGET AMOUNT LICENSE WISE*********************************/
	/**************************************************GET COLLECTION BY CITYID***************************************************/
	if(isset($_REQUEST['page']) &&  $_REQUEST['page']=='getcollection_byCityId'){
		extract($_POST);
     if($from_date!="" && $to_date!=""){
		$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'startDate'=>$from_date,'endDate'=>$to_date);
	    $designation_string=json_encode($form_designation);
	//echo $designation_string;
	   $url="http://".$baseurl."/salesforceapi/getCollectionDetails"; 
	 }		
	
	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
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
	?>
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
	      foreach($get_collection_amount->list as $collection){
			  //echo '<pre>';print_r($collection);
			  if($collection->city==$CityId){

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
			 if($collection->licenseId==$LicenceId){	 
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
			 if($collection->retailerCatagory==$retailerCat){
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
			 if($collection->retailerType==$type){
				 
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
			 if($collection->retailerSubType==$subtype){
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
			 /*****************************************GET COLLECTION  BY DATE *************************************************************/

	if($from_date!="" && $to_date!=""){
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
	/*******************************************END GET COLLECTION DATE*************************************************************/
			  
		  }
	   ?>
	    
		 
	    
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	<?php
	}
	/***********************************************END GET COLLECTION BY CITY ID*************************************************/
	/**********************************************UPLOAD IMAGE********************************************************************/
	if(isset($_REQUEST['page']) &&  $_REQUEST['page']=='update_member_image'){
      //echo '<pre>';print_r($_POST);
$image_path=explode(',',$_POST['base64']);
	  //echo '<pre>';print_r($image_path[]);die;
	 $image_base64=$image_path['1'];
     extract($_POST);
$image_data=array('employeeId'=>$empl_id,'profilePic'=>$image_base64);
$image_string=json_encode($image_data);
$url="http://".$baseurl."/salesforceapi/uploadMemberImage";

$header=
array(
'Accept: application/json',
'Content-Type: application/json',
);

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$image_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$updateImage=curl_exec($ch);
curl_close($ch);
print_r($updateImage);
die;

}
/*******************************************END UPLOAD IMAGE*******************************************************************/

if(isset($_REQUEST['page']) &&  $_REQUEST['page']=='add_Kyc_image'){
$image_path=explode(',',$_POST['base64']);
	 $image_base64=$image_path['1'];
$image_path1=explode(',',$_POST['base641']);
	 $image_base641=$image_path1['1'];
$image_path2=explode(',',$_POST['base642']);
	 $image_base642=$image_path2['1'];
$image_path3=explode(',',$_POST['base643']);
	 $image_base643=$image_path3['1'];	 
$image_path4=explode(',',$_POST['base644']);
	 $image_base644=$image_path4['1'];
     extract($_POST);
//	print_r($_POST);die;
$image_data=array('gstNo'=>$gst_no,'gstImageUrl'=>$image_base64,'tinNo'=>$tin_no,'tinNoImage'=>$image_base641,'panNo'=>$pan_no,'panImage'=>$image_base642,'vatNo'=>$vat_no,'vatImage'=>$image_base643,'cancelCheque'=>$cancel_cheque,'cancelChequeImage'=>$image_base644,'bankAccountNo'=>$bank_account_no,'ifscCode'=>$bank_ifsc,'bankName'=>$bank_name,'bankAccountName'=>$bank_account_name,'retailerId'=>$retailerid);
$image_string=json_encode($image_data);
$url="http://".$baseurl."/salesforceapi/addKycDetail";

$header=
array(
'Accept: application/json',
'Content-Type: application/json',
);

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$image_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$kyc=curl_exec($ch);
curl_close($ch);
print_r($kyc);
die;

}
/****************************update kyc image***************************************************/
if(isset($_REQUEST['page']) &&  $_REQUEST['page']=='update_Kyc_image'){
$image_path=explode(',',$_POST['base64']);
$image_base64=$image_path['1'];
$image_path1=explode(',',$_POST['base641']);
$image_base641=$image_path1['1'];
$image_path2=explode(',',$_POST['base642']);
$image_base642=$image_path2['1'];
$image_path3=explode(',',$_POST['base643']);
$image_base643=$image_path3['1'];	 
$image_path4=explode(',',$_POST['base644']);
$image_base644=$image_path4['1'];
    extract($_POST);
//print_r($_POST);die;
$image_data=array('gstNo'=>$gst_no,'gstImageUrl'=>$image_base64,'tinNo'=>$tin_no,'tinNoImage'=>$image_base641,'panNo'=>$pan_no,'panImage'=>$image_base642,'vatNo'=>$vat_no,'vatImage'=>$image_base643,'cancelCheque'=>$cancel_cheque,'cancelChequeImage'=>$image_base644,'bankAccountNo'=>$bank_account_no,'ifscCode'=>$bank_ifsc,'bankName'=>$bank_name,'bankAccountName'=>$bank_account_name,'id'=>$id,'updateById'=>$updateId);
$image_string=json_encode($image_data);
$url="http://".$baseurl."/salesforceapi/updateKycDetail";

$header=
array(
'Accept: application/json',
'Content-Type: application/json',
);

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$image_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$kyc=curl_exec($ch);
curl_close($ch);
print_r($kyc);
die;

}

/*************************************************GET ASM BY MANAGER ID*********************************************************/
if(isset($_REQUEST['page']) &&  $_REQUEST['page']=='getasm_Detail'){
	//echo '<pre>';print_r($_POST);die;
	extract($_POST);
	$form_designation=array('managerid'=>$managerid);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://".$baseurl."/salesforceapi/getTeamByAdvanceSearch";
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

	$getAsm_array=curl_exec($ch);
	
	//echo 'target-'.$remaning_amount['list'];
	curl_close($ch);
	//print_r($manager);
	$get_asm_list=json_decode($getAsm_array);
	$asm_list=$get_asm_list->lstMemberResponse;
	//echo '<pre>';print_r($get_asm_list->lstMemberResponse);
	$option='';
	foreach($get_asm_list->lstMemberResponse as $value){
			  $option.="<option value='".$value->asmId."'>".$value->asmName."</option>";
		
	}
	echo $option;
}
/**************************************************END GET ASM BY MANAGER ID*****************************************************/

/*===================================================RETAILER ADVANCE SEARCH======================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetretailerType'){//by type
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'retailerType'=>$type);
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer->status);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th> ExciseCode </th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Group Name</th>		
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  $img='http://157.119.91.195:15000/'.$value->image;
		?>
		
	    <tr>
			<td><input type="checkbox" /></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo $value->exciseCode;?></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->typeName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>"><?php echo $groupName;?></td>
			
			<td> 
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit">
			   <button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php } ?>
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>

<?php	
}	
}
/*******************************************************RETAILER SUBTYPE SEARCH******************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='Getretailersubtype'){//by type
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'retailerSubType'=>$subtype);
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th> ExciseCode </th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Group Name</th>		
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  $img='http://157.119.91.195:15000/'.$value->image;
		?>
		
	    <tr>
			<td><input type="checkbox" /></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo $value->exciseCode;?></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->typeName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>"><?php echo $groupName;?></td>
			
			<td> 
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit">
			   <button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php } ?>
    </tbody>
  </table>
<script>
$(document).ready(function() {
			$('#example').DataTable();
		});
</script>
<?php	
}
}
/*********************************************************END RETAILER SUBTYPE SEARCH************************************************/
/************************************************SEARCH RETAILER BY CATEGORY*********************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='Getretailercat'){//by category
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'retailerCategory'=>$cat);
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th> ExciseCode </th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Group Name</th>		
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  $img='http://157.119.91.195:15000/'.$value->image;
		?>
		
	    <tr>
			<td><input type="checkbox" /></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo $value->exciseCode;?></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->typeName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>"><?php echo $groupName;?></td>
			
			<td> 
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit">
			   <button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php } ?>
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>

<?php	
}
}

/**************************************************END RETAILER BY CATEGORY*********************************************************/
/***********************************************SEARCH RETAILER BY MANAGER************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetretailerBYManager'){ //by Manager
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'managerid'=>$manager);
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th> ExciseCode </th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Group Name</th>		
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  $img='http://157.119.91.195:15000/'.$value->image;
		?>
		
	    <tr>
			<td><input type="checkbox" /></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo $value->exciseCode;?></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->typeName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>"><?php echo $groupName;?></td>
			
			<td> 
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit">
			   <button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php } ?>
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>

<?php	
}
}
/*************************************************END SEARCH RETAILER BY MANAGER*****************************************************/
/*************************************************SEARCH RETAILER BY ASM**************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetretailerBYAsm'){ //by ASM
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'asmId'=>$asm);
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th> ExciseCode </th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Group Name</th>		
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  $img='http://157.119.91.195:15000/'.$value->image;
		?>
		
	    <tr>
			<td><input type="checkbox" /></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo $value->exciseCode;?></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->typeName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>"><?php echo $groupName;?></td>
			
			<td> 
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit">
			   <button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php } ?>
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>

<?php	
}
}
/*****************************************************END SEARCH BY ASM****************************************************************/
/*****************************************************SEARCH RETAILER BY TSM***********************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetretailerByTsm'){ //by Tsm
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'tsmid'=>$tsm);
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th> ExciseCode </th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Group Name</th>		
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  $img='http://157.119.91.195:15000/'.$value->image;
		?>
		
	    <tr>
			<td><input type="checkbox" /></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo $value->exciseCode;?></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->typeName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>"><?php echo $groupName;?></td>
			
			<td> 
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit">
			   <button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php } ?>
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>

<?php	
}
}
/******************************************************END SEARCH RETAILER BY TSM*****************************************************/
/*******************************************************SEARCH RETAILER BY SR*********************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetretailerBySr'){ //by SR
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'srid'=>$sr);
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th> ExciseCode </th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Group Name</th>		
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  $img='http://157.119.91.195:15000/'.$value->image;
		?>
		
	    <tr>
			<td><input type="checkbox" /></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo $value->exciseCode;?></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->typeName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>"><?php echo $groupName;?></td>
			
			<td> 
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit">
			   <button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php } ?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>

<?php	
}
}
/**********************************************************END SEARCH RETAILER BY SR**************************************************/
/**********************************************start view sales board search*********************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetretailerBysearchparamSelect'){
	extract($_POST);
	//print_r($_POST); die;
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
'retailerType'=>$type,
'retailerSubType'=>$subtype,
'retailerCategory'=>$cat,
);
$designation_string=json_encode($form_designation);
//echo '<pre>';print_r($designation_string); die;
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
		<select class="form-control" name="retailer_name" id="retailer_name">
			<option>Select Retailer</option>
		<?php foreach($rowdataRetailer->lstRetailerRawData as $retailerList){?>
			<option <?php if($_REQUEST['retailerId']==$retailerList->retailerId){echo 'selected';}?> value="<?php echo $retailerList->retailerId;?>"><?php echo $retailerList->retailerName;?></option>
		<?php }?>						
		</select>
  

<?php	
}
}
/********************************************end view sales board search*************************************************************/
/********************************************start retailer view sales board**********************************************************/

/********************************************end retailer view sales board**********************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='view_sales_board'){
	extract($_POST);
	//print_r($_POST); die;
$url="http://".$baseurl."/salesforceapi/getRetailerByRetailerId";
$form_designation=array('id'=>$retailerId,
'retailerType'=>$type,
'retailerSubType'=>$subtype,
'retailerCategory'=>$cat,
);
$designation_string=json_encode($form_designation);
//echo '<pre>';print_r($designation_string); die;
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$getRetailer=json_decode($data);

// get promise order 

$form_promise=array('distributerId'=>$_SESSION['userData']['distributerId'],'id'=>$retailerId,'startDate'=>$from_date,'endDate'=>$to_date);
	$url="http://".$baseurl."/salesforceapi/getPromiseOrder";
	$promise_string=json_encode($form_promise);	
		$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$promise_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                              		
	 $promiseorder=curl_exec($ch);
	curl_close($ch);
	$getPromiseorder=json_decode($promiseorder);
	
// get actual order 

$form_actual=array('distributerId'=>$_SESSION['userData']['distributerId'],'id'=>$retailerId,'startDate'=>$from_date,'endDate'=>$to_date);
	$url="http://".$baseurl."/salesforceapi/getExciseOrderByDistributerId";
	$actual_string=json_encode($form_actual);	
		$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$actual_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                              		
	 $actualorder=curl_exec($ch);
	curl_close($ch);
	$getactualorder=json_decode($actualorder);

//echo '<pre>';print_r($getactualorder); die;
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
	<div id="view_sales">
		<div class="row saleboard">
			<h1>Retailer Name</h1>
				<?php foreach($getRetailer->lstRetailerRawData as $retailerList){?>
					<p style="margin-left: 317px;"><?php echo $retailerList->retailerName;?></p>
				<?php }?>
		</div>   
		<div class="row">
			<div class="col-md-2"></div>
				<div class="col-md-8">	   
					<table class="table table-striped" style="border:1px solid #ddd; font-size:12px;">
						<thead>
							<tr>
								<th>Mobile</th>
								<th>Email</th>
								<th>Route Name</th>
								<th>SR Name</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($getRetailer->lstRetailerRawData as $retailerdata){?>
							<tr>
								<td><?php echo $retailerdata->mobile;?></td>
								<td><?php echo $retailerdata->email;?></td>
								<td><?php echo $retailerdata->srName;?></td>
								<td><?php echo $retailerdata->srName;?></td>			
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row actpro">
			<div class="col-md-6">	
				<h2>Actual Order <a href="export_actualorder.php?retailerId=<?php echo $_REQUEST['retailerId'];?>"><button>Download CSV</button></a></h2>
					<table class="table table-striped" style="border:1px solid #ddd; font-size:12px;">
						<thead>
							<tr>
								<th>Order No.</th>
								<th>Order Date</th>
								<th>Brand Name</th>
								<th>Product Name</th>
							</tr>
						</thead>
						<tbody>
								<?php foreach($getactualorder->lstExciseOrder as $actualorder){?>
								<tr>
									<td><?php echo $actualorder->exciseOrderId;?></td>
									<td><?php echo $actualorder->orderCreateDate;?></td>
									<td><?php echo $actualorder->brandName;?></td>
									<td><?php echo $actualorder->productName;?></td>
								</tr>
								<?php }?>
							</tbody>
					</table>
				</div>
			<div class="col-md-6">	
				<h2>Promised Order <a href="export_promisedorde.php?retailerId=<?php echo $_REQUEST['retailerId'];?>"><button>Download CSV</button></a></h2>
					<table class="table table-striped" style="border:1px solid #ddd; font-size:12px;">
						<thead>
							<tr>
								<th>Order No.</th>
								<th>Date</th>
								<th>Time</th>
								<th>Distributor Name</th>
							</tr>
						</thead>
						<tbody>
								<?php foreach($getPromiseorder->lstPromiseOrder as $promiseorder){
									foreach($promiseorder->productList as $promiseorderList){
									?>
								<tr>
									<td><?php echo $promiseorderList->orderId;?></td>
									<td><?php echo $promiseorder->takenDate;?></td>
									<td><?php echo $promiseorderList->brandName;?></td>
									<td><?php echo $promiseorderList->productName;?></td>
								</tr>
								<?php }}?>
							</tbody>
					</table>
				</div>
		</div>
	</div>
<?php	
}
	
	
}
/****************************************************RETAILER ADVANCE SEARCH BY MULTIPLE PARAM****************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetretailerBysearchparam'){
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
'retailerType'=>$type,
'retailerSubType'=>$subtype,
'retailerCategory'=>$cat,
'managerid'=>$manager,
'asmId'=>$asm,
'tsmid'=>$tsm,
'srid'=>$sr,
'zoneId'=>$zoneId);
$designation_string=json_encode($form_designation);
//echo '<pre>';print_r($designation_string);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" style="border:1px solid #ddd; font-size:12px;" id="one">
    <thead>
      <tr>
		<td><input type="checkbox" id="checkAll"/></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th> ExciseCode </th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Group Name</th>		
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  if($value->image!=''){
			$img='http://157.119.91.195:15000/'.$value->image;  
		  }else{
			$img='images/img3.jpg';  
		  }
		?>
		
	    <tr>
			<td><input type="checkbox" class="checkItem" name="retailerIds[]"  class="retids" value="<?php echo $value->retailerId; ?>"></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo $value->exciseCode;?></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->typeName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>"><?php echo $groupName;?></td>
			
			<td> 
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit">
			   <button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
			<button type="button" class="btn btn-danger small-btn" onclick="retailersDelete(<?php echo $value->retailerId;?>)"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php } ?>
    </tbody>
  </table>
  <input type="hidden" id="checklength">
  <script>
  $(document).ready(function() {
			$('#one').DataTable();
		});
		
		$('#checkAll').click(function() {
			
         $(':checkbox.checkItem').prop('checked', this.checked); 
		  checked = []
          $(".checkItem:checked").each(function () {
           checked.push($(this).val())
          });
		   $('#csv_value').val(checked.join(","));
		   var csv_val=checked.join(",");
		  //alert(csv_val.length);
		  $('#checklength').val(csv_val.length);
       });	
	// assign assets
		$(document).ready(function(){
			
			$("#assign_assets").click(function(){
				var checklength=$('#checklength').val();
			
			if(checklength>=999){
				alert('You Can Not assign More then thousands retailer');
				return false;
				
			}
				var brand_name= $('#brand_name').val();
				var product= $('#product').val();
				var assets= $('#assets').val();
				var qty= $('#qty').val();
				var amount= $('#amount').val();					
				var retailer_list = [];
					$.each($("input[name='retailerIds[]']:checked"), function(){ 
						retailer_list.push($(this).val());
					});
				//alert("My favourite sports are: " + retailer_list.join(", "));
				
				$.ajax({
					type: 'POST',
					url:"ajax.php",
					data:{'brand_name':brand_name,'product':product,'assets':assets,'qty':qty,'amount':amount,'retailer_list':retailer_list,'page':"assign_assets"},
					dataType:'json',
					cache: false,
					success: function(data){
						console.log(data);
						if(data.statusCode == 0) {
							swal("Success",data.message, "success");
								setTimeout(function(){
									//window.location.href='retailer_assets.php';
								}, 2000);								
						}else{
								swal("Action failed",data.message, "error");
							}
					}
				});
				 return false;
			});
		});
  </script>

<?php	
}
}
/*********************************************************END RETAILER ADVANCE SEARCH BY MULTIPLE PARAM********************************/
/*********************************************************GET BLOCK LIST RETAILER******************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetBlockretailerBysearchparam'){
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
'retailerType'=>$type,
'retailerSubType'=>$subtype,
'retailerCategory'=>$cat,
'managerid'=>$manager,
'asmId'=>$asm,
'tsmid'=>$tsm,
'srid'=>$sr,
'zoneId'=>$zoneId,
'isSearch'=>'blocked');
$designation_string=json_encode($form_designation);
//echo '<pre>';print_r($designation_string);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" style="border:1px solid #ddd; font-size:12px;" id="one">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th> ExciseCode </th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th>Group Name</th>		
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  if($value->image!=''){
			$img='http://157.119.91.195:15000/'.$value->image;  
		  }else{
			$img='images/img3.jpg';  
		  }
		?>
		
	    <tr>
			<td><input type="checkbox" name="retailerIds[]"  class="retids" value="<?php echo $value->retailerId; ?>"></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo $value->exciseCode;?></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->typeName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>"><?php echo $groupName;?></td>
			
			<td> 
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit">
			   <button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
			<button type="button" class="btn btn-danger small-btn" onclick="retailersDelete(<?php echo $value->retailerId;?>)"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php } ?>
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#one').DataTable();
		});
  </script>

<?php	
}
}
/*************************************************************END GET BLOCK RETAILER****************************************************/

/****************************************************retailerBysearchparam MULTIPLE PARAM****************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='retailerBysearchparam'){
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'retailerType'=>$type,'retailerSubType'=>$subtype,'retailerCategory'=>$cat,'managerid'=>$manager,'asmId'=>$asm,'tsmid'=>$tsm,'srid'=>$sr);
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped"  id="example" style="border:1px solid #ddd; font-size:12px;" id="one">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  if($value->image!=''){
			$img='http://157.119.91.195:15000/'.$value->image;  
		  }else{
			$img='images/img3.jpg';  
		  }
		?>
		
	    <tr>
			<td><input type="checkbox" name="retailerIds[]"  class="retids" value="<?= $value->retailerId; ?>"></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
		
		</tr>
		<?php } ?>
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>

<?php	
}
}
/*********************************************************END retailerBysearchparam BY MULTIPLE PARAM********************************/
/*========================================================SEARCH RETAILER BY NAME=======================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='serachRetailerByName'){
extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'name'=>$retailerName);
$designation_string=json_encode($form_designation);
$header=
array(
'Accept: application/json',
'Content-Type: application/json'
);

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;" id="one">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  if($value->image!=''){
			$img='http://157.119.91.195:15000/'.$value->image;  
		  }else{
			$img='images/img3.jpg';  
		  }
		?>
		
	    <tr>
			<td><input type="checkbox" name="retailerIds[]"  class="retids" value="<?= $value->retailerId; ?>"></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
		
		</tr>
		<?php } ?>
    </tbody>
  </table>
   <script>
   $(document).ready(function() {
			$('#example').DataTable();
		});
		
		$("#one").on('click', '.retids', function (e) {
	 var tr = $(this).closest("tr").remove().clone();
		 $("#two tbody").append(tr);
 });
 
 $("#two").on('click', '.retids', function (e) {
     var tr = $(this).closest("tr").remove().clone();
     $("#one tbody").before(tr);
 });
 /***************************ALL CHEKBOX SELETED***************************************/
 $('#checkAll').click(function() {
			
         $(':checkbox.retids').prop('checked', this.checked); 
		  checked = []
          $(".retids:checked").each(function () {
           checked.push($(this).val())
          });
		   $('#csv_value').val(checked.join(","));
		   var csv_val=checked.join(",");
		    var tbody = $('#allbody').closest("tbody").remove().clone();
		   $("#two").append(tbody);
       });
	   
	   $("#checkAllSecond").on('click', '.retids', function (e) {
	  var tbody = $('#allbodyScond').closest("tbody").remove().clone();
	  
		   $("#one").append(tbody);
 });
	   
 /*****************************************END ALL CHECKBOX SELECTED********************/
   </script>
<?php	
}	
	
}
/*========================================================END SEARCH RETAILER BY NAME====================================================*/
/*=======================================================GET getNonAssignRetailer=======================================================*/ 
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getNonAssignRetailer'){
	extract($_POST);
	$url="http://".$baseurl."/salesforceapi/getRetailer";
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
	'managerid'=>$manager,
	'asmId'=>$asm,
	'tsmid'=>$tsm,
	'srid'=>$sr,
	'isSearch'=>'nonAssigned');
	//echo'<pre>';print_r($form_designation);
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdataRetailer=json_decode($data);
//echo '<pre>';print_r($rowdataRetailer);
if($rowdataRetailer->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" style="border:1px solid #ddd; font-size:12px;" id="one">
    <thead>
      <tr>
		<td><input type="checkbox" /></td>
		<th>Retailer</th>
        <th>Shop Name</th>
		<th style="width: 145px;">Address</th>
		<th>Mobile</th>
		<th>SR</th>
      
		<th>Subtype</th>
		<th>Category</th>		
        
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdataRetailer->lstRetailerRawData as $value){
			//echo '<pre>';print_r($value);
			if($value->groupName=='null'){
				$groupName= "NA";				
			}else{
				$groupName=$value->groupName;
			}
			if($value->srName=='null'){
				$srName= "NA";				
			}else{
				$srName=$value->srName;
			}
		  // $img='http://'.$baseurl."/".$value->image;//157.119.91.195
		  if($value->image!=''){
			$img='http://157.119.91.195:15000/'.$value->image;  
		  }else{
			$img='images/img3.jpg';  
		  }
		?>
		
	    <tr>
			<td><input type="checkbox" name="retailerIds[]"  class="retids" value="<?= $value->retailerId; ?>"></td>
			<!--<td><a href="retailer-profile.php"><img src="images/retailer.jpg"></a></td> -->
			
			<td><a href="retailer-profile.php"><img style="height:80px;width:80px;" src="<?php echo $img;?>"></a></td>
			<td><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit"><?php echo @$value->retailerName;?></a></td>
			<td><?php echo @$value->address;?></td>
			<td><?php echo @$value->mobile;?></td>
			<td><a href="profile_sr.php?empid=<?php echo $value->srId; ?>"><?php echo $srName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>			
		
		</tr>
		<?php } ?>
    </tbody>
  </table>

<?php	
}

	
	
}
/*========================================================END GET getNonAssignRetailer===================================================*/
/*========================================================ADVANCE SEARCH OF FEEDBACK REPORT=================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetfeeddbackreportBysearchparam'){ //by SR
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'retailerType'=>$type,'retailerSubType'=>$subtype,'retailerCategory'=>$cat,'managerid'=>$manager,'asmId'=>$asm,'tsmid'=>$tsm,'srid'=>$sr);
echo '<pre>';print_r($form_designation);
$data_string=json_encode($form_designation);
	$url="http://".$baseurl."/salesforceapi/getFeedback";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$data=curl_exec($ch);
	curl_close($ch);
	$rowdata1=json_decode($data);
	echo '<pre>';print_r($rowdataRetailer);
if($rowdata1->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" style="border:1px solid #ddd; font-size:12px;">
					<thead>
						<tr>
							<th>Retailer Name</th>
							<th>Taken by</th>
							<th>Role</th>
							<th>SR Name</th>
							<th>Feedback Type</th>
							<th>Description</th>
							<th>Date & Time</th>
							<th>Rating</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
							<?php 	foreach($rowdata1->feedbackList as $value){ 
							          //echo '<pre>';print_r($value);
										$visit_date= $value->visitDate;						
										$visitDate=date('d-m-y',strtotime($visit_date));
										
										if($value->srName=='null'){
											$srName="NA";
										}else{
											$srName=$value->srName;						
										}
										//$img='http://'.$baseurl."/".$value->image;
										$img='http://157.119.91.195:15000/'.$value->image;
							?>
						<tr>
							<td><?php echo $value->retailerName;?></td>
							<td><?php echo $value->visitorName;?></td>
							<td><?php echo $value->roleName;?></td>
							<td><?php echo $srName;?></td>
							<td><?php echo $value->feedbackTypeName;?></td>
							<td><?php echo $value->description;?></td>
							<td style="width:100px;"><?php echo $visitDate;?></td>
							<td><?php echo $value->feedbackratingName;?></td>			
							<td> 
								<button type="button" class="btn btn-success small-btn" data-toggle="modal" data-target="#myModal_map" onclick="feedbackMap('<?php echo $value->retailerLattitude; echo $value->retailerLongitude; echo $value->lattitude; echo $value->lattitude;?>')"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-info small-btn" data-toggle="modal" data-target="#myModal_feedback" onclick="feedbackPopup('<?php echo $img;?>')"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>
							</td>
						</tr>
						<?php  } ?>		
					</tbody>
				</table>
<?php	
}
}

/*========================================================END ADVANCE SEARCH OF FEEDBACK REPORT =============================*/
 
/*===================================================END RETAILER ADVANCE SEARCH===================================================*/
/*==================================================================ADVANCE SEARCH BY MEMBER========================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetMemberBysearchparam'){ //by SR
	extract($_POST);

if($manager=='' && $asm=='' && $tsm=='' && $roleId==''){
    $url="http://".$baseurl."/salesforceapi/getAllMemberBYDistributerId";
	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);

}else{
$url="http://".$baseurl."/salesforceapi/getTeamByAdvanceSearch";
$form_designation=array('managerid'=>$manager,'asmId'=>$asm,'tsmid'=>$tsm,'roleId'=>$roleId);
}

$designation_string=json_encode($form_designation);

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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdata=json_decode($data);
//echo '<pre>';print_r($rowdata);die;
if($rowdata->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>		
        <th>Name</th>
        <th>Emp-Role-Id</th>
        <th>Role Name</th>
		<th>Email</th>
        <th>Mobile</th>
		<th>Reports To</th>
        <th>Designation</th>
		<th>Retailer</th>
        <th>City</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($rowdata->lstMemberResponse as $value){?>
	    <tr>			
		<?php 
			
			
			//manage self reporting prince		
		
			$sendUrl; 
			$rollid =$value->roleId;
			if($rollid==1) {
			$sendUrl = "profile_managers.php";
			}else if($rollid==37){
				$sendUrl="profile_managers.php";
			}else if($rollid==38){
				$sendUrl="profile_asm.php";
			}else if($rollid==39){
				$sendUrl="profile_tsm.php";
			}else if($rollid==40){
				$sendUrl="profile_sr.php";
			}
			//echo $sendUrl;
			//echo $employeeId=$value->employeeId;
				?>
		
		
			<td><a href="<?php echo $sendUrl;?>?empid=<?php echo $value->employeeId;?>"><?php echo $value->employeeName;?></td>
			<td><?php echo $value->empId;?></td>
			<td><?php echo $value->roleName;?></td>
			<td><?php echo $value->emailId;?></td>
			<td><?php echo $value->mobile;?></td>

			
				<?php 
			//manage self reporting prince		
		
			$sendUrl1; 
			$rollid =$value->roleId;
			if($rollid==1) {
			$sendUrl1 = "profile_managers.php";
			}else if($rollid==37){
				$sendUrl1="profile_managers.php";
			}else if($rollid==38){
				$sendUrl1="profile_managers.php";
			}else if($rollid==39){
				$sendUrl1="profile_asm.php";
			}else if($rollid==40){
				$sendUrl1="profile_tsm.php";
			}
			$sendUrl1;
			 $employeeId=$value->employeeId;
						$mycheck = $value->reportTo;
			if($mycheck==-5) {
			$mycheck=	$value->employeeId;
			}
			
			if($value->reportToName=='null'){
				$reportto="NA";
			}else{
				$reportto=$value->reportToName;
			}
			?>
		
			<td><a href="<?php echo $sendUrl1?>?empid=<?php echo $mycheck;?>"><?php echo $reportto;?></td>
			<td><?php echo $value->designationname;?></td>
			<td><a href="retailers.php?retailerid=<?= $value->employeeId; ?>"><?php echo $value->retailerCount;?></td>
			<td><?php echo $value->state;?></td>
			<td> 
			<a href="<?php echo $sendUrl;?>?empid=<?php echo $value->employeeId;?>&source=edit"><button type="button" class="btn btn-primary small-btn" id="edit_member"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<!--<button type="button" class="btn btn-danger small-btn" onclick="memberdelete('<?//= $value->employeeId; ?>');"><i class="fa fa-times" aria-hidden="true"></i></button>-->
			</td>
		</tr>
	<?php }?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
  
<?php	
}
}
/*==================================================================END ADVANCE SEARCH BY MEMBER======================================*/
/*==================================================================ADVANCE SEARCH BY GROUP============================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetgroupBysearchparam'){ 
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getRetailer";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
'managerid'=>$manager,
'asmId'=>$asm,
'tsmid'=>$tsm,
'srid'=>$sr,
'retailerCategory'=>$cat,
'zoneId'=>$zoneID,'isSearch'=>'groupWise');
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
//echo '<pre>';print_r($getGroup);die;
if($getGroup->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
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
        <th>Type</th>
		<th>Subtype</th>
		<th>Category</th>
		<!--<th>Group</th>
        <th>Group Name</th> -->
		<!--<th>Created Date</th>  -->
		<th>Action</th>
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
			<td width='150px'><a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>"><?php echo $value->retailerName;?></a></td>
			<td><?php echo $value->exciseCode;?></td>
			<td><?php echo $value->email;?></td>
			<td><?php echo $value->mobile;?></td>
			<!--<td><?php  echo $value->state;?></td>
			<td style="text-align:center;"><a href="#"><?php echo $value->typeName;?></a></td> -->
			<td><?php echo $srName;?></td>
			<td><?php echo $value->typeName;?></td>
			<td><?php echo $value->subTypeName;?></td>
			<td><?php echo $value->catogoryName;?></td>
			<!--<td><?php //echo $value->groupId;?></td>
			<td><?php //echo $value->groupName;?></td> 
			<td><?php //echo $value->;?></td>-->
			<td> 
			<a href="retailer-profile.php?retailerid=<?php echo $value->retailerId;?>&source=edit">
			   <button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</a>
			<button type="button" class="btn btn-danger small-btn" onclick="retailersDelete(<?php echo $value->retailerId;?>)"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
			</td>
		</tr>
	<?php }?>
		
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
}
}
/*=================================================================END ADVANCE SEARCH BY GROUP==========================================*/
/*==================================================================ADVANCE SEARCH BY PRODUCT ===========================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetproductBysearchparam'){ 
    //echo '<pre>';print_r($_POST);
	extract($_POST);
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'brandId'=>$brand_name,'productCategoryId'=>$category,'packageTypeId'=>$packageType,'productType'=>$productType,'productSubType'=>$subTpe,'productLicense'=>$licence);
	//echo '<pre>';print_r($form_designation);
	$data_string=json_encode($form_designation);	
	$url="http://".$baseurl."/salesforceapi/getProduct";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $data=curl_exec($ch);
	// echo $data;
	curl_close($ch);
	//print_r($data);
	$rowdata=json_decode($data);
    //echo '<pre>'; print_r($rowdata);
if($rowdata->status!='success'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
 <table class="table table-striped"  id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td><input type="checkbox" id="checkAll"/></td>
        <th>Product Name</th>
		<th>Product Code</th>
        <th>Brand Name</th>
        <th>Brand Code</th>
		<th>Category</th>
        <th>Brand Segment</th>
		<th>Sub type</th>
        <th>Product Type</th>
		<th>Qty.(ML)</th>
		<th>Status</th>
		<!--<th>Action</th>-->
      </tr>
    </thead>
<tbody>
	<?php 	foreach($rowdata->listProduct as $value){ 
	      //echo '<pre>';print_r($rowdata->listProduct);
	?>
	    <tr>
			<td><input type="checkbox" class="checkItem" value="<?php echo $value->productId;?>" /></td>			
			<td><a href="edit_product.php?pro_id=<?php echo  $value->productId;?>&source=edit"><?php echo $value->productName;?></td>
			<td><?php echo $value->productCode;?></td>
			<td><?php echo $value->brandName;?></td>
			<td><?php echo $value->brandCode;?></td>
			<td><?php echo $value->productcategoryName;?></td>
			<td><?php echo $value->productSegmentName;?></td>
			<td><?php echo $value->productSubTypeName;?></td>
			<td><?php echo $value->productTypeName;?></td>
			<?php $status = $value->productStatus;
			
			   
				if($status=="1"){
					$myValue="Active";	
					$color="Green";
				}else if ($status=="2"){
					$myValue="InActive";
					$color="Red";
				}
				//echo $myValue;
				
				?>
			<td><?php echo $value->qtyInpcsValue;?></td>
			<td style="<?= ($status==2)?'color:red':'color:green' ?>"><?php echo $myValue;?></td>
		
		<!--<td> 
			<a href="edit_product.php?pro_id=<? //= $value->productId;?>&source=edit"><button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
		</td>-->
		</tr>
		<?php  } ?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>

<?php	
}
}
/*==================================================================END ADVANCE SEACH BY PRODUCT===========================================*/
/*==================================================================ADVANCE SEARCH BY ASM TEAM===============================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetasmBysearchparam'){ 
    //echo '<pre>';print_r($_POST);
	extract($_POST);
    $form_designation=array('managerid'=>$manager,'asmId'=>$asm,'tsmid'=>$tsm,'roleId'=>$roleId);
	$data_string=json_encode($form_designation);
   // echo '<pre>';print_r($data_string);	
	$url="http://".$baseurl."/salesforceapi/getTeamByAdvanceSearch";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $data=curl_exec($ch);
	// echo $data;
	curl_close($ch);
	//print_r($data);
	$getasm=json_decode($data);
    //echo '<pre>'; print_r($rowdata);die;
if($getasm->status!='success'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
	   
  <table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<td>&nbsp;</td>
        <th>Name</th>
        <th>Emp-Id</th>
        <th>Designation</th>
		<th>Role Name</th>
		<th>Report to </th>
		<th>Email</th>
        <th>Mobile</th>
		<th>Joining Date</th>
		<th>Retailer</th>
        <th>City</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($getasm->lstMemberResponse as $value){ ?>
	    <tr>
			<td>&nbsp;</td>			
			<td><a href="profile_asm.php?empid=<?php echo $value->employeeId; ?>"><?php echo $value->employeeName;?></a></td>
			<td><?php echo $value->empId;?></td>
			<td><?php echo $value->designationname;?></td>
			<td><?php echo $value->roleName;?></td>
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
			<td> 
			<a href="profile_asm.php?empid=<?php echo $value->employeeId; ?>"><button type="button" class="btn btn-primary small-btn" id="edit_member"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<button type="button" class="btn btn-danger small-btn" onclick="memberDelete(<?= $value->employeeId;?>)";><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
	<?php }?>
		
    </tbody>
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
}
}
/*==================================================================END ADVANCE SEARCH BY ASM================================================*/
/*==================================================================ADVANCE SEARCH BY TSM=====================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetsmBysearchparam'){ 
    //echo '<pre>';print_r($_POST);
	extract($_POST);
    $form_designation=array('managerid'=>$manager,'asmId'=>$asm,'tsmid'=>$tsm,'roleId'=>$roleId);
	$data_string=json_encode($form_designation);	
	$url="http://".$baseurl."/salesforceapi/getTeamByAdvanceSearch";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $data=curl_exec($ch);
	// echo $data;
	curl_close($ch);
	//print_r($data);
	$gettsm=json_decode($data);
    //echo '<pre>'; print_r($rowdata);
if($gettsm->status!='success'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
	   
  <table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
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
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($gettsm->lstMemberResponse as $value){ ?>
	    <tr>
			<td>&nbsp;</td>			
			<td><a href="profile_tsm.php?empid=<?php echo $value->employeeId; ?>"><?php echo $value->employeeName;?></a></td>
			<td><?php echo $value->empId;?></td>
			<td><?php echo $value->designationname;?></td>

              	<?php 
			//manage self reporting prince		
		
			$mycheck = $value->reportTo;
			if($mycheck==-5) {
			$mycheck=	$value->employeeId;
			}
			
			
			if($value->reportToName=='null'){
				$reportto="NA";
			}else{
				$reportto=$value->reportToName;
			}
			?>


			<td><a href="profile_tsm.php?empid=<?php echo $mycheck;?>"><?php echo $reportto;?></td>
			<td><?php echo $value->emailId;?></td>
			<td><?php echo $value->mobile;?></td>
			<td><?php echo $value->joiningDate;?></td>
			<td><a href="retailers.php?retailerid=<?php echo $value->employeeId;?>"><?php echo $value->retailerCount;?></td>
			<td><?php echo $value->state;?></td>
			<td> 
			<a href="profile_tsm.php?empid=<?php echo $value->employeeId; ?>"><button type="button" class="btn btn-primary small-btn" id="edit_member"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<button type="button" class="btn btn-danger small-btn" onclick="memberDelete(<?= $value->employeeId;?>)";><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
	<?php }?>
		
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
}
}
/*==================================================================END ADVANCE SEARCH BY TSM==================================================*/
/*==================================================================ADVANCE SEARCH EXCISE ORDER=================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='searchExciseOrder'){ 
    //echo '<pre>';print_r($_POST);
	extract($_POST);
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
	'managerid'=>$manager,
	'asmId'=>$asm,
	'tsmid'=>$tsm,
	'srid'=>$sr,
	'retailerType'=>$type,
	'retailerSubType'=>$subtype,
	'retailerCategory'=>$cat,
	'brandId'=>$brand_name,
	'licenseId'=>$licence);
	//echo '<pre>';print_r($form_designation);
	$data_string=json_encode($form_designation);	
	//echo '<pre>';print_r($data_string);
	$url="http://".$baseurl."/salesforceapi/getExciseOrderByDistributerId";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $data=curl_exec($ch);
	// echo $data;
	curl_close($ch);
	//print_r($data);
	$getexciseorder=json_decode($data);
    //echo '<pre>'; print_r($getexciseorder);
if($getexciseorder->status!='success'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
	   
  <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Order date</th>
		<th>TP No.</th>
		 <th>PO No.</th>
		<th>Retailer Name</th>
		<th>SR Name</th>
        <th>Brand Name</th>
		<th>Product Name</th>
		<th>Size (ml)</th>
		<th>Cases / PCS</th>
		<th>Dispatch Date</th>
		<th>Received Date</th>
      </tr>
    </thead>
    	<tbody>
			<?php foreach($getexciseorder->lstExciseOrder as $exciseOrderData){
                //echo '<pre>';print_r($exciseOrderData);
				?>
				<tr>
				<?php 
					?>
					<td><?= $exciseOrderData->issueDate;?></td>
					<td><?= $exciseOrderData->tpNo;?></td>
					<td><?= $exciseOrderData->poNo;?></td>
					<td><?= $exciseOrderData->retailerName;?></td>
					<td><?= $exciseOrderData->srName;?></td>
					<td><?= $exciseOrderData->brandName;?></td>
					<td><?= $exciseOrderData->productName;?></td>
					<td><?= $exciseOrderData->qtyInmlName;?></td>
					<td><?= $exciseOrderData->casesPcsQty;?></td>
					<td><?= $exciseOrderData->dispatchDate;?></td>
					<td><?= $exciseOrderData->receiveDate;?></td>
				</tr>				
				<?php }?>
			</tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
}
}
/*=================================================================END ADVANCE SEARCH EXCISE ORDER==============================================*/
/*=================================================================ADVANCE SEARCH OF PROMISE ORDER===============================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetpromiseOrderBysearchparam'){ 
    //echo '<pre>';print_r($_POST);
	extract($_POST);
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'brandId'=>$brand_name,'managerid'=>$manager,'asmId'=>$asm,'tsmid'=>$tsm,'srid'=>$sr,'retailerCategory'=>$cat,'retailerType'=>$type,'retailerSubType'=>$subTpe,'productLicense'=>$licence);
	$data_string=json_encode($form_designation);	
	$url="http://".$baseurl."/salesforceapi/getPromiseOrder";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $promise=curl_exec($ch);
	//echo $promise;die;
	curl_close($ch);
	//print_r($data);
	$getPromise=json_decode($promise);
   //echo '<pre>'; print_r($getPromise);
if($getPromise->status!='success'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
 <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Order date</th>
		<th style="width:20%;">Retailer Name</th>
		<th>SR Name</th>
        <th>Brand Name</th>
		<th>Product Name</th>
		<th>Cases / PCS</th>
      </tr>
	
    </thead>
    <tbody>
	<?php foreach($getPromise->lstPromiseOrder as $promisedata){ ?>
	    <tr>
			

			<?php foreach($promisedata->productList as $promise) {
						$takendate= $promisedata->takenDate;						
						$takenDate=date('Y-m-d',strtotime($takendate));?>
			<td><?php echo $takenDate;?></td>
			<td><?= @$promisedata->retailerName;?></td>
			<td><?= @$promisedata->visitorName;?></td>

			
			<td style="width:20px;"><?= @$promise->brandName;?></td>
			<td style="width:20px;"><?= @$promise->productName;?></td>
			
			<td><?= @$promise->qty;?></td>			
		</tr>
			
			<?php 	//echo <?= @$promise->brandName; 
			} ?>
			
	<?php }?>
		
		
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
}
}
/*=================================================================END ADVANCE SEARCH OF PROMISE ORDER============================================*/
/*=================================================================ADVANCE SEARCH OF Outstanding===================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='searchOutstanding'){ 
    //echo '<pre>';print_r($_POST);
	extract($_POST);
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
	'brandId'=>$brand_name,
	'managerid'=>$manager,
	'asmId'=>$asm,
	'tsmid'=>$tsm,
	'srid'=>$sr,
	'retailerCategory'=>$cat,
	'retailerType'=>$type,
	'retailerSubType'=>$subtype,
	'productLicense'=>$licence,
	'startDate'=>$from_date,
	'endDate'=>$to_date,
	'operationtype'=>'outstandingWise');
	$data_string=json_encode($form_designation);	
	$url="http://".$baseurl."/salesforceapi/getRetailer";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $outstanding=curl_exec($ch);
	//echo $promise;die;
	curl_close($ch);
	//print_r($data);
	$getoutstanding=json_decode($outstanding);
   //echo '<pre>'; print_r($getPromise);
if($getoutstanding->status!='success'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
 <table class="table table-striped"  id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		<th  style="width: 130px;">Retailer Name</th>
        <th>Outstanding Amount <i class="fa fa-sort" aria-hidden="true"></i></th>
		<th>SrName</th>
		<th>Type</th>
		<th>Subtype</th>
		<th>Category</th>		
        <th  style="width: 130px;">Group Name</th>		
        <th>Date</th>
		
		
        
      </tr>
    </thead>
    <tbody>
		<?php foreach($getoutstanding->lstRetailerRawData as $outstandingList){?>
	    <tr>
		  <td><?php echo $outstandingList->retailerName;?></td>
			<td><?php echo $outstandingList->outStanding;?></td>
			<td><?php echo $outstandingList->srName;?></td>
			<td><?php echo $outstandingList->typeName;?></td>
			<td><?php echo $outstandingList->subTypeName;?></td>
			<td><?php echo $outstandingList->catogoryName;?></td>			
			<td><?php echo $outstandingList->groupName;?></td>
			<td><?php echo $outstandingList->outstandingDate;?></td>
		</tr>
		<?php }?>		
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  
  </script>
<?php	
}
}
/*=================================================================END ADVANCE SEARCH OF Outstanding================================================*/
/*================================================================ADVANCE SEARCH OF PRODUCT_REPORT===================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='Getproduct-reportBysearchparam'){ 
    //echo '<pre>';print_r($_POST);
	extract($_POST);
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'brandId'=>$brand_name,'productCategoryId'=>$category,'packageTypeId'=>$packageType,'productType'=>$productType,'productSubType'=>$subTpe,'productLicense'=>$licence,'startDate'=>$start_date,'endDate'=>$end_date);
	$data_string=json_encode($form_designation);	
	$url="http://".$baseurl."/salesforceapi/getProductReport";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$product=curl_exec($ch);
	
	curl_close($ch);
	//print_r($product);
	$getProduct=json_decode($product);
   echo '<pre>'; print_r($getProduct);die;
if($getProduct->status!='success'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
 <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Brand Name</th> 
		<th>Brand Code</th>	
        <th>Product Name</th> 
		<th>Brand Type</th>	  
        <th>Product Category</th> 
		<th>Subtype</th>
		<th>Qyt. (ML)</th>
		<th>Cases / Pieces</th>
		<th>Count Of Sale</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($getProduct->listProduct as $productlist){?>
	    <tr>
			<td><?php echo $productlist->brandName;?></td>
			<td><?php echo $productlist->brandCode;?></td>
			<td><?php echo $productlist->productName;?></td>
			<td><?php echo $productlist->productSegmentName;?></td>
			<td><?php echo $productlist->productcategoryName;?></td>
			<td><?php echo $productlist->productSubTypeName;?></td>
			<td><?php echo $productlist->qtyInmlName;?></td>
			<td><?php echo $productlist->productTypeName;?></td>
			<td><?php echo $productlist->sale;?></td>
			
		</tr>
	<?php }?>
		
		
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
}
}

/*================================================================END ADVANCE PRODUCT SEARCH REPORT =================================================*/
/*================================================================ADVANCE SEARCH BY COLLECTION========================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetCollectionBysearchparam'){
	 extract($_POST);
$url="http://".$baseurl."/salesforceapi/getCollectionDetails";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'retailerType'=>$type,'retailerSubType'=>$subtype,'retailerCategory'=>$cat,'managerid'=>$manager,'asmId'=>$asm,'tsmid'=>$tsm,'srid'=>$sr,'startDate'=>$from_date,'endDate'=>$to_date,'licenseId'=>$licence);
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$get_collection=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$get_collection_amount=json_decode($get_collection);
//echo '<pre>';print_r($get_collection_amount->status);die;

if($get_collection_amount->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
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
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
}
}
/*================================================================END ADVANCE SEARCH BY COLLECTION=====================================================*/
/*=========================================ADVANCE SEARCH OF FINANCE=================================================================*/
/*================================================================ADVANCE SEARCH BY COLLECTION========================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getfinanance_report'){
	 extract($_POST);
$url="http://".$baseurl."/salesforceapi/getCollectionDetails";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'retailerType'=>$type,'retailerSubType'=>$subtype,'retailerCategory'=>$cat,'managerid'=>$manager,'asmId'=>$asm,'tsmid'=>$tsm,'srid'=>$sr,'startDate'=>$from_date,'endDate'=>$to_date,'licenseId'=>$licence,'paymentStatus'=>'y');
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$get_collection=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$get_collection_amount=json_decode($get_collection);
//echo '<pre>';print_r($get_collection_amount->status);

if($get_collection_amount->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
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
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
}
}
/*================================================================END ADVANCE SEARCH BY COLLECTION=====================================================*/
/*=========================================END FINANCE SEARCH========================================================================*/
/*================================================================ADVANCE SEARCH OF STOCK SCREEN =======================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetStcockBysearchparam'){
	 extract($_POST);
$url="http://".$baseurl."/salesforceapi/getStock";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
'retailerType'=>$retailertype,
'retailerSubType'=>$retailerSubType,
'retailerCategory'=>$retailerCat,
'brandId'=>$brand_name,
'productCategoryId'=>$proccategory,
'packageTypeId'=>$packageType,
'productSubType'=>$productsubType,
'productType'=>$productType,
'productLicense'=>$licence,
'startDate'=>$from_date,
'endDate'=>$to_date);
$designation_string=json_encode($form_designation);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$stock=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$getstock=json_decode($stock);
//echo '<pre>';print_r($getstock);
if($getstock->status=='fail'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
<table class="table table-striped" id="examples" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th> Date </th>
        <th style="width: 20%;">Retailer</th>
		<!--<th>SR Name</th>-->
		<th>Taken By</th>
		<th>Brand</th>
		<th>Product Name</th>
		<th>In Stock</th>
		<th>Action</th> 
      </tr>
    </thead>
    <tbody>
		<?php foreach($getstock->lstStockResponse as $stockData){
			
			?>
	    <tr> 
			<?php foreach($stockData->stockProductList as $stockproductlistData){
				
			$takendate= $stockData->takenDate;	
            $takenDate=date('Y-m-d',strtotime($takendate));
				?>
			<td><?= $takenDate;?><a href=""> </td>
			<td><?= $stockData->retailerName;?></td>
			<!--<td><?//= @$stockData->srName;?></td>-->
			<td><?= $stockData->visitorName;?></td>
			<td class="tddes"><?= $stockproductlistData->brandName;?></td>
			<td class="tddes"><?= $stockproductlistData->productName;?></td>
			<td><?= $stockproductlistData->qty;?></td>
			<td><!--<a href=""> <button type="button" class="btn btn-success small-btn"><i class="fa fa-map-marker" aria-hidden="true"></i></button></a>-->
			<a href=""><button type="button" class="btn btn-primary small-btn"><i  class="fa fa-info-circle" aria-hidden="true"></i></button></a>
			<!--<a href=""><button type="button" class="btn btn-info small-btn"><i  class="fa fa-file-image-o" aria-hidden="true"></i></button></a>-->
			</td>	
		</tr>
		<?php }}?>	
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#examples').DataTable();
		});
  </script>
<?php	
}	
}
/*================================================================END ADVANCE SEARCH OF STCOK SCREEN====================================================*/
/*==============================================================ADVANCE SEARCH OF CREDIT DAYS============================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='searchPaymentInCreditDays'){
	//echo '<pre>';print_r($_POST);
	extract($_POST);
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
	'brandId'=>$brand_name,
	'managerid'=>$manager,
	'asmId'=>$asm,
	'tsmid'=>$tsm,
	'srid'=>$sr,
	'retailerCategory'=>$cat,
	'retailerType'=>$type,
	'retailerSubType'=>$subtype,
	'licenseId'=>$licence,
	'startDate'=>$from_date,
	'endDate'=>$to_date);
	//echo '<pre>';print_r($form_designation);
	$data_string=json_encode($form_designation);	
	$url="http://".$baseurl."/salesforceapi/getPaymentInCreditDays";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $credit=curl_exec($ch);
	//echo $promise;die;
	curl_close($ch);
	//print_r($data);
	$getCredit=json_decode($credit);
   //echo '<pre>'; print_r($getCredit);die;
if($getCredit->status!='success'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
 <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		
        <th>Order Date</th>
		<th>Retailer Name</th>
        <th>PoNo</th>
		<th>Category</th>
		<th>Amount</th>
		<th>Excise Duty Amount</th>
		<th>CR Days Left</th>
		<th>CR Days Date</th>
		
      </tr>
    </thead>
    <tbody>
			<?php foreach($getCredit->list as $creditList){?>
	    <tr>
			<td><?php echo $creditList->orderDate;?></td>
			<td><?php echo $creditList->retailerShopName;?></td>
			<td><?php echo $creditList->poNo;?></td>
			<td><?php echo $creditList->retailercatagory;?></td>			
			<td><?php echo $creditList->amount;?></td>
			<td><?php echo $creditList->excerciseDutyAmount;?></td>
			<td><?php echo $creditList->creditDays;?></td>
			<td><?php echo $creditList->endDate;?></td>
			
		</tr>
			<?php }?>
		
		
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
}
}
/*==============================================================END ADVANCE SEARCH OF CREDIT DAYS=========================================================*/		
/*=============================================================ADVANCE SEARCH OF RETAILER ASSIGN ASSETS===================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetRetailer_assets'){
	
	extract($_POST);
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
	'retailerCategory'=>$cat,
	'retailerType'=>$type,
	'retailerSubType'=>$subTpe,
	'assetId'=>$assets);
	$data_string=json_encode($form_designation);	
	$url="http://".$baseurl."/salesforceapi/getAssetByRetailerId";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $assign=curl_exec($ch);
	//echo $promise;die;
	curl_close($ch);
	//print_r($data);
	$getassignAssets=json_decode($assign);
   //echo '<pre>'; print_r($getassignAssets);
if($getassignAssets->status!='success'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
 <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Retailer</th>
        <th>Store keep</th>
		<th>SR Name</th>
       	<th>Qty.</th>
		<th>Amount</th>
		<th>Date</th>
		<th>Asset Type</th>
		<!--<th>Status</th>-->
      </tr>
    </thead>
    <tbody>
		<?php foreach($getassignAssets->listAsset as $assignAssetsData){
				foreach($assignAssetsData->lstAssetDetail as $assignAssetsdetails){
					//echo '<pre>';print_r($assignAssetsData);
			?>
	    <tr>
			<td><?php echo  $assignAssetsData->retailerName;?></td>
			<td><?php echo  $assignAssetsdetails->assetName;?></td>
			<td><?php echo  $assignAssetsData->auditByName;?></td>
			<td><?php echo  $assignAssetsData->qty;?></td>
			<td><?php echo  $assignAssetsData->amount;?></td>
			<td><?php echo  $assignAssetsData->assignDate;?></td>			
			<td><?php echo  $assignAssetsdetails->assetType;?></td>
			  
			<!--<td> 
			<p style="color:#038103;">Active</p>
			
			</td>  -->
		</tr>
		<?php }}?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
}
}
/*=============================================================END ADVANCE SEARCH OF RETAILER ASSIGN ASSETS================================================*/
/*==============================================================ADVANCE SEARCH OF RETAILE AUDIT ASSETS======================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetRetailerAudit_assets'){
  	extract($_POST);
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'retailerCategory'=>$cat,'retailerType'=>$type,'retailerSubType'=>$subTpe,'assetId'=>$assets,'operationtype'=>'audit');
	$data_string=json_encode($form_designation);	
	$url="http://".$baseurl."/salesforceapi/getAssetByRetailerId";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $assignaudit=curl_exec($ch);
	//echo $promise;die;
	curl_close($ch);
	//print_r($data);
	$getassignaudit=json_decode($assignaudit);
   //echo '<pre>'; print_r($getassignaudit);
if($getassignaudit->status!='success'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
 <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th style="width:20%;">Retailer</th>
        <th>Assets Name</th>
		<th>SR Name</th>
       	<th>Qty.</th>
		<th>Amount</th>
		<th>Date</th>
		
      
        <th>Last update</th>
		<th>Rating</th>
		<th>Image</th>
		<th>Available</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach($getassignaudit->listAsset as $assignAuditData){
				foreach($assignAuditData->lstAssetDetail as $assignAuditdetails){
					//echo '<pre>';print_r($assignAuditData);
					//$img='http://'.$baseurl."/".$assignAuditData->image1;
					$img='http://157.119.91.195:15000/'.$assignAuditData->image1;
					?>
	    <tr>
			<td><?php echo $assignAuditData->retailerName;?></td>
			<td><?php echo $assignAuditdetails->assetName;?></td>
			<td><?php echo $assignAuditData->auditByName;?></td>
			<td><?php echo $assignAuditData->qty;?></td>
			<td><?php echo $assignAuditData->amount;?></td>
			<td><?php echo $assignAuditData->auditDate;?></td>
			
			
			<td><?php echo $assignAuditdetails->lastUpdate;?></td>
			<td><?php echo $assignAuditData->feedbackRatingName;?></td>
			<td><!--<button type="button" class="btn btn-primary small-btn"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>-->
				<button type="button" class="btn btn-info small-btn" data-toggle="modal" data-target="#myModal_audit" onclick="auditImage('<?php echo $img;?>')"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>
			
			</td>
			
			<td> 
			<p style="color:#038103;"><?php echo $assignAuditData->isAvailable;?></p>
			
			</td>  
		</tr>
		<?php }}?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
}	
}
/*=============================================================END ADVANCE SEARCH OF RETAILER AUDIT ASSETS==================================================*/
/*==============================================================ADVANCE SEARCH OF RETAILERS VISIT REPORT=====================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='retsilers_visitReport'){
 	extract($_POST);
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'managerid'=>$manager,'asmId'=>$asm,'tsmid'=>$tsm,'srid'=>$sr,'startDate'=>$from_date,'endDate'=>$to_date);
	$data_string=json_encode($form_designation);	
	$url="http://".$baseurl."/salesforceapi/getRetailerVisitReport";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailers_visit=curl_exec($ch);
	//echo $promise;die;
	curl_close($ch);
	//print_r($data);
	$getTeam_activity=json_decode($retailers_visit);
   //echo '<pre>'; print_r($getTeam_activity);
if($getTeam_activity->status!='success'){
	?>
	<p style="margin-left: 384px;;color:red;">NO DATA FOUND</p>
	<?php
	
}else{
?>
 <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th style="width:20%;">Retailer name</th>
        <th>Sales</th>
		<th>Outstanding</th>
		<th>Collection</th>
		<th>No. of visit</th>
        <th>Actual Order</th>
		<th>Report</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach($getTeam_activity->list as $teamactivityData){			
		//print_r($teamactivityData);
		?>
		 <tr>
			<td><a href="retailer-profile.php?retailerid=<?php echo $teamactivityData->retailerId; ?>" ><?php echo  $teamactivityData->retailerName;?></td>	<td><?php echo  $teamactivityData->sale;?></td>
			<td><?php echo  $teamactivityData->outStanding;?></td>
			<td><?php echo  $teamactivityData->collection;?></td>
			<td><a href="team_activity_history.php?retailerid=<?php echo $teamactivityData->retailerId;?>&first_date=<?php echo $first_date; ?>&last_date=<?php echo $last_date; ?>"><?php echo  $teamactivityData->visitCount;?></a></td>
			<td><?php echo  $teamactivityData->actualOrder;?></td>
			<td><a href="view_sale_board.php?retailerId=<?php echo $teamactivityData->retailerId;?>">Compare</a></td>
		</tr>
		<?php
	     
		 }
		 ?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
<?php	
	
}	

}
/*==============================================================END ADVANCE SEARCH OF RETAILERS VISIT REPORT=================================================*/
/*******************************************************************GET EXCISE ODER BY RETAILE ID****************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getexciseDetailsByRetailerId'){
	extract($_POST);
	    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'id'=>$retailerId,'licenseId'=>$licenceId,'paymentStatus'=>"yes");
		//echo '<pre>';print_r($form_designation);
		$designation_string=json_encode($form_designation);
		$url="http://".$baseurl."/salesforceapi/getExciseOrderByDistributerId";
		$header=array('Accept: application/json',
			'Content-Type: application/json');
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
		curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
			'Content-Type: application/json')                                                                    
		);                               	
		$exciseorder=curl_exec($ch);
		curl_close($ch);
		$getexciseorder=json_decode($exciseorder);
		//echo '<pre>';print_r($getexciseorder->lstExciseOrder);
		?>
		<table class="table" id="getexciseData">
  <thead>
    <tr>
      <th scope="col">Retailer Name</th>
      <th scope="col">Tp No</th>
      <th scope="col">Po No</th>
      <th scope="col">Date</th>
	  <th scope="col">Wsp/Excise</th>
	  <th scope="col">Status</th>
	  
    </tr>
  </thead>
  <tbody>
  <?php
  $i=0;
  foreach($getexciseorder->lstExciseOrder as $exciseList){
	 //echo '<pre>';print_r($getexciseorder->lstExciseOrder);
	    // echo '<pre>';print_r($exciseList->lstPaymentIteration);
		//echo $exciseList->amountStatus;
		
	 if($exciseList->amountStatus!='F'){
		     ?>
	  <tr>
      <th scope="row"><?php echo $exciseList->retailerName;?></th>
      <td><?php echo $exciseList->tpNo;?></td>
      <td><?php echo $exciseList->poNo;?></td>
      <td><?php echo $exciseList->issueDate;?></td>
	  <?php
	    if($paymentType=='tax'){
			
			$value=$exciseList->exciseDuty.'-'.$exciseList->exciseOrderId;
			
			?>
			 <td><?php echo $exciseList->exciseDuty;?></td>
			 
			  <td><div class="mydiv">
			  <input name="amountcheck" type="checkbox" value="<?php echo $value;?>" onclick="GetAmountArrayList(<?php echo $exciseList->exciseOrderId;?>,<?php echo $exciseList->netPaybleAmount;?>);">
			  </div></td>
			<?php
		}else{
		
				$amountDa=$exciseList->amount;
				$value=$amountDa.'-'.$exciseList->exciseOrderId.'-'.$i;
				?>
				<td><?php echo $amountDa;?></td>
				 <td><div class="mydiv">
			  <input name="amountcheck" type="checkbox" value="<?php echo $value;?>" onclick="GetAmountArrayList(<?php echo $exciseList->exciseOrderId;?>,<?php echo $exciseList->netPaybleAmount;?>);">
			  </div></td>
				</td>
				<?php
					
		}
	  ?>
    </tr>
	  <?php			
	}
	
  }
  ?>
    
  </tbody>
</table>
<!--<p>Full amount:-<span id="full_amount"></span></p>||<p>Partial Amount:-<span id="partialAmount"></span></p>-->
<input type="hidden" id="payLastAmount">
<input type="hidden" id="FinalData">

<script>
/***************************************************GET CSV VALUE OF CHECK BOX**************************************************/

 function updateTextArea() {
          let AmountExceed1=$('#calamount').val();
		   let checkedboxId=$('#checkedIndex').val();
		   //alert('exsheed'+AmountExceed1+'-checedBoxID'+checkedboxId);
		    let check=$("input[type='checkbox']").is(':checked'); 
		//alert('check'+check);
			if(check==true){
				if(AmountExceed1<=0){
               // alert('not checked');
                 $(this).attr('checked', false);
			  
			  location.reload(true);
               
				
          }else{
	              var allVals = [];

            $('.mydiv :checked').each(function () {

                allVals.push($(this).val());
            });
			//alert(allVals);
			
			var array=[];
			var array = allVals;
			
			var str = array.join();
			var FinalData = str.split(",");
			console.log(FinalData);
			$('#FinalData').val(FinalData);
	  
        }
				
	}
 }
        $(function () {
            $('.mydiv input').click(updateTextArea);
            updateTextArea();
        });
function GetAmountArrayList(orderId,amount){
	
	
	    let listOrder= [];
		var AmountArray=[];
		var mountData=[];
		
     	listOrder=[orderId,amount];
		//alert(listOrder);
		AmountArray=[amount];
		
		$.each($("input[name='amountcheck']:checked"), function(){  

		var split_id = $(this).val().split('-');

		   // New index
		var index = Number(split_id[0]);
		//alert(index);
		
         mountData.push(index);
  });
 var st_arrk = mountData.join(); 
		
		
				//alert(st_arrk);

		 st_arr= eval(mountData.join("+"));
		// alert('strval-'+st_arr);
		 
			let fixedAmount=$('#calamount').val();
			//alert(fixedAmount+'fixedAmount'+parseInt(st_arr));
			
			
	//alert("fixed"+fixedAmount+'=checked'+parseInt(st_arr)); 
	
	 let c=st_arr-fixedAmount;
	
	let netamount=$('#netamount').val(st_arr);
	 $('#partial').val(c);
	$('#checkedamount').val(parseInt(st_arr));
	  
	 

 
 
		//console.log(listOrder);
		 let finalArray=[];
		
		 finalArray=listOrder.push(orderId,amount);
		  listOrder.join("@");
		  //console.log(finalArray);
}

$( document ).ready(function() {
     /***************************CHECKED CONDITION*********************************************/
	// alert(AmountExceed1);  
	  $("input" ).on( "click", function() {
		
 let am=$("input:checked").val();
 
 var StatuId = []; 
             
         $.each($("input[type='checkbox']"), function(){   
             
               //alert(l);	
			 let lcheck=$("input[type='checkbox']").is(':checked'); 
			 
              if(lcheck==true){

				   StatuId.push($(this).val());
				   
			  }else{
				  var indexValdata=$('#checkedIndex').val();
				
				    if(indexValdata==''){
						$('#netamount').val('');
						$('#partial').val('');
						$('input[type="checkbox"]').prop('checked' , false);
						
				        return false;
						
					}
					location.reload(true);
				  //  alert('not checked');
					//$(this).attr('checked', false);
					
			  }			   
        
  });
 var st_arr = StatuId.join(); 
 //alert(st_arr);
 
 
 let str=String(st_arr);
 //alert('string'+str);
 let  array = str.split("-");
 

 let checkedAmount=parseInt(array[0]);
 let arraychekedId=$('#checkedIndex').val(array[2]);
 let len=$("input[type='checkbox']").is(':checked'); 
 /*if(AmountExceed1<=0){
	 return false;
 }*/
});

/***************************************END CHECKED CONDITION************************************/ 
});
/*****************************************************END GET CHECKBOX VALUE*****************************************************/
</script>

<?php
}
/**************************************************************END GET EXCISE ORDER BY RETAILER ID****************************************/ 


/**********************************************************PaymentApprove ****************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='PaymentApprove'){
	extract($_POST);
	//echo '<pre>';print_r($_POST);
	$finalList=explode(',',$FinalData);
	//echo '<pre>'; print_r($finalList);
	$arrayListIndex=array();
	
	//echo $l=sizeof($finalList);
	//echo '<pre>';print_r($finalList);
    $d=sizeof($finalList);
	if($d==1){
		$arrayIndex=explode('-',$finalList[0]);
		//echo '<pre>';print_r($arrayIndex);
		if($partial==0){
			 $arrayListIndex[]=array('excieOrderNo'=>$arrayIndex[1],'amount'=>$netamount,'paymentStatus'=>'F');
			//$arrayListIndex[]=array('excieOrderNo'=>$arrayIndex[1],'amount'=>$partialt,'paymentStatus'=>'p');
			
		}else{
			//echo 'elsell';
			//$arrayListIndex[]=array('excieOrderNo'=>$arrayIndex[1],'amount'=>$partial,'paymentStatus'=>'F');
			$arrayListIndex[]=array('excieOrderNo'=>$arrayIndex[1],'amount'=>$partial,'paymentStatus'=>'p');
			$arrayListIndex[]=array('excieOrderNo'=>$arrayIndex[1],'amount'=>$calamount,'paymentStatus'=>'F');
		}
		
			
	}
	else{	
		$list=$d-1;
		//echo 'list-'.$list; 
	for($i=0;$i<sizeof($finalList);$i++){
		//echo '$i-'.$i;
		$arrayIndex=explode('-',$finalList[$i]);
		//echo '<pre>';print_r($arrayIndex);
		$paymentStatus='F';
		//echo $i.'va-'.$list.'<br>';
		$partialAmount=$arrayIndex[0];
		if($i==$list){
			
		//$partialAmount=$partialAmountNew;
		$paymentStatus='P';	
		}
		$arrayListIndex[]=array('excieOrderNo'=>$arrayIndex[1],'amount'=>$partialAmount,'paymentStatus'=>$paymentStatus);
		//echo'<pre>';print_r($arrayListIndex);	
	}
	}
	
	//$finalArray[]=$arrayListIndex;
   // echo '<pre>';print_r($arrayListIndex);
	$orderListArray=array_pop($a);
	//echo 'Amount'.$pay_amount.'<='.$netamount;
	if($pay_amount<=$netamount){
	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
	'paymentId'=>$paymentId,
	'retailerId'=>$retailerId,
	'visitorId'=>$visitorId,
	'paymentMode'=>$paymentMode,
	'licenseId'=>$licenceId,
	'refrenceNo'=>$refrenceNo,
	'paymentAmount'=>$pay_amount,
	'paymentAmountType'=>$paymentType,
	'updatedId'=>$_SESSION['userData']['employeeId'],
	'orderList'=>$arrayListIndex);
	//echo '<pre>';print_r($form_designation);
	//die;

	
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
    $url="http://".$baseurl."/salesforceapi/PaymentApprove";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailersubtype=curl_exec($ch);
	curl_close($ch);
	print_r($retailersubtype);
	
	}
	else{
		$retailersubtype=array('statusCode'=>1,'message'=>'Payment shoul be Less Than or equal To Total Bill');
	}
	$data=json_encode($retailersubtype);
	print_r($data);
}
/*********************************************************END PaymentApprove**************************************************************/
/**************************************************************finance_search**************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='finance_search'){
	extract($_POST);
	 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'paymentStatus'=>'yes','startDate'=>$formDate,'endDate'=>$Todate,'licenseId'=>$licence);
	//echo '<pre>';print_r($form_designation);
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
	//echo '<pre>';print_r($get_collection_amount->status);
	?>
	
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th style="width: 130px;">Retailer Name</th>
		<th>SR Name</th>
		<th>Payment Date</th>
		<th>Taken By</th>
		<th>Reference No</th>
		<th>License</th>
		<th>Payment Amount</th>
		<th>Payment Type</th>
        <th>Retailer Type</th>	
		<th>Status</th>
        <!--<th>Date</th>-->
      </tr>
    </thead>
    <tbody>
	   <?php
	   //echo 'date-'.$date;
	       $status=$get_collection_amount->status;
	      foreach($get_collection_amount->list as $collection){
			 //echo '<pre>';print_r($collection);
			
			 if($status=='success'){
				 
				  if($collection->outstandingStatus!='Y'){
					  // echo $collection->outstandingStatus;
					   
					   ?>
			 
          <tr>
			<td><a href="retailer-profile.php?retailerid=<?php echo $collection->retailerId;?>&source=edit"><?php echo $collection->retailerName;?></a></td>
			<td><a href="profile_sr.php?empid=<?php ?>"><?php echo $collection->srName;?></a></td>
			<td><?php echo $collection->paymentDate;?></td>
			<td><a href="profile_managers.php?empid=<?php echo $collection->visitorId;?>"><?php echo $collection->visitorName;?></a></td>
			<td><?php echo $collection->refrenceNo;?></td>
			<td><?php echo $collection->licenceName;?></td>
			<td><?php echo $collection->paymentAmount?></td>
			<td><?php if($collection->paymentAmountType=='actualAmount'){
					  echo 'Wsp';  
				  }else{
					  echo 'Excise';
				  }?></td>
			<td><?php echo $collection->retailerType;?></td>
			
			<td>
				<a class="btn btn-success btn-sm" onclick="javascript:Getapprove(<?php echo $collection->retailerId;?>,<?php echo $collection->licenseId;?>,'<?php echo $collection->paymentAmountType;?>',<?php echo $collection->paymentAmount;?>,<?php echo $collection->paymentId;?>,<?php echo $collection->visitorId?>,'<?php echo $collection->paymentMode;?>','<?php echo $collection->refrenceNo;?>');" data-toggle="modal" data-target="#myModal1" style="font-size: 12px; padding: 6px; color: white;">Accept</a>
				<a>|</a>
				<a class="btn btn-danger btn-sm" onclick="javascript:Disapprove(<?php echo $collection->paymentId;?>);" data-toggle="modal" data-target="#myModal" style="font-size: 12px; padding: 6px; color: white;">Decline</a>
			</td>
			
		</tr>			  
			  <?php	 
				  }
				
			 }  
			  else{
				
				  ?>
		       <p style="color:red;text-align:center;">DATA NOT FOUND</p>
		     <?php
			     	
}
		  }
		  
	   ?>    
    </tbody>
	

  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	
	<?php
	
	  if($get_collection_amount->status=='fail'){
		?>
		<p style="color:red;margin-left: 435px;">Page Not Found</p>
		<?php
	}
	?>
	<?php

}
			
/******************************************************************END finance_search*******************************************************/

/*********************************************************finance_search_disapprove *********************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='finance_search_disapprove'){
	extract($_POST);
	 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'paymentStatus'=>'d','startDate'=>$formDate,'endDate'=>$Todate,'licenseId'=>$licence);
	//echo '<pre>';print_r($form_designation);
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
	//echo '<pre>';print_r($get_collection_amount->status);
	?>
	
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th style="width: 130px;">Retailer Name</th>
		<th>SR Name</th>
		<th>Payment Date</th>
		<th>Taken By</th>
		<th>Reference No</th>
		<th>License</th>
		<th>Payment Amount</th>
		<th>Payment Type</th>
        <th>Retailer Type</th>	
		<th>Status</th>
        <!--<th>Date</th>-->
      </tr>
    </thead>
    <tbody>
	   <?php
	   //echo 'date-'.$date;
	       $status=$get_collection_amount->status;
	      foreach($get_collection_amount->list as $collection){
			 //echo '<pre>';print_r($collection);
			
			 if($status=='success'){
				?>
			 
          <tr>
			<td><a href="retailer-profile.php?retailerid=<?php echo $collection->retailerId;?>&source=edit"><?php echo $collection->retailerName;?></a></td>
			<td><a href="profile_sr.php?empid=<?php ?>"><?php echo $collection->srName;?></a></td>
			<td><?php echo $collection->paymentDate;?></td>
			<td><a href="profile_managers.php?empid=<?php echo $collection->visitorId;?>"><?php echo $collection->visitorName;?></a></td>
			<td><?php echo $collection->refrenceNo;?></td>
			<td><?php echo $collection->licenceName;?></td>
			
			<td><?php echo $collection->paymentAmount?></td>
			<td><?php if($collection->paymentAmountType=='actualAmount'){
					  echo 'Wsp';  
				  }else{
					  echo 'Excise';
				  }?></td>
			<td><?php echo $collection->retailerType;?></td>
			
			<?php
			if($collection->isDelete=='N' && $collection->outstandingStatus=='D'){
				?>
			      <td>
				<a class="btn btn-success btn-sm" onclick="javascript:Getapprove(<?php echo $collection->retailerId;?>,<?php echo $collection->licenseId;?>,'<?php echo $collection->paymentAmountType;?>',<?php echo $collection->paymentAmount;?>,<?php echo $collection->paymentId;?>,<?php echo $collection->visitorId?>,'<?php echo $collection->paymentMode;?>','<?php echo $collection->refrenceNo;?>');" data-toggle="modal" data-target="#myModal1" style="font-size: 12px; padding: 6px; color: white;">Accept</a>
				<a>|</a>
				<a class="btn btn-danger btn-sm" onclick="javascript:Disapprove(<?php echo $collection->paymentId;?>);" data-toggle="modal" data-target="#myModal" style="font-size: 12px; padding: 6px; color: white;">Decline</a>
			</td>	
				<?php
				
			}else{
				?>
			<td><?php echo $collection->deleteNote;?></td>	
			<?php
			}
			?>
			
		</tr>			  
			  <?php	 
			 } 
              
	 }
		  
	   ?>    
    </tbody>
	

  </table>
  <script>
    $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	
	<?php
	
	  if($get_collection_amount->status=='fail'){
		?>
		<p style="color:red;margin-left: 435px;">Data Not Found</p>
		<?php
	}
	?>
	<?php

}			
/****************************************************************END finance_search_disapprove************************************************/	
/********************************************************finance_search_approve **************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='finance_search_approve'){
	extract($_POST);
	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'startDate'=>$formDate,'endDate'=>$Todate,'licenseId'=>$licence);
	//echo '<pre>';print_r($form_designation);
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
	//echo '<pre>';print_r($get_collection_amount->status);
	?>
	
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
       <th style="width: 130px;">Retailer Name</th>
		<th>SR Name</th>
		<th>Approve By</th>
		<th>Reference No</th>
		<th>License</th>
		<th>Payment Type</th>
        <th>Amount</th>
        <!--<th>Date</th>-->
      </tr>
    </thead>
    <tbody>
	   <?php
	   //echo 'date-'.$date;
	       $status=$get_collection_amount->status;
	      foreach($get_collection_amount->list as $collection){
			 //echo '<pre>';print_r($collection);
			
			 if($status=='success'){
				 if($collection->outstandingStatus=='Y'){
				   ?>
			 
          <tr>
			<td><a href="retailer-profile.php?retailerid=<?php echo $collection->retailerId;?>&source=edit"><?php echo $collection->retailerName;?></a></td>
			<td><a href="profile_sr.php?empid=<?php ?>"><?php echo $collection->srName;?></a></td>
			<td><?php echo $collection->aprooveBy;?></td>
		
			<td><?php echo $collection->refrenceNo;?></td>
			<td><?php echo $collection->licenceName;?></td>
			<td><?php if($collection->paymentAmountType=='actualAmount'){
					  echo 'Wsp';  
				  }else{
					  echo 'Excise';
				  };?></td>
			<td><?php echo $collection->paymentAmount;?></td>
			
		</tr>			  
			  <?php	 
				 }
					 
			 } 
                
	 }
		  
	   ?>    
    </tbody>
	

  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	<?php
	
	  if($get_collection_amount->status=='fail'){
		?>
		<p style="color:red;margin-left: 435px;">Data Not Found</p>
		<?php
	}
	?>
	<?php
}
/*********************************************************END finance_search_approve**********************************************************/
/**********************************************************getfinanance_payementReport *******************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getfinanance_payementReport'){
	extract($_POST);
	 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'paymentStatus'=>'yes','startDate'=>$from_date,'endDate'=>$to_date,'licenseId'=>$licence,'retailerType'=>$type,'retailerSubType'=>$subtype,'retailerCategory'=>$cat,);
	//echo '<pre>';print_r($form_designation);
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
	//echo '<pre>';print_r($get_collection_amount->status);
	?>
	
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th style="width: 130px;">Retailer Name</th>
		<th>SR Name</th>
		<th>Payment Date</th>
		<th>Taken By</th>
		<th>Reference No</th>
		<th>License</th>
		<th>Payment Amount</th>
		<th>Payment Type</th>
        <th>Retailer Type</th>	
		<th>Status</th>
        <!--<th>Date</th>-->
      </tr>
    </thead>
    <tbody>
	   <?php
	   //echo 'date-'.$date;
	       $status=$get_collection_amount->status;
	      foreach($get_collection_amount->list as $collection){
			 //echo '<pre>';print_r($collection);
			
			 if($status=='success'){
				?>
			 
          <tr>
			<td><a href="retailer-profile.php?retailerid=<?php echo $collection->retailerId;?>&source=edit"><?php echo $collection->retailerName;?></a></td>
			<td><a href="profile_sr.php?empid=<?php ?>"><?php echo $collection->srName;?></a></td>
			<td><?php echo $collection->paymentDate;?></td>
			<td><a href="profile_managers.php?empid=<?php echo $collection->visitorId;?>"><?php echo $collection->visitorName;?></a></td>
			<td><?php echo $collection->refrenceNo;?></td>
			<td><?php echo $collection->licenceName;?></td>
			<td><?php echo $collection->paymentAmount?></td>
			<td><?php if($collection->paymentAmountType=='actualAmount'){
					  echo 'Wsp';  
				  }else{
					  echo 'Excise';
				  }?></td>
			<td><?php echo $collection->retailerType;?></td>
			
			<td>
				<a class="btn btn-success btn-sm" onclick="javascript:Getapprove(<?php echo $collection->retailerId;?>,<?php echo $collection->licenseId;?>,'<?php echo $collection->paymentAmountType;?>',<?php echo $collection->paymentAmount;?>,<?php echo $collection->paymentId;?>,<?php echo $collection->visitorId?>,'<?php echo $collection->paymentMode;?>','<?php echo $collection->refrenceNo;?>');" data-toggle="modal" data-target="#myModal1" style="font-size: 12px; padding: 6px; color: white;">Accept</a>
				<a>|</a>
				<a class="btn btn-danger btn-sm" onclick="javascript:Disapprove(<?php echo $collection->paymentId;?>);" data-toggle="modal" data-target="#myModal" style="font-size: 12px; padding: 6px; color: white;">Decline</a>
			</td>
			
		</tr>			  
			  <?php	 
			 }  
			  else{
				
				  ?>
		       <p style="color:red;text-align:center;">DATA NOT FOUND</p>
		     <?php     	
}
		  }
	   ?>    
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	<?php
	
	  if($get_collection_amount->status=='fail'){
		?>
		<p style="color:red;margin-left: 435px;">Page Not Found</p>
		<?php
	}
	?>
	<?php

}
/*********************************************************END getfinanance_payementReport******************************************************/
/**********************************************************getfinanance_payementapproveReport **************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getfinanance_payementapproveReport'){
	extract($_POST);
	 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'paymentStatus'=>'y','startDate'=>$from_date,'endDate'=>$to_date,'licenseId'=>$licence,'retailerType'=>$type,'retailerSubType'=>$subtype,'retailerCategory'=>$cat);
	//echo '<pre>';print_r($form_designation);
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
	//echo '<pre>';print_r($get_collection_amount->status);
	?>
	
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th style="width: 130px;">Retailer Name</th>
		  <th style="width: 130px;">Retailer Name</th>
		<th>SR Name</th>
		<th>Approve By</th>
		<th>Reference No</th>
		<th>License</th>
		
		<th>Payment Type</th>
        <th>Amount</th>
        <!--<th>Date</th>-->
      </tr>
    </thead>
    <tbody>
	   <?php
	   //echo 'date-'.$date;
	       $status=$get_collection_amount->status;
	      foreach($get_collection_amount->list as $collection){
			 //echo '<pre>';print_r($collection);
			
			 if($status=='success'){
				?>
			 
          <tr>
		<td><a href="retailer-profile.php?retailerid=<?php echo $collection->retailerId;?>&source=edit"><?php echo $collection->retailerName;?></a></td>
			<td><a href="profile_sr.php?empid=<?php ?>"><?php echo $collection->srName;?></a></td>
			<td><?php echo $collection->aprooveBy;?></td>
			
		  
			<td><?php echo $collection->refrenceNo;?></td>
			<td><?php echo $collection->licenceName;?></td>
			<td><?php echo $collection->paymentAmountType;?></td>
		
			
			
			<td><?php echo $collection->paymentAmount;?></td>
			
		</tr>			  
			  <?php	 
			 }  
			  else{
				
				  ?>
		       <p style="color:red;text-align:center;">DATA NOT FOUND</p>
		     <?php
			     	
}
		  }
		  
	   ?>    
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	<?php
	
	  if($get_collection_amount->status=='fail'){
		?>
		<p style="color:red;margin-left: 435px;">Page Not Found</p>
		<?php
	}
	?>
	<?php
	
}
/*************************************************************END getfinanance_payementapproveReport********************************************/
/**************************************************************getfinanance_report_disapprove***************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getfinanance_report_disapprove'){
	extract($_POST);
	 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'paymentStatus'=>'d','startDate'=>$formDate,'endDate'=>$Todate,'licenseId'=>$licence,'retailerType'=>$type,'retailerSubType'=>$subtype,'retailerCategory'=>$cat);
	//echo '<pre>';print_r($form_designation);
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
	//echo '<pre>';print_r($get_collection_amount->status);
	?>
	
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th style="width: 130px;">Retailer Name</th>
		<th>SR Name</th>
		<th>Payment Date</th>
		<th>Taken By</th>
		<th>Reference No</th>
		<th>Payment Amount</th>
		<th>Payment Type</th>
		<th>Status</th>
        <!--<th>Date</th>-->
      </tr>
    </thead>
    <tbody>
	   <?php
	   //echo 'date-'.$date;
	       $status=$get_collection_amount->status;
	      foreach($get_collection_amount->list as $collection){
			 //echo '<pre>';print_r($collection);
			
			 if($status=='success'){
				?>
			 
          <tr>
			<td><a href="retailer-profile.php?retailerid=<?php echo $collection->retailerId;?>&source=edit"><?php echo $collection->retailerName;?></a></td>
			<td><a href="profile_sr.php?empid=<?php ?>"><?php echo $collection->srName;?></a></td>
			<td><?php echo $collection->paymentDate;?></td>
			<td><a href="profile_managers.php?empid=<?php echo $collection->visitorId;?>"><?php echo $collection->visitorName;?></a></td>
			<td><?php echo $collection->refrenceNo;?></td>
			<td><?php echo $collection->paymentAmount?></td>
			<td><?php echo $collection->paymentAmountType;?></td>
			<?php
			if($collection->isDelete=='N' && $collection->outstandingStatus=='D'){
				?>
			      <td>
				<a class="btn btn-success btn-sm" onclick="javascript:Getapprove(<?php echo $collection->retailerId;?>,<?php echo $collection->licenseId;?>,'<?php echo $collection->paymentAmountType;?>',<?php echo $collection->paymentAmount;?>,<?php echo $collection->paymentId;?>,<?php echo $collection->visitorId?>,'<?php echo $collection->paymentMode;?>','<?php echo $collection->refrenceNo;?>');" data-toggle="modal" data-target="#myModal1" style="font-size: 12px; padding: 6px; color: white;">Accept</a>
				<a>|</a>
				<a class="btn btn-danger btn-sm" onclick="javascript:Disapprove(<?php echo $collection->paymentId;?>);" data-toggle="modal" data-target="#myModal" style="font-size: 12px; padding: 6px; color: white;">Decline</a>
			</td>	
				<?php
				
			}else{
				?>
			<td><?php echo $collection->deleteNote;?></td>	
			<?php
			}
			?>
			
		</tr>			  
			  <?php	 
			 } 
              
	 }
		  
	   ?>    
    </tbody>
	

  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	
	<?php
	
	  if($get_collection_amount->status=='fail'){
		?>
		<p style="color:red;margin-left: 435px;">Data Not Found</p>
		<?php
	}
	?>
	<?php
	
}
/****************************************************************END getfinanance_report_disapprove*********************************************/
/****************************************************************getadvanceSearchattendance******************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getadvanceSearchattendance'){
	extract($_POST);
	    $form_attendence=array('id'=>$id,'startDate'=>$from_date,'endDate'=>$end_date,'operationtype'=>$operationtype);
       // echo '<pre>';print_r($form_attendence);			
		$attendence_string=json_encode($form_attendence);
		//echo $designation_string;
		$url="http://".$baseurl."/salesforceapi/getAttendence";
		$header=array('Accept: application/json',
			'Content-Type: application/json');
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($ch,CURLOPT_POSTFIELDS,$attendence_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
		curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
			'Content-Type: application/json')                                                                    
		);                               		
		$attendence=curl_exec($ch);
		curl_close($ch);
		//print_r($attendence);
		$getAttendence=json_decode($attendence); 
		//echo '<pre>';print_r($getAttendence);
		?>
		<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <?php 
		//print_r($getAttendence)
		?> <thead>
      <tr>
		<th >Date</th>
		<th>Visitor Name</th>
        <th>First Activity </th>
        <th>First Activity Time</th>
		<th>Last Activity </th>
        <th>Last Activity Time</th>
		<th>Hour</th>
		<th>Distance</th>
      </tr>
    </thead>
   <tbody>
		<?php  foreach($getAttendence->lstAttendence as $attendenceList){
			if($getAttendence->status=='success'){
				?>
	    <tr>
			<td style="width:160px";><?php echo $attendenceList->inDate;?></td>
			<td style="width:160px";><?php echo $attendenceList->visitorName;?></td>
			<td><a href=""><?php echo $attendenceList->inRetailerName;?></a></td>
			<td><?php echo $attendenceList->attendenceInTime;?></td>
			<td><?php echo $attendenceList->outRetailerName;?></td>
			<td><?php echo $attendenceList->attendenceOutTime;?></td>
			<td><?php echo $attendenceList->diffrence;?></td>		
			<td><?php //echo $attendenceList;?></td>			
		</tr>
		<?php
				
			}
			 }?>
	</tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	
	<?php
	
}
/*==============================================================Getproduct-ReportSearch=========================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='Getproduct-ReportSearch'){
	extract($_POST);
	$form_product=array('distributerId'=>$_SESSION['userData']['distributerId'],
	'brandId'=>$brand_name,
	'productCategoryId'=>$category,
	'packageTypeId'=>$packageType,
	'productType'=>$productType,
	'productSubType'=>$subTpe,
	'productLicense'=>$licence,
	'startDate'=>$fromDate,
	'endDate'=>$toDate);
	
	$url="http://".$baseurl."/salesforceapi/getProductReport";
	$product_string=json_encode($form_product);
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$product_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$product=curl_exec($ch);
	curl_close($ch);
	$getProduct=json_decode($product);
	//echo '<pre>';print_r($getProduct);
	?>
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Brand Name</th> 
		<th>Brand Code</th>	
        <th>Product Name</th> 
		<th>Brand Type</th>	  
        <th>Product Category</th> 
		<th>Subtype</th>
		<th>Qyt. (ML)</th>
		<th>Cases / Pieces</th>
		<th>Count Of Sale</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($getProduct->listProduct as $productlist){?>
	    <tr>
			<td><?php echo $productlist->brandName;?></td>
			<td><?php echo $productlist->brandCode;?></td>
			<td><?php echo $productlist->productName;?></td>
			<td><?php echo $productlist->productSegmentName;?></td>
			<td><?php echo $productlist->productcategoryName;?></td>
			<td><?php echo $productlist->productSubTypeName;?></td>
			<td><?php echo $productlist->qtyInmlName;?></td>
			<td><?php echo $productlist->productTypeName;?></td>
			<td><?php echo $productlist->sale;?></td>
			
		</tr>
	<?php }?>
		
		
    </tbody>
  </table>
  <script>
  $(document).ready(function() {
			$('#example').DataTable();
		});
  
  </script>
	<?php
	
}
/*==============================================================END Getproduct-ReportSearch=====================================================*/
/*******************************************************************END getadvanceSearchattendance***********************************************/
/*==============================================================GetadvancesearchOffeedback=======================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetadvancesearchOffeedback'){
	extract($_POST);
$url="http://".$baseurl."/salesforceapi/getFeedback";
$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
'retailerType'=>$type,
'retailerSubType'=>$subtype,
'retailerCategory'=>$cat,
'managerid'=>$manager,
'asmId'=>$asm,
'tsmid'=>$tsm,
'srid'=>$sr,
'feedbackType'=>$Feedbacktype,
'feedbackRating'=>$Feedbackrating,
'zoneId'=>$zoneId);
$designation_string=json_encode($form_designation);
//echo '<pre>';print_r($designation_string);
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
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
'Content-Type: application/json')                                                                    
);                               
$data=curl_exec($ch);
//echo $data;
curl_close($ch);
//print_r($data);
$rowdatafeedback=json_decode($data);
	
//echo '<pre>';print_r($rowdataRetailer);
?>
<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
					<thead>
						<tr>
							<th>Retailer Name</th>
							<th>Taken by</th>
							<th>Role</th>
							<th>SR Name</th>
							<th>Feedback Type</th>
							<th>Description</th>
							<th>Date & Time</th>
							<th>Rating</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
							<?php 	foreach($rowdatafeedback->feedbackList as $value){ 
							          //echo '<pre>';print_r($value);
										$visit_date= $value->visitDate;						
										$visitDate=date('d-m-y',strtotime($visit_date));
										
										if($value->srName=='null'){
											$srName="NA";
										}else{
											$srName=$value->srName;						
										}
										//$img='http://'.$baseurl."/".$value->image;
										$img='http://157.119.91.195:15000/'.$value->image;
										//echo $img; 
							?>
						<tr>
							<td><?php echo $value->retailerName;?></td>
							<td><?php echo $value->visitorName;?></td>
							<td><?php echo $value->roleName;?></td>
							<td><?php echo $srName;?></td>
							<td><?php echo $value->feedbackTypeName;?></td>
							<td><?php echo $value->description;?></td>
							<td style="width:100px;"><?php echo $visitDate;?></td>
							<td><?php echo $value->feedbackratingName;?></td>			
							<td> 
								<button type="button" class="btn btn-success small-btn" data-toggle="modal" data-target="#myModal_map" onclick="feedbackMap('<?php echo $value->retailerLattitude; echo $value->retailerLongitude; echo $value->lattitude; echo $value->lattitude;?>')"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-info small-btn" data-toggle="modal" data-target="#myModal_feedback_<?php echo $value->id;?>"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>
								
								<!--Feedback Model-->
	
	<div class="modal fade" id="myModal_feedback_<?php echo $value->id;?>" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 430px;"><span aria-hidden="true">×</span></button>
				
				<div class="modal-body">
					<img src="<?php echo $img;?>" id="feedback_image_popup" name="feedback_image_popup" style="width:100%; height:400px; ">
				</div>
			</div>
			<div class="modal-footer">
			</div>
			
		</div>
	</div>
	
							</td>
						</tr>
						<?php  } ?>		
					</tbody>
				</table>
				<script>
				$(document).ready(function() {
	
			$('#example').DataTable();
		});
				</script>
<?php
}
/*===============================================================END GET GetadvancesearchOffeedback==============================================*/
/*==============================================================GET advancesearchByteamActivity=================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='advancesearchByteamActivity'){

	extract($_POST);
	//print_r($_POST); die;
	if($managerId!='' && $asm=='' && $tsm==''){
	$team_activity=array('distributerId'=>$_SESSION['userData']['distributerId'],'roleId'=>'37',
	'startDate'=>$fromDate,
	'endDate'=>$toDate,
	'operationtype'=>'managerWise',
	'managerid'=>$managerId);		
	}
	if($managerId!='' && $asm!='' && $tsm==''){
		$team_activity=array('distributerId'=>$_SESSION['userData']['distributerId'],'roleId'=>'38',
	'startDate'=>$fromDate,
	'endDate'=>$toDate,
	'operationtype'=>'asmWise',
	'asmId'=>$asm);	
	}
	if($managerId!='' && $asm!='' && $tsm!=''){
		$team_activity=array('distributerId'=>$_SESSION['userData']['distributerId'],'roleId'=>'39',
	'startDate'=>$fromDate,
	'endDate'=>$toDate,
	'operationtype'=>'tsmWise',
	'tsmid'=>$tsm);	
	}
	//echo '<pre>';print_r($team_activity);
	$team_activity_string=json_encode($team_activity);		
	$url="http://".$baseurl."/salesforceapi/getTeamActivity";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$team_activity_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$team_activity=curl_exec($ch);
	curl_close($ch);
//print_r($data);
$rowdatateamActivity=json_decode($team_activity);
//	echo '<pre>';print_r($team_activity);
	?>
	 <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
		<thead>	
			<tr>
				<th>Name</th>
				<th>Designation</th>
				<th>Total Retailer</th>
				<th>Total Visit</th>
				<th>Action</th>
			</tr>	
		</thead>
		<tbody>
			<?php foreach($rowdatateamActivity->lstMemberResponse as $teamactivityData){
                   // echo '<pre>';print_r($teamactivityData);
			?>
				<tr id="date-row">
					<?php 	
						$sendUrl; 
						$rollid =$teamactivityData->roleId;
						if($rollid==1) {
							$sendUrl = "profile_managers.php";
						}else if($rollid==37){
							$sendUrl="profile_managers.php";
						}else if($rollid==38){
							$sendUrl="profile_asm.php";
						}else if($rollid==39){
							$sendUrl="profile_tsm.php";
						}else if($rollid==40){
							$sendUrl="profile_sr.php";
						}	
					?>
						<td><a href="<?php echo $sendUrl?>?empid=<?php echo $teamactivityData->employeeId;?>"><?php echo $teamactivityData->employeeName; ?></a></td>
						<td><?php echo $teamactivityData->designationname; ?></td>
						<td>
						<a href="retailers.php?retailerid=<?php echo $teamactivityData->employeeId; ?>" >
						<?php echo $teamactivityData->retailerCount; ?></a></td>
						<td><a href ="#" onclick="date('<?php  echo $teamactivityData->employeeId;?>')"><?php echo $teamactivityData->visitCount;?></a></td><span id="visit_view"></span>
						<td><a href="#" onclick="activitydetails('<?php  echo $teamactivityData->employeeId;?>')" class="add-btn">View History</a></td>
				</tr>
				
			<?php }?>
		
		</tbody>
	</table>
	<script>
     $(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
	<?php
}
/*==============================================================END advancesearchByteamActivity=================================================*/
/*================================================================GET GetTeamActivityHistoryAdvanceSearch========================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetTeamActivityHistoryAdvanceSearch'){
	
	if($activityType!=''){
		$team_activity=array('id'=>$manager,
		'fromDate'=>$firstDate,
		'toDate'=>$lastDate,
		'activityType'=>'all',
		'asmId'=>$asm,
        'tsmid'=>$tsm,
        'srid'=>$sr,);
	}	
	$team__activity_string=json_encode($team_activity);
	$url="http://".$baseurl."/salesforceapi/getTeamActivityHistoryBy";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$team__activity_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                       
	$activity=curl_exec($ch);
	curl_close($ch);
	$getActivityHistory=json_decode($activity);
	
	
	// retailer type
	
	
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
}
/*=================================================================END GetTeamActivityHistoryAdvanceSearch=======================================*/
/*=================================================================START getteamTargetAdvanceSearch================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getteamTargetAdvanceSearch'){
	extract($_POST);
	//echo '<pre>';print_r($_POST);
	if($month!=''){
	   $yeararray = explode("-", $month);
	  $years= $yeararray[0];
	  $month= date( 'M', mktime(0, 0, 0, $yeararray[1]));
		
	}else{
	    $dateDetails=explode('-',$months);
		//print_r($dateDetails);
		$month=$dateDetails[0];
		$years=$dateDetails[1];
	}
	$empid=$_SESSION['userData']['employeeId'];
	$roleid=$_SESSION['userData']['roleId'];
	//echo 'years-'.$years.'----'.$month;
	$form_member=array('roleId'=>$roleid,
	'distributerId'=>$_SESSION['userData']['distributerId'],
	'month'=>$month,
	'year'=>$years,
	'id'=>$empid,
	'retailerType'=>$type,
    'retailerSubType'=>$subtype,
    'retailerCategory'=>$cat,
    'managerid'=>$manager,
    'asmId'=>$asm,
    'tsmid'=>$tsm,
    'srid'=>$sr);
	echo '<pre>';print_r($form_member);
	$url="http://".$baseurl."/salesforceapi/getTarget";
	$member_string=json_encode($form_member);
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$member_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$target=curl_exec($ch);
	curl_close($ch);
	$getTarget=json_decode($target);
	echo '<pre>';print_r($getTarget);
}
/*=================================================================END getteamTargetAdvanceSearch==================================================*/
/*===================================================================setpermission====================================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='setpermission'){
	extract($_POST);
	//print_r($_POST);
	
	$form_product=array('id'=>$id,
	'add'=>$add,
	'edit'=>$edit,
	'download'=>$download,
	'upload'=>$upload,
	'view'=>$view,
	'employeeId'=>$MemberId,
	'moduleVisible'=>$moduleVisible);
	//productSubtypeid
	//echo '<pre>';print_r($form_product);
	$product_string=json_encode($form_product);
	
	$url="http://".$baseurl."/salesforceapi/updatePermissionSet";
	$header=array(
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$product_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $product=curl_exec($ch);
	 
	curl_close($ch);
	//echo $designation;
	print_r($product);
	
}
/*===================================================================END setpermission================================================================*/

/*======================================================================GET CHECK IN OUT ACTIVITY LIST ================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='GetcheckinOutActivity'){
	
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
	//print_r($get_checkinoutactivity->lstCommnodetail);
	?>
	<ul>
	<?php
	foreach($get_checkinoutactivity->lstCommnodetail as $activityList){
	?>
	<li><?php echo $activityList->name?></li>
	<?php
		
	}
	 
	?>
	</ul>
	<?php
	
	
}
/*======================================================================END GetcheckinOutActivity===========================================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getteamvisitcall'){
	extract($_POST);
    $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
	'managerid'=>$manager,
	'asmId'=>$asm,
	'tsmid'=>$tsm,
	'srid'=>$sr,
	'startDate'=>$from_date,
	'endDate'=>$to_date);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	
	$url="http://".$baseurl."/salesforceapi/getcheckInOutActivity";
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
	//echo '<pre>';print_r($get_checkinout);
	$get_checkinoutactivity=json_decode($get_checkinout);
	//echo '<pre>';print_r($get_checkinoutactivity);
	?>
	 <table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th style="width: 130px;">Visitor Name</th>
		<th>Retailer Name</th>
		
		<th>Check In Time</th>
		<th>Check Out Time</th>
		<th>Role Name</th>
		<th>Activity</th>
		
        <!--<th>Date</th>-->
      </tr>
    </thead>
    <tbody>
	<?php
	 // echo '<pre>';print_r($get_checkinoutactivity->lstCommnodetail);
	 foreach($get_checkinoutactivity->list as $checkinoutactivity){
		//echo '<pre>';print_r($checkinoutactivity); 
		 ?>
		 <tr>
			<td><?php echo $checkinoutactivity->visitorName;?></td>
			<td><?php echo $checkinoutactivity->retailerName;?> </td>
			<td><?php echo $checkinoutactivity->checkInDateTime;?></td>
			<td><?php echo $checkinoutactivity->chekcOutDateTime;?></td>
			<td><?php echo $checkinoutactivity->roleName;?></td>
			<!--<td><a href="checkinoutActivitylist.php?activityId=<?php echo $checkinoutactivity->activities;?>">Activity</a></td>-->
			<td><button class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="font-size: 10px;" onclick="javascript:GetactivityList('<?php echo $checkinoutactivity->activities;?>','<?php echo $checkinoutactivity->retailerName;?>','<?php echo $checkinoutactivity->roleName;?>','<?php echo $checkinoutactivity->visitorName;?>','<?php echo $checkinoutactivity->checkInDateTime;?>','<?php echo $checkinoutactivity->chekcOutDateTime;?>')">Activity</button></td>	
		</tr>	
		 <?php
	 }
	?>	
    </tbody>
	

  </table>
	
	<script>
	   $(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
    <?php

}
/*======================================================================advance search of GetcheckinOutActivity=============================================================*/ 
/*======================================================================getfinanance_recencellationreport====================================================================*/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getfinanance_recencellationreport'){
	 extract($_POST);
	 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
	 'retailerType'=>$type,
	 'retailerSubType'=>$subtype,
	 'retailerCategory'=>$cat,
	 'startDate'=>$from_date,
	 'endDate'=>$to_date,
	 'licenseId'=>$licence);
	 $designation_string=json_encode($form_designation);
	//echo $designation_string;
	
	$url="http://".$baseurl."/salesforceapi/getPaymentReconcelation";
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
	//echo '<pre>';print_r($get_collection->list);
	
	//echo 'target-'.$remaning_amount['list'];
	curl_close($ch);
	//print_r($manager);
	$get_collection_amount=json_decode($get_collection);
	?>
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th style="width: 130px;">Date</th>
		<th>Po Number</th>
		<th>TP Number</th>
		<th>Excise Amount(WSP)</th>
		<th>Received Excise Amount (Excise Duty)</th>
		<th>License Name</th>
		<th>Retailer Name </th>
        <th>Tax Amount </th>
       <!--<th>Received Tax Amount</th>-->
        <!--<th>Date</th>-->
      </tr>
    </thead>
    <tbody>
	<?php
	  //echo '<pre>';print_r($get_collection_amount->list);
	 foreach($get_collection_amount->list as $recncellation){
		//echo '<pre>';print_r($recncellation); 
		 ?>
		<tr>
			<td><?php echo $recncellation->paymentDate;?></td>
			<td><?php echo $recncellation->poNo;?> </td>
			<td><?php echo $recncellation->tpNo;?></td>
			<td><?php echo $recncellation->exciseDuty;?></td>
			<td><?php echo $recncellation->wsp;?></td>
			<td><?php echo $recncellation->licenseNo;?></td>
			<td><?php echo $recncellation->retailerShopName;?></td>
			<td><?php echo $recncellation->paymentAmount;?></td>
			<!--<td>1000</td>-->
		</tr>	
		 <?php
	 }
	?>
          		  
			
    </tbody>
	

  </table>
  <script>
    $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	<?php
}
/*=======================================================================END getfinanance_recencellationreport================================================================*/
/****************************************************************START getallRouteadevanceSearch******************************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='getallRouteadevanceSearch'){
	
	extract($_POST);
	$srid=explode('-',$sr);
	//print_r($srid[1]);
	
	 $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],
	 'managerid'=>$manager,
	 'asmId'=>$asm,
	 'tsmid'=>$tsm,
	 'srid'=>$srid[1]);
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
	$route=curl_exec($ch);
	//echo '<pre>';print_r($get_collection->list);
	
	//echo 'target-'.$remaning_amount['list'];
	curl_close($ch);
	//print_r($manager);
	$get_allRoute=json_decode($route);
	//echo '<pre>';print_r($get_allRoute);
	?>
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
	?>
		<?php 	foreach($get_allRoute->routelist as $value){ ?>
		<tr>
			
			
			<td><?php echo $value->routeName;?></td>
			<td><?php echo $value->countRetailer; ?></td>

			<td><?php echo $value->managerName;?></td>
			
			<td><?php echo $value->contactNumber;?></td>
			<td> 
			
			<button type="button" class="btn btn-success small-btn"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
			<a href="update-route.php?route_id=<?php echo $value->routeId;?>"><button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php  } ?>
    </tbody>
  </table>
  <script>
      $(document).ready(function() {
			$('#example').DataTable();
		});
  </script>
	<?php
	
	
}
/************************************************************************END getallRouteadevanceSearch*************************************************************************/
/***************************************************************START team_target_advanceSearch********************************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='team_target_advanceSearch'){
	
	extract($_POST);
	$first_day_this_month =  date('Y-m-01');	
	$last_day_this_month  = date('Y-m-t');
	if($manager!='' && $asm=='' && $tsm==''){
		$id=$manager;
		
	}
	$form_member=array(
	'distributerId'=>$_SESSION['userData']['distributerId'],
	'month'=>$month,
	'year'=>$year,
	"operationtype"=>"targetPerfomence",
	"startDate"=>$first_day_this_month, // this is for sales 
    "endDate"=>$last_day_this_month,
	'id'=>$manager,
	
	'asmId'=>$asm,
	'tsmid'=>$tsm,
	'srid'=>$sr,
	'brandId'=>$brand,
	'licenseId'=>$licence);
	$url="http://".$baseurl."/salesforceapi/getTarget";
	
	
	echo $member_string=json_encode($form_member);
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$member_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	$target=curl_exec($ch);
	curl_close($ch);
	$getTarget=json_decode($target);
	echo '<pre>';print_r($getTarget);
	
	?>
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
				<thead>
					<tr>
						<th style="width: 130px;">Member Name</th>
						<th>Role</th>
						<th>Brand Name</th>
						<th>License Name</th>
						<th>Target <i class="fa fa-sort" aria-hidden="true"></i></th>
						<th>Achieved Target </th>
						<th>Status </th>  		
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				
							$roleId=$_SESSION['userData']['roleId'];				
					foreach($getTarget->targetList as $targelList){
						//echo '<pre>';print_r($targelList);
							//echo $targelList->roleId;
							if($roleId=='1'){
								$roleName="Manager";
							}elseif($roleId=='37'){								
								$roleName="ASM";							
							}elseif($roleId=='38'){								
								$roleName="TSM";							
							}elseif($roleId=='39'){								
								$roleName="SR";							
							}
							elseif($roleId=='40'){								
								$roleName="SR";							
							}
							
							
					
					?>
					<tr>
						<td><a href=""><?php echo $targelList->assignName;?></td></a>
						<td><?php echo $roleName;?></td>
						<td><?php echo $targelList->brandName;?></td>
						<td><?php echo $targelList->licenceName;?></td>					
						<td><?php echo $targelList->qty;?></td>
						<td><?php echo $targelList->totalSale;?></td>
						<td><i class="fa fa-arrow-up color-g" aria-hidden="true"></i> <i class="fa fa-arrow-down color-r" aria-hidden="true"></i></td>
						<td><a href="order_listing.php"><button>View Details</button></a></td>			
					</tr>
				<?php }?>	
				</tbody>
			</table>
			<script>
			 $(document).ready(function() {
	
			$('#example').DataTable();
		});
			</script>
	<?php
	
	
}
/******************************************************************END team_target_advanceSearch********************************************************************************/
/***************************************************************START advancesearchBygetTeamPerformance**************************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='advancesearchBygetTeamPerformance'){
	extract($_POST);
	$montWise=explode('-',$todate);
	//print_r($montWise);
	$form_member=array(
	'distributerId'=>$_SESSION['userData']['distributerId'],
	'startDate'=>$fromDat,
	'endDate'=>$todate,
	'managerid'=>$managerId,
	'asmId'=>$asm,
	'tsmid'=>$tsm,
	'srid'=>$sr,
	'operationtype'=>'AdvanceSearch',
	'licenseId'=>$license);

	$url="http://".$baseurl."/salesforceapi/getTeamPerformance";
	$sales_string=json_encode($form_member);	
		$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$sales_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                              		
	$sales=curl_exec($ch);
	curl_close($ch);
	$getSales=json_decode($sales);
	//echo '<pre>';print_r($getSales);
	?>
	<table class="table table-striped" id="example" style="border:1px solid #ddd; font-size:12px;">
				<thead>
					<tr>
						<th>Name</th>
						<th>Designation</th>
						<th>Role</th>		
						<th>Collection Target</th>
						<th>Total Collection</th>	
					</tr>
				</thead>
				<tbody>
				<?php foreach($getSales->list as $salesList){	
                      // echo'<pre>';print_r($salesList);				
						if($salesList->roleId=='37'){
							$roleName='Manager';
						}elseif($salesList->roleId=='38'){
							$roleName='ASM';
						}elseif($salesList->roleId=='39'){
							$roleName='TSM';
						}elseif($salesList->roleId=='40'){
							$roleName='SR';
						}
					 
					?>
					<tr>
						<td><a href="retailer-profile.php"><?php echo $salesList->empName;?></a></td>
						<td><?php echo $salesList->designation;?></td>
						<td><?php echo $roleName;?></td>			
						<td><?php echo $salesList->collectionTarget;?></td>
						<td><i class="fa fa-arrow-up color-g" aria-hidden="true"></i><?php echo $salesList->totalCollection;?></td>			
					</tr>			
				<?php } ?>
				</tbody>
			</table>
			<script>
			 $(document).ready(function() {
	
			$('#example').DataTable();
		});
			</script>
	
	<?php
	
	
}
/***********************************************************************END advancesearchBygetTeamPerformance********************************************************************/

/*********************************************************************START TeamActivityHistoryAdvanceSearch********************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='TeamActivityHistoryAdvanceSearch'){
	extract($_POST);
	if($activity=='feedback'){
							$actType="1";
						}elseif($activity=='Order'){
							$actType="2";
						}elseif($activity=='Stock'){
							$actType="3";
						}elseif($activity=='payment'){
							$actType="6";
						}
		if($activity=='all'){
			$form_designation=array(
	'retailerType'=>$type,
	'retailerSubType'=>$subtype,
	'retailerCategory'=>$cat,
	'id'=>$manager,
	'asmId'=>$asm,
	'tsmid'=>$tsm,
	'srid'=>$sr,
	'fromDate'=>$fromDate,
	'operationtype'=>'all',
	'toDate'=>$toDate);	
	}else{
	$form_designation=array('retailerType'=>$type,
	'retailerSubType'=>$subtype,
	'retailerCategory'=>$cat,
	'id'=>$manager,
	'asmId'=>$asm,
	'tsmid'=>$tsm,
	'srid'=>$sr,
	'fromDate'=>$fromDate,
	'activityType'=>$actType,
	'toDate'=>$toDate);
	}
	
	$team__activity_string=json_encode($form_designation);
	$url="http://".$baseurl."/salesforceapi/getTeamActivityHistoryBy";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$team__activity_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                       
	$activity=curl_exec($ch);
	curl_close($ch);
	$getActivityHistory=json_decode($activity);
	//echo '<pre>';print_r($getActivityHistory);
	?>
	<table class="table table-striped" style="border:1px solid #ddd; font-size:12px;" id="example">
    <thead>
      <tr>
        <th>Visited Date </th>
        <th>Work Done</th>
		<th width="200">Description</th>
		<th>Visited By</th>
        <th>Retailer Name</th>
		<th width="200">Address</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	
		<?php 
		//print_r($getActivityHistory);
		foreach($getActivityHistory->lstVisit as $activitydData){
		//$visit_date= $activitydData->visitDate;						
			//$visitDate=date('d-m-y',strtotime($visit_date));
			
				
			
					$activityType=$activitydData->activityType;
						if($activityType=='feedback'){
							$activityURL="feedback_report.php";
						}elseif($activityType=='Promise Order'){
							$activityURL="promise_order.php";
						}elseif($activityType=='Stock'){
							$activityURL="stock_screen.php";
						}elseif($activityType=='Payment Collection'){
							$activityURL="collection.php";
						}
		?>
		
			<?php	if($activitydData->description=='null'){
						$description="NA";
						}else{
							$description=$activitydData->description;
						
						}
			?>
		
	    <tr> 
			<td><?php echo $activitydData->visitDate;?> <a href=""> <!--<button type="button" class="btn btn-success small-btn"><i class="fa fa-map-marker" aria-hidden="true"></i></button></a></td>-->
			<td><a href="<?php echo $activityURL?>?activityId=<?php echo $activitydData->activityId;?>"><?php echo $activitydData->activityType;?></td>
			<td><?php echo $description;?> </td>
			<td><?php echo $activitydData->visitorName;?></td>
			<td><?php echo $activitydData->retailerName;?></td>
			<td width="200"><?php echo $activitydData->address;?></td>
			<td><!--<a href=""><button type="button" class="btn btn-success small-btn"><i class="fa fa-map-marker" aria-hidden="true"></i></button></a>-->
			<a href="<?php echo $activityURL?>?activityId=<?php echo $activitydData->activityId;?>"><button type="button" class="btn btn-primary small-btn"><i  class="fa fa-info-circle" aria-hidden="true"></i></button></a>
			<!--<a href=""><button type="button" class="btn btn-info small-btn"><i  class="fa fa-file-image-o" aria-hidden="true"></i></button></a>  -->
			
			</td>
		</tr>
		<?php }?>
		
    </tbody>
  </table>
  <script>
			 $(document).ready(function() {
	
			$('#example').DataTable();
		});
			</script>
  
	<?php
	
}
/**********************************************************************END TeamActivityHistoryAdvanceSearch*********************************************************************/

/******************************************************************START TeamActivityHistoryByAdvanceSearch**********************************************************************/
if(isset($_REQUEST['page']) && $_REQUEST['page']=='TeamActivityHistoryByAdvanceSearch'){
	extract($_POST);
	if($activity=='feedback'){
							$actType="1";
						}elseif($activity=='Order'){
							$actType="2";
						}elseif($activity=='Stock'){
							$actType="3";
						}elseif($activity=='payment'){
							$actType="6";
						}
	if($activity=='all'){
     $team_activity=array('retailerId'=>$retailerID,
	'fromDate'=>$fromDate,
	'toDate'=>$toDate,
	'activityType'=>$activity,
	'retailerType'=>$type,
	'retailerSubType'=>$subtype,
	'retailerCategory'=>$cat,
	'managerid'=>$manager,
	'asmId'=>$asm,
	'tsmid'=>$tsm,
	'srid'=>$sr,
	'operationtype'=>'all');
		
	}else{
	$team_activity=array('retailerId'=>$retailerID,
	'fromDate'=>$fromDate,
	'toDate'=>$toDate,
	'retailerType'=>$type,
	'retailerSubType'=>$subtype,
	'retailerCategory'=>$cat,
	'managerid'=>$manager,
	'asmId'=>$asm,
	'tsmid'=>$tsm,
	'srid'=>$sr,
	'activityType'=>$actType);
	}
  echo $team__activity_string=json_encode($team_activity);
	$url="http://".$baseurl."/salesforceapi/getTeamActivityHistoryBy";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$team__activity_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                       
	$activity=curl_exec($ch);
	curl_close($ch);
	$getActivityHistory=json_decode($activity);
	
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
	//echo '<pre>';print_r($rowdata);
	?>
	<table class="table table-striped"  id="example" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Visited Date </th>
        <th>Work Done</th>
		<th width="200">Description</th>
		<th>Visited By</th>
        <th>Retailer Name</th>
		<th width="200">Address</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	
		<?php 
		//echo '<pre>'; print_r($getActivityHistory);
		foreach($getActivityHistory->lstVisit as $activitydData){
			//$visit_date= $activitydData->visitDate;						
			//$visitDate=date('d-m-y',strtotime($visit_date));
			
				
			
					$activityType=$activitydData->activityType;
						if($activityType=='feedback'){
							$activityURL="feedback_report.php";
						}elseif($activityType=='Promise Order'){
							$activityURL="promise_order.php";
						}elseif($activityType=='Stock'){
							$activityURL="stock_screen.php";
						}elseif($activityType=='Payment Collection'){
							$activityURL="collection.php";
						}
		?>
		
			<?php	if($activitydData->description=='null'){
						$description="NA";
						}else{
							$description=$activitydData->description;
						
						}
			?>
		
	    <tr> 
			<td><?php echo $activitydData->visitDate;?> <a href=""> <!--<button type="button" class="btn btn-success small-btn"><i class="fa fa-map-marker" aria-hidden="true"></i></button></a></td>-->
			<td><a href="<?php echo $activityURL;?>?activityId=<?php echo $activitydData->activityId;?>"><?php echo $activitydData->activityType;?></td>
			<td><?php echo $description;?> </td>
			<td><?php echo $activitydData->visitorName;?></td>
			<td><?php echo $activitydData->retailerName;?></td>
			<td width="200"><?php echo $activitydData->address;?></td>
			<td><!--<a href=""><button type="button" class="btn btn-success small-btn"><i class="fa fa-map-marker" aria-hidden="true"></i></button></a>-->
			<a href="<?php echo $activityURL?>?activityId=<?php echo $activitydData->activityId;?>"><button type="button" class="btn btn-primary small-btn"><i  class="fa fa-info-circle" aria-hidden="true"></i></button></a>
			<!--<button type="button" class="btn btn-info small-btn" data-toggle="modal" data-target="#myModal_feedback" onclick="feedbackPopup('<?php //echo $value->image;?>')"><i class="fa fa-file-image-o" aria-hidden="true"></i></button> -->
			
			</td>
		</tr>
		<?php }?>
		
    </tbody>
  </table>
  <script>
		$(document).ready(function() {
		$('#example').DataTable();
		});
  </script>
	<?php
	
}
/*********************************************************************END TeamActivityHistoryByAdvanceSearch END******************************************************************/
?>