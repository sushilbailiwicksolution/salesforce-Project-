<?php
	 include ('header.php');
	?>
  
  
  
  <div class="content-wrapper">
	
	<div class="container">
	
		<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Products</a>
        </li>
        <li class="breadcrumb-item active">Add Products</li>
      </ol>
	   <!-----ddddddd--------->
	   <div class="container" >
	   

		   <div class="row" style="margin: 18px -15px;">
			   <div class="col-md-8" style="padding:0px;">
			   </div>
			   <div class="col-md-4 csv" style="padding:0px;">
				<button>Download CSV</button>
				<button>Upload CSV</button>
			   </div>
		   </div>
	   
	   
	      <?php 
		extract($_POST);
	//print_r($_POST); die;
	$form_designation=array('distributerId'=>'1');
	
	$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://103.206.248.235:8080/salesforceapi/getBrand";
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
	
	$brand=curl_exec($ch);
	curl_close($ch);
	//print_r($brand);
	$getbrand=json_decode($brand);
	   ?>
	   <form method="POST" action="">	
		<div class="row abc">
				
			<div class="col-sm-2">
			<input type="hidden" id="employee"  name="employee" value="1" class="form-control">
		   <input type="hidden" id="distributerid"  name="distributerid" value="1" class="form-control">
				<label for="defaultFormLoginEmailEx" class="grey-text">Brand Name</label>
				<select class="form-control" name="brand_name" id="brand_name">
				<option value="">Select Brand</option>
				<?php foreach($getbrand->brandList as $value){ ?>
						<option value="<?php echo $value->brandId; ?>"><?php echo $value->brandName; ?></option>
						
				<?php }?>
				</select>
			</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
$('#brand_name').on('change', function () {
	var brandid=this.value;	
	//alert(brandid);
	if(brandid!=''){
			$.ajax({
				type: "GET",
				url: 'ajax.php',
				dataType:'JSON',
				data: 'brandid='+brandid+'&page=getbrandcode',				
				success: function(res){	
				console.log(res);
				//var result=jQuery.parseJSON(res);
					$('#brand_code').html(res.brand_id);
					$('#internal_brand_code').html(res.internal_brand);
					$('#license').html(res.license_name);
					
				}
			});
		}
	});
</script>

			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Brand Code</label>
				<select class="form-control" name="brand_code" id="brand_code">
						<option>Select</option>							
							<?php if(isset($_POST['brand_name'])){
									//$bid=$_POST['state'];?>
							<option value="<?php echo $value->brandId;?>" ><?php echo $value->brandCode; ?></option>
						<?php }?>
						
							<?php foreach($getbrand->brandList as $value){ ?>
						<option value="<?php echo $value->brandId; ?>"><?php echo $value->brandCode; ?></option>
						
				<?php }?>
			   </select>
			</div>

<script>			
$('#brand_code').on('change', function () {
	var brand_code=this.value;	
	//alert(brandid);
	if(brand_code!=''){
			$.ajax({
				type: "GET",
				url: 'ajax.php',
				dataType:'JSON',
				data: 'brand_code='+brand_code+'&page=getbrandname',				
				success: function(res){	
				//console.log(res);
				//var result=jQuery.parseJSON(res);
					$('#brand_name').html(res.brand_id);
					$('#internal_brand_code').html(res.internal_brand);
					$('#license').html(res.license_name);
				}
			});
		}
	});
</script>

			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Internal Br. Code</label>
				<select class="form-control" name="internal_brand_code" id="internal_brand_code">
						<option>Select</option>							
							<?php if(isset($_POST['brand_name'])){
									//$bid=$_POST['state'];?>
							<option value="<?php echo $value->brandId;?>" ><?php echo $value->internalBrandCode; ?></option>
						<?php }?>
						
						<?php foreach($getbrand->brandList as $value){ ?>
						<option value="<?php echo $value->brandId; ?>"><?php echo $value->internalBrandCode; ?></option>
						<?php }?>
					</select>
			</div>

<script>			
$('#internal_brand_code').on('change', function () {
	var internal_brand_code=this.value;	
	//alert(brandid);
	if(internal_brand_code!=''){
			$.ajax({
				type: "GET",
				url: 'ajax.php',
				dataType:'JSON',
				data: 'internal_brand_code='+internal_brand_code+'&page=get_internal_brand_name',				
				success: function(res){	
				console.log(res);
				//var result=jQuery.parseJSON(res);
					$('#brand_name').html(res.internal_brand);
					$('#brand_code').html(res.brand_id);
					$('#license').html(res.license_name);
				}
			});
		}
	});
</script>

			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Product Name</label>
				<input type="text" id="product_name" name="product_name" class="form-control">
			</div>
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Product Code</label>
				<input type="text" id="product_code" name="product_code" class="form-control">
			</div>
		 <?php 
		extract($_POST);
	//print_r($_POST); die;
	//$form_designation=array('distributerId'=>'1');
	
	//$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://103.206.248.235:8080/salesforceapi/getProductCategory";
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
	
	$productcategory=curl_exec($ch);
	curl_close($ch);
	//print_r($productcategory);
	$getproductcategory=json_decode($productcategory);	
	?>
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Product Category</label>
				<select class="form-control" name="product_category" id="product_category">
						<option value="">Select Product Category</option>
				<?php foreach($getproductcategory->lstProductRawdata as $value){ ?>
						<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>						
				<?php }?>
					</select>
			</div>
		 <?php 
		extract($_POST);
	//print_r($_POST); die;
	//$form_designation=array('distributerId'=>'1');
	
	//$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://103.206.248.235:8080/salesforceapi/getProductSegment";
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
	
	$productsegment=curl_exec($ch);
	curl_close($ch);
	//print_r($productsegment);
	$getproductsegment=json_decode($productsegment);	
	?>
			
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Product Segment</label>
				<select class="form-control" id="product_segment" name="product_segment">
						<option value="">Select Product Segment</option>
				<?php foreach($getproductsegment->lstProductRawdata as $value){ ?>
						<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>						
				<?php }?>
					</select>
					</select>
			</div>
				 <?php 
		extract($_POST);
	//print_r($_POST); die;
	//$form_designation=array('distributerId'=>'1');
	
	//$designation_string=json_encode($form_designation);
	//echo $designation_string;
	$url="http://103.206.248.235:8080/salesforceapi/getProductSubType";
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
	
	$Subtype=curl_exec($ch);
	curl_close($ch);
	//print_r($Subtype);
	$getSubtype=json_decode($Subtype);	
	?>
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Subtype</label>
				<select class="form-control" id="subtype" name="subtype">
							<option value="">Select Subtype</option>
				<?php foreach($getSubtype->lstProductRawdata as $value){ ?>
						<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>						
				<?php }?>
					</select>
					</select>
			</div>
			
				 <?php 
		extract($_POST);
	
	$url="http://103.206.248.235:8080/salesforceapi/getPackagetype";
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
	
	$packagetype=curl_exec($ch);
	curl_close($ch);
	//print_r($packagetype);
	$getpackagetype=json_decode($packagetype);	
	?>
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Package Type</label>
				<select class="form-control" id="package_type" name="package_type">
						<option value="">Select Package</option>
				<?php foreach($getpackagetype->lstProductRawdata as $value){ ?>
						<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>						
				<?php }?>
					</select>
			</div>
			
			
 <?php 
	extract($_POST);
	$url="http://103.206.248.235:8080/salesforceapi/getProductType";
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
	
	$protype=curl_exec($ch);
	curl_close($ch);
	//print_r($protype);
	$getprotype=json_decode($protype);	
	?>			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Pro. Type</label>
					<select class="form-control" id="pro_type" name="pro_type">
						<option value="">Select Pro.Type</option>
						<?php foreach($getprotype->lstProductRawdata as $value){ ?>
								<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>						
						<?php }?>
					</select>
			</div>
			
			
			
					 <?php 
		extract($_POST);	
	$url="http://103.206.248.235:8080/salesforceapi/getQtyPcs";
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
	
	$qtypcs=curl_exec($ch);
	curl_close($ch);
	//print_r($qtypcs);
	$getqtypcs=json_decode($qtypcs);	
	?>
						
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Qyt. (ML)</label>
				<select class="form-control" id="qyt_ml" name="qyt_ml">
						<option value="">Select Qyt</option>
						
					<?php if(isset($_POST['qty'])){?>
						<option value="<?php echo $value->id; ?>"><?php echo $value->qtyMl; ?></option>	
					<?php }?>
						
				<?php foreach($getqtypcs->listQtyInPcs as $value){ ?>
						<option value="<?php echo $value->id; ?>"><?php echo $value->qtyMl; ?></option>						
				<?php }?>
					</select>
			</div>
			
			<script>			
			$('#pro_type').on('change', function (){
				var pro_type=this.value;	
				//alert(pro_type);
				if(pro_type=='5'){
					$("#number").append('<option value="1">1</option>');
				}else{
					if(pro_type!=''){
						$.ajax({
							type: "GET",
							url: 'ajax.php',
							dataType:'JSON',
							data: 'pro_type='+pro_type+'&page=get_pro_type_name',				
							success: function(res){	
							  //console.log(res);
							   $('#qyt_ml').html(res.qty);
							   $('#number').html(res.qty_num);
							}
						});
					}
				}
				
				});
			</script>
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Number</label>
				<select class="form-control" id="number" name="number">
					<?php if(isset($_POST['qty'])){?>
						<option value="<?php echo $value->id; ?>"><?php echo $value->pcs; ?></option>	
					<?php }?>
				</select>
			</div>
			
	 <?php 

	$url="http://103.206.248.235:8080/salesforceapi/getAllDistributer";
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
	$license=curl_exec($ch);
	curl_close($ch);
	//print_r($license);
	$getlicense=json_decode($license);
	   ?> 	   
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">License</label>
					<select class="form-control" name="license" id="license">
						<option>Select</option>							
							<?php if(isset($_POST['brand_name'])){
									//$bid=$_POST['state'];?>
							<option value="<?php echo $value->brandId;?>" ><?php echo $value->licenseName; ?></option>
						<?php }?>
						
							<?php foreach($getbrand->brandList as $value){ ?>
						<option value="<?php echo $value->brandId; ?>"><?php echo $value->licenseName; ?></option>
						
						<?php }?>
					</select>
			</div>
			
			<script>			
$('#license').on('change', function () {
	var license=this.value;	
	//alert(brandid);
	if(license!=''){
			$.ajax({
				type: "GET",
				url: 'ajax.php',
				dataType:'JSON',
				data: 'license='+license+'&page=get_license_name',				
				success: function(res){	
				console.log(res);
				//var result=jQuery.parseJSON(res);
					$('#internal_brand_code').html(res.internal_brand);
					$('#brand_code').html(res.brand_id);
					$('#brand_name').html(res.brand_name);
				}
			});
		}
	});
</script>

			<div class="col-sm-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">EX-Factory /CIF</label>
				<input type="email" id="ex_factory" name="ex_factory" class="form-control">
			</div>
			<div class="col-sm-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">Wholesale Price(WSP)</label>
				<input type="email" id="wholesale_price" name="wholesale_price" class="form-control">
			</div>
			<div class="col-sm-3">
				<label for="defaultFormLoginEmailEx" class="grey-text">Maximum Retail
Price(MRP) </label>
				<input type="email" id="maximum_retail" name="maximum_retail" class="form-control">
			</div>
			
			
			
			<div class="col-sm-2">
				<label for="defaultFormLoginEmailEx" class="grey-text">Status</label>
				<select class="form-control" name="status" id="status">
					<option value="">Select Status</option>
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
			</div>
			
			<div class="col-sm-2">
				<button type="submit" class="add-btn new-btn" id="add_product" name="add_product">Submit</button>
			</div>
			
		</div>
	   </form>

	</div>
	</div>
	
   
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#add_product").click(function(){
				//alert("hi");
				var brand_name= $('#brand_name').val();
				var brand_code= $('#brand_code').val();
				var internal_brand_code= $('#internal_brand_code').val();
				var product_name= $('#product_name').val();
				var product_code= $('#product_code').val();
				var product_category= $('#product_category').val();
				var product_segment= $('#product_segment').val();
				var subtype= $('#subtype').val();
				var package_type= $('#package_type').val();
				var qyt_ml= $('#qyt_ml').val();
				var pro_type= $('#pro_type').val();
				var number= $('#number').val();
				var license= $('#license').val();
				var ex_factory= $('#ex_factory').val();
				var wholesale_price= $('#wholesale_price').val();
				var maximum_retail= $('#maximum_retail').val();
				var status= $('#status').val();
				var distributerId=$('#distributerid').val();
				var employeeID=$('#employee').val();
				$.ajax({
					 type: 'POST',
					 url:"ajax.php",
					 dataType:'json',
					 data:{'brand_name':brand_name,'brand_code':brand_code,'internal_brand_code':internal_brand_code,'product_name':product_name,'product_code':product_code,'product_category':product_category,'product_segment':product_segment,'subtype':subtype,'package_type':package_type,'qyt_ml':qyt_ml,'pro_type':pro_type,'number':number,'license':license,'ex_factory':ex_factory,'wholesale_price':wholesale_price,'maximum_retail':maximum_retail,'status':status,'distributerid':distributerId,'employee':employeeID,'page':"add_products"},
					cache: false,
					success: function(product){
						console.log(product);
						if(product.statusCode == 0) {
							swal("Success",product.message, "success");
								setTimeout(function(){
								  window.location.href='products.php';
								}, 2000);								
							}else {
								swal("Action failed",product.message, "error");
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