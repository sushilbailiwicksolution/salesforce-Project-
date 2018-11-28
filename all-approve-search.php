 <?php
 session_start();
    include('config.php');
	extract($_REQUEST);
	//echo '<pre>';print_r($_REQUEST);
	 $first_day_this_month =  date('Y-m-01');	
	  $last_day_this_month  = date('Y-m-t');
     $form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'startDate'=>$first_day_this_month,'endDate'=>$last_day_this_month,'paymentStatus'=>'y');
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

	//curl_setopt($ch, CURLOPT_HEADER, true);

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          

		'Content-Type: application/json')                                                                    

	);                               		
	$output=curl_exec($ch);
	curl_close($ch);
	$result = json_decode($output, True);
	//echo "<pre>";
    //print_r($result['list']);die;
	$csvData=array();
	$csvdata=array();
	$i=0;
	  if($result['status']=='fail'){
		?>
		<p style="margin-left: 556px;;color:red;font-size:30px;">NO DATA FOUND</p>
		<?php
		
	}else{
	   foreach($result['list'] as $value){
        
		$csvdata[$i]['retailerName']=$value['retailerName'];
		$csvdata[$i]['visitorName']=$value['visitorName'];
		$csvdata[$i]['paymentAmount']=$value['paymentAmount'];
		$csvdata[$i]['licenceName']=$value['licenceName'];
		$csvdata[$i]['lattitude']=$value['lattitude'];
		$csvdata[$i]['longitude']=$value['longitude'];
		$csvdata[$i]['retailerLattitude']=$value['retailerLattitude'];
		$csvdata[$i]['retailerLongitude']=$value['retailerLongitude'];
		$csvdata[$i]['paymentDate']=$value['paymentDate'];
		$csvdata[$i]['city']=$value['city'];
		$csvdata[$i]['srName']=$value['srName'];
		$csvdata[$i]['retailerType']=$value['retailerType'];
		$csvdata[$i]['retailerSubType']=$value['retailerSubType'];
		$csvdata[$i]['retailerCatagory']=$value['retailerCatagory'];
		$csvdata[$i]['groupName']=$value['groupName'];
		$csvdata[$i]['amount']=$value['amount'];
		$i++;
	}
	//print_r($csvdata);
	 $filename    = 'Approve-All-Finance-report'.date('d_m_y_H_i_s_').time().'.csv';
     if(!empty($csvdata))

        {      
            header('Content-Type: text/excel');
            header('Content-Disposition: attachment; filename='.$filename);            
            $fp = fopen('php://output', 'w');

            fputcsv($fp, array('Retailer Name','Visitor Name','Payment Amount','Licence Name','Lattitude','Longitude','Retailer Lattitude','retailerLongitude','paymentDate','city','srName','retailerType','retailerSubType','retailerCatagory','groupName','amount'));

            foreach ($csvdata as $value) {             

                fputcsv($fp,$value);

            }        
            fclose($fp);

        }
	
	}             

	
?>