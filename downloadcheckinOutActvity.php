 <?php
session_start();
 include('config.php');
 

	extract($_REQUEST);

	//print_r($_POST); die;

	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId'],'name'=>$activityId);

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

	    	

	$output=curl_exec($ch);

	curl_close($ch);

	$result = json_decode($output, True);

	//echo '<pre>';print_r($result);
	

	$csvdata=array();

	$i=0;

	foreach($result['lstCommnodetail'] as $value){

		$csvdata[$i]['retailerName']=$retailerName;
        $csvdata[$i]['visitorName']=$visitorName;
		$csvdata[$i]['rolename']=$rolename;
        $csvdata[$i]['name']=$value['name'];
		$csvdata[$i]['ChekinDate']=$ChekinDate;
		$csvdata[$i]['Checkoutdate']=$Checkoutdate;
		$i++;

	}

	//print_r($csvdata);

	 $filename    = 'allcheckinoutActivity_'.date('d_m_y_H_i_s_').time().'.csv';

     if(!empty($csvdata))

        {      

            header('Content-Type: text/excel');

            header('Content-Disposition: attachment; filename='.$filename);            

            $fp = fopen('php://output', 'w');

            fputcsv($fp, array('Retailer Name','Visitor Name','Role name','Name','Check in Date','Check out date'));

            foreach ($csvdata as $value) {             

                fputcsv($fp,$value);

            }        

            fclose($fp);

        }

?>