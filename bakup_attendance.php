<?php
error_reporting(0);
session_start();
include('config.php'); 
   //echo '<pre>';print_r($_REQUEST);
	    extract($_REQUEST);
	    //$first_day_this_month=$_GET['first_day'];	
	    //$last_day_this_month=$_GET['last_day'];
       // $memberId=$_GET['managerId'];
		$form_attendence=array('id'=>$tsm,'startDate'=>$from_date,'endDate'=>$end_date,'operationtype'=>'TsmWIse');	
	     //echo '<pre>';print_r($form_attendence);	
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
		$output=curl_exec($ch);
	    curl_close($ch);
	    $result = json_decode($output, True); 
		//$A=$result['lstAttendence'];
		 $c=count($result['lstAttendence']);
		
		for($m=1;$m<$c;$m++){
		//echo	$m;
		$p[]=$result['lstAttendence'][$m]['visitorName'];
		}
		
		//echo "<pre>";print_r($z);
		
        $csvdata=array();
	    $i=0;
   $filename = "team_attendence_data-" . date('d-m-Y') . ".xls";
 //header("Content-Disposition: attachment; filename=\"$filename\"");
 //header("Content-Type: application/vnd.ms-excel");
$date_array=''; 
$date_array=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
$d=sizeof($date_array);
//echo '<pre>';print_r($A);
?>
<table border="1">
<tr>
<td>Name</td>
<?php $a=1;
		while($a<32){?>
			
			<td><?php echo $a;?></td>
<?php
			$a++;
		}?>
</tr>
<?php
?>
<?php
$l=sizeof(array_unique($p));
$csvdata=array();
$array_unique=(array_unique($p));
$str=implode(',',$array_unique);
$final_list=explode(',',$str);
$g=sizeof($final_list);
//echo '<pre>';print_r($final_list);
	

	foreach($result['lstAttendence'] as $attendance_list){

		$val[]=$attendance_list['inDate'];
		

		

		}
						 $gf=sizeof($val);
						

	
	for($k=0;$k<$g;$k++){
		
		
	
	?>
      <tr>
<td><?php echo $final_list[$k];?></td>
<td>
<?php	for($s=0;$s<$gf;$s++){

	echo $val[$s];
	}
?>
</td>
</tr>	
	<?php
	
}




?>

</table>