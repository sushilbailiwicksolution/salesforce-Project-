<?php
error_reporting(0);
session_start();
include('config.php'); 
   //echo '<pre>';print_r($_REQUEST);
        extract($_REQUEST);
	    //$first_day_this_month=$_GET['first_day'];	
	    //$last_day_this_month=$_GET['last_day'];
       // $memberId=$_GET['managerId'];
		$form_attendence=array('id'=>$tsm,'startDate'=>$from_date,'endDate'=>$end_date,'operationtype'=>$type_wise);	
	     //echo '<pre>';print_r($form_attendence);	
		$attendence_string=json_encode($form_attendence);
		//echo $designation_string;
		$url="http://".$baseurl."/salesforceapi/getAttendenceForDownload";
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
	  //echo '<pre>';print_r($result['list']);
        $csvdata=array();
	    $i=0;
	    
       $filename = "team_attendence_data-" . date('d-m-Y') . ".xls";
 header("Content-Disposition: attachment; filename=\"$filename\"");
 header("Content-Type: application/vnd.ms-excel");
$date_array=''; 
$date_array=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
$d=sizeof($date_array);
?>
<?php 
if($type_wise=='adminWise'){
	?>
	<p style="text-align: center;color: #fff;background-color: black;font-size: 20px;">Attendance List Admin Wise -from Date:-<?php echo $from_date?>-To Date-<?php echo $end_date;?></p>
	<?php
	
}
elseif($type_wise=='managerWise'){
	?>
	<p style="text-align: center;color: #fff;background-color: black;font-size: 20px;">Attendance List Manager Wise -from Date:-<?php echo $from_date?>-To Date-<?php echo $end_date;?></p>
	<?php
}
elseif($type_wise=='asmWise'){
	?>
	<p style="text-align: center;color: #fff;background-color: black;font-size: 20px;">Attendance List Asm Wise -from Date:-<?php echo $from_date?>-To Date-<?php echo $end_date;?></p>
	<?php
}else{
	?>
	<p style="text-align: center;color: #fff;background-color: black;font-size: 20px;">Attendance List Tsm Wise -from Date:-<?php echo $from_date?>-To Date-<?php echo $end_date;?></p>
	<?php
}
?>

<table border="1" style="font-size: 30px;color: #fff;
    font-size: 30px;
    background: black;border: 2px solid #7f2121;">
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
 foreach($result['list'] as $attendance_list){
	 
	?>
	<tr>
	<td><?php echo $attendance_list['visitorName'];?></td>
	<?php
	//echo '<pre>';print_r($attendance_list['totalDistance']);
	      
			//echo '<pre>';print_r($val);
           // echo '<pre>';print_r($real_date);
	$allId = array();
	$j=0;
	foreach($attendance_list['dates'] as $date_list){
		//echo 'j=>'.$j;
		//echo '<pre>';print_r($date_list['date']);
		
		?>
		
			<?php 
		$allId[] = date("d",strtotime($date_list['date']));
		//echo '<pre>';print_r(date("d",strtotime($date_list)));
		//echo '<pre>';print_r($allId);
			
			//echo (in_array($a,$val))?'<span style="color:green;">P</span>':'<span style="color:red;">A</span>';
			?>
			
		<?php
      $j++;		
	}
	
	
	 $a=1;
		while($a<32){?>
			<td>
			<?php 
			if($_REQUEST['attendance_type']=='attendance_wise'){
			   echo (in_array($a,$allId))?'<span style="color:green;">P</span>':'<span style="color:red;">A</span>';	
			}else{
			?>
			<span><?php if($date_list['totalDistance']!=''){echo $date_list['totalDistance'];}else{ echo 'NA';}?></span>
            <?php			
			}
			
			
			?>
			</td>
<?php
			$a++;
		}	
}
 
?>

</tr>
</table>