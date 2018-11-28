<?php 
if(isset($_POST['submit'])){
	$name=$_POST['name'];
	//echo $name;
	$description=$_POST['description'];
	
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
 curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                    
);                                  

$output=curl_exec($ch);
curl_close($ch);
echo $output;
}
?>
<html>
<form method="POST" action="">
	<label>name:</label>
	<input type="text" name="name">
	<label>description</label>
	<input type="text" name="description">
	<input type="submit" name="submit" value="submit">
</form>
</html>