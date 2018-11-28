<?php
	 include ('header.php');
	 error_reporting(E_ERROR | E_PARSE);
	?>
  
  <style>
  #exampleAccordion {
	  display:none;
  }
  body.sidenav-toggled #mainNav.fixed-top .sidenav-toggler {
    overflow-x: hidden;
    width: 55px;
    display: none;
}
  </style>
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <?php

//  $url="http://".$baseurl."/salesforceapi/getAllState";
// $header= array( 
// 'Content-Type: application/json',
// );

// $ch=curl_init();
// curl_setopt($ch,CURLOPT_URL,$url);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
// //curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
// curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
// //curl_setopt($ch, CURLOPT_HEADER, true);
// curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
// 'Content-Type: application/json')                                                                    
// );                               
// $state=curl_exec($ch);
// //echo $data;
// curl_close($ch);
// //print_r($data);
// $getState=json_decode($state);
// //echo'<pre>';print_r($getState->lstCommnodetail);
/**************************************GET LICENCE*****************************************/

   //$_SESSION['userData']['distributerId'];
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
   $getlicense=curl_exec($ch1);
//print_r($getlicense);
//echo $data;
curl_close($ch1);

$licence=json_decode($getlicense);

//echo '<pre>';print_r($licence);

//echo 'size'.sizeof($licence);
//echo 'ssssssss-'.$_SESSION['userData']['distributerId'];
/**********************************END LICENCE*********************************************/

  ?>
  
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Distributors</a>
        </li>
        <li class="breadcrumb-item active">Add Distributors</li>
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
	   

		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				<button>Download CSV</button>
				
			   </div>
		   </div>
	   
		<div class="row abc">	   
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Distributor's Name</label>
				<input type="email" id="Distributor_name" class="form-control">
			</div>
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Mobile No.</label>
				<input type="email" id="Distributor_mobile" class="form-control">
			</div>
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Email</label>
				<input type="email" id="Distributor_email" class="form-control">
			</div>
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Address</label>
				<input type="email" id="Distributor_Address" class="form-control">
			</div>

			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">State</label>
				<input type="email" id="state" class="form-control">
			</div>
			<!-- <div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">State</label>
				<select class="form-control" id="state">
					<?php
                          foreach($getState->lstCommnodetail as $state){
                          	?>
                          		<option value="<?php echo $state->id;?>"><?php echo $state->name;?></option>
                          	<?php

                          }
					?>	
					</select>
			</div> -->
			<div class="col-md-2 ">
					<button style="margin-top:30px;" type="submit" class="add-btn new-btn" id="add_distributors">Save</button>
				</div>	
				</div>
				<h3 style="color:green;display: none;text-align: center;" id="dis_success">Distributor added successfully  you can add licence</h3>
          <input type="hidden" id="Distributor_id">
		  <p >Your Distributer Id:<span id="show_dis"></span></p>

				
			<div class="row abc">	
			<div class="col-md-12" style="overflow:hidden; padding:0px; ">
				<div class="col-md-4 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Add Licence</label>
				<input type="email" id="licence_name" class="form-control">
			</div>	
			<div class="col-md-3 pull-left">
					<button style="margin-top:30px;" type="submit" id="add_licence" class="add-btn new-btn">Add Licence </button>
				</div>
					
					
			</div>
			
			
		</div>
		
		
		<div class="row">	   
  <table class="table table-striped" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
		
        <th>Licence </th>
        
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
    	<?php
		
		foreach($licence->list as $lic){
    	     // echo '<pre>';print_r($lic);
    	      ?>
    	         <tr>
			
			<td><?php echo $lic->licenseName;?></td>
			
			<td> 
			<button type="button" class="btn btn-danger small-btn pull-right"><i class="fa fa-times " aria-hidden="true"></i></button>
			<button style="margin-right: 10px;" type="button" class="btn btn-primary small-btn pull-right" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil " aria-hidden="true"></i></button>
			
			</td>
		</tr>
    	      <?php

            }
		   
    	?>
		
		
    </tbody>
  </table>
  
  
</div>
	</div>
	</div>
	<script>
		/************************************************ADD LICENCE*********************************************/
		$('#add_licence').on('click',function(){
               //alert('');
               var Distributor_id=$('#Distributor_id').val();
               var licence_name=$('#licence_name').val();

               if(Distributor_id!="" && licence_name!=""){
               	$.ajax({
               		type:'POST',
               		url:'ajax.php',
               		dataType:'JSON',
               		data:{'Distributor_id':Distributor_id,'licence_name':licence_name,'page':'add_licensce'},
               		success:function(target){
                    
                      if(target.statusCode == 0) {
                      	 $('#dis_success').css('display','none');

		                  $('#Distributor_name').val('');
	                      $('#Distributor_mobile').val('');
		                  $('#Distributor_email').val('');
			              $('#Distributor_Address').val('');
			             
                          $('#licence_name').val('');
						 // $('#Distributor_id').val(target.responseId);
						  $('#show_dis').html(target.responseId);
							swal("Success",target.message, "success");
							
								setTimeout(function(){
									//window.location.reload();
								}, 2000);								
						}else{
								swal("Action failed",target.message, "error");
							}
               		}

               	});


               }else{
               	alert('Please Fill all fields');
               }

		});
		/**********************************************END ADD add_licence****************************************/
		$('#add_distributors').on('click',function(){
			
			var Distributor_name=$('#Distributor_name').val();
			var Distributor_mobile=$('#Distributor_mobile').val();
			var Distributor_email=$('#Distributor_email').val();
			var Distributor_Address=$('#Distributor_Address').val();
			var state=$('#state').val();
			
			if(Distributor_name!="" && Distributor_mobile!="" && Distributor_email!="" && Distributor_Address){
				
            $.ajax({
            type:'POST',
            url:'ajax.php',
            dataType:'JSON',
            data:{'Distributor_name':Distributor_name,'Distributor_mobile':Distributor_mobile,'Distributor_email':Distributor_email,'Distributor_Address':Distributor_Address,'state':state,'page':'add_distributors'},
            cache: false,
            success:function(res){
           
                   
            	if(res.statusCode == 0) {
					
            		        $('#dis_success').css('display','block');
							swal("Success",res.message, "success");
							
								//setTimeout(function(){
									//window.location.reload();
								//}, 2000);	
								$('#Distributor_id').val(res.responseId);
                                								
													
						}else{
								swal("Action failed",target.message, "error");
							}

            }
            });


			  }else{
			  	alert('Please fill all fields');
			  }
		});

	</script>
	
   
    <!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
	<!--------------------------------------------------- /.container-fluid-------------------------------------------------->
    <!-- /.content-wrapper-->
    <?php
	 include ('footer.php');
	?>
	
	
<script>
$('body').addClass('sidenav-toggled'); 
</script>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title" id="myModalLabel">Edit Licence</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body" style="background-image: none;">
       <div class="col-md-12 pull-left">
				<label for="defaultFormLoginEmailEx" class="grey-text">Edit Licence</label>
				<input type="email" id="defaultFormLoginEmailEx" class="form-control">
			</div>
			
			
      </div>
      <div class="modal-footer">
	  <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
	