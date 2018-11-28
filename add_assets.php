<?php include ('header.php');?>

<?php
	//get Brand	
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);
	$url="http://".$baseurl."/salesforceapi/getBrand";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $data=curl_exec($ch);
	curl_close($ch);
	$rowdata_brand=json_decode($data);
	//echo '<pre>';print_r($rowdata_brand);
	
	//get Product	
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);
	$url="http://".$baseurl."/salesforceapi/getProduct";
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $data=curl_exec($ch);
	curl_close($ch);
	$rowdata_product=json_decode($data);
	//echo '<pre>';print_r($rowdata_product);
	
	// get Assets
	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
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
	$assets=curl_exec($ch);
	curl_close($ch);
	$getAssets=json_decode($assets);
    //print_r($getAssets);	
		
?>
		    
	<div class="content-wrapper">	
		<div class="container">	
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="#">Retailer</a>
				</li>
				
				<li class="breadcrumb-item active">Add Assets</li>
			</ol>
		<div class="container">
		<?php
		if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[14]->add=='Y'){
			?>
			<div class="row" style="margin: 18px -15px;">			
				<div class="col-md-3 add-form">
					<input type="hidden" id="distributerid"  name="distributerid" value="1" class="form-control">
					<label>Brand</label>
						<select class="form-control" name="brand_name" id="brand_name">
							<option>Select Brand</option>
								<?php foreach($rowdata_brand->brandList as $value){?>
									<option value="<?php echo $value->brandId;?>"><?php echo $value->brandName;?></option>
								<?php }?>						
						</select>				   
				</div>
				<div class="col-md-3 add-form">
					<label>Product</label>
						<select class="form-control" name="product" id="product">
							<option>Select Product</option>
								<?php foreach($rowdata_product->listProduct as $productvalue){?>
									<option value="<?php echo $productvalue->productId;?>"><?php echo $productvalue->productName;?></option>
								<?php }?>
						</select>
				   
				</div>
				<div class="col-md-3 add-form">
					<label>Assets Type</label>
						<select class="form-control" name="assets_type" id="assets_type">
							<option>Select Assets</option>
							<option>Tengible</option>
							<option>Intengible</option>						
						</select>				   
				</div>
				<div class="col-md-3 add-form">
					<label>Assets</label>
						<input type="text" class="form-control" name="assets" id="assets">				   
				</div> 
				<div class="col-md-4 add-form" >				   
					<label>Description</label>
						<textarea class="form-control" rows="3" style="resize:none;" name="description" id="description"></textarea>
							<button class="add-btn add-margin" type="submit" id="add_assets" name="add_assets">Create</button>
				</div>
			</div>
			<?php
			
			
		}
		?>
		
			

			
		<!--Get Assets-->
		
			<div class="row">	   
				<table class="table table-hover" id="example" style="border:1px solid #ddd; font-size:12px;">
					<thead>
						<tr>
							<th>Assets</th>
							<th>Brand</th>
							<th>Product</th>
							<th>Assets Type</th>
							<th>Description</th>
							<?php
							if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[14]->edit=='Y'){
								?>
							      <th>Action</th>	
								<?php
								
							}
							?>
							
						</tr>
					</thead>
					<tbody>
							<?php foreach($getAssets->listAssetByretailerData as $assetsdata){?>
								<tr>
									<td><?= $assetsdata->assetName;?></td>
									<td><?= $assetsdata->brandName;?></td>
									<td><?= $assetsdata->productName;?></td>
									<td><?= $assetsdata->assetType;?></td>
									<td><?= $assetsdata->description;?></td>
									<?php
									if($_SESSION['userData']['roleId']=='1' || $rowdatapermissionValid->list[14]->edit=='Y'){
									  ?>
									  <td> 
										<button type="button" class="btn btn-primary small-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
										<button type="button" class="btn btn-danger small-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
									</td>
									  <?php
									}
									?>
									
								</tr>
							<?php }?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!--Script-->
	
	<script>
	
		// Brand
		$('#brand_name').on('change', function(){
			var brandid=this.value;	
			if(brandid!=''){
				$.ajax({
					type: "GET",
					url: 'ajax.php',
					dataType:'JSON',
					data: 'brandid='+brandid+'&page=get_productbybrandId',				
					success: function(res){	
						console.log(res);	
						$('#product').html(res.productID);
					}
				});
			}
		});
		
		// Add Assets
		
		$(document).ready(function(){
			$("#add_assets").click(function(){
				var brand_name= $('#brand_name').val();
				var product= $('#product').val();
				var assets_type= $('#assets_type').val();
				var assets= $('#assets').val();
				var description= $('#description').val();	
				var distributerId=$('#distributerid').val();
				$.ajax({
					type: 'POST',
					url:"ajax.php",
					dataType:'json',
					data:{'brand_name':brand_name,'product':product,'assets_type':assets_type,'assets':assets,'description':description,'distributerid':distributerId,'page':"add_assets"},
					cache: false,
					success: function(data){
						console.log(data);
						if(data.statusCode == 0) {
							swal("Success",data.message, "success");
								setTimeout(function(){
									window.location.reload();
								}, 2000);								
						}else{
								swal("Action failed",data.message, "error");
							}
					}
				});
				 return false;
			});
		});
		
		$(document).ready(function() {
	
			$('#example').DataTable();
		});
	</script>
    <?php include ('footer.php');?>