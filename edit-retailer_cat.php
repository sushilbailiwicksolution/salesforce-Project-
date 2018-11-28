<?php
	 include ('header.php');
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
	$rowdata=json_decode($data);
	//print_r($rowdata);

	?>
  
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  <!-------------------------------------navbar ends here------------------------------------------------->
  
  
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Retailer</a>
        </li>
        <li class="breadcrumb-item active">Add Category</li>
		<!--div class="advance-tbtn" id="adv-s">Advance search</div-->
      </ol>
	   <!-----ddddddd--------->
	   <div class="container">

		   
		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-4 add-form" style="padding:0px;">
				<?php foreach($rowdata->lstRetailerDetailedData as $retaileCat){
					if($retaileCat->id==$_REQUEST['id']){
						?>
					      <label>Retailer Category</label>
				   <input type="text" class="form-control" name="name" id="category_name"required value="<?php echo $retaileCat->name;?>">
				   <label>Description</label>
				   <textarea class="form-control" rows="3" name="description" id="category_description" style="resize:none;"required><?php echo $retaileCat->description;?></textarea>	
						<?php
						
					}
					
				}?>
				   
					<button class="add-btn add-margin" name="create" id="retailer_category_update">UPDATE</button>
				
			   </div>
		   </div>
	   
	  
<div class="row">	   
  <table class="table table-hover" style="border:1px solid #ddd; font-size:12px;">
    <thead>
      <tr>
        <th>Retailer Category</th>
        <th>Description</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach($rowdata->lstRetailerDetailedData as $value){

       //echo '<pre>';print_r($value);

		 ?>
	    <tr>
			<td><?php echo $value->name; ?></td>
			<td><?php echo $value->description;?></td>
			<td> 
			<a type="button" href="edit-retailer_cat.php" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php }?>
		<!--<tr>
			<td>Silver</td>
			<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
			<td> 
			<button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>
		<tr>
			<td>Key</td>
			<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
			<td> 
			<button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
			</td>
		</tr>-->
		
    </tbody>
  </table>
</div>
	</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script>
	$(document).ready(function(){
		$("#retailer_category_update").click(function(){			
			var name= $('#category_name').val();
			//alert(name);
			var description= $('#category_description').val();
			let id='<?php echo $_REQUEST['id'];?>';
				$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'name':name,'description':description,'id':id,'page':"update_category"},
					cache: false,
					success: function(retailercategory){ 
						if(retailercategory.statusCode == 0) {
							swal("Success",retailercategory.message, "success");
								setTimeout(function(){
							    self.location.href="add_category.php";	
							}, 2000);
							}else {
								swal("Action failed",retailercategory.message, "error");
							}
					}
				});
				 return false;
			});
		});
   </script>
    <?php
	 include ('footer.php');
	?>