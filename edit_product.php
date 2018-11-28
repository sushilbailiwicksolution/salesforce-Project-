<?php

	include ('header.php');

	

	// Start Get Brand

	extract($_POST);

	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);
	$url="http://".$baseurl."/salesforceapi/getBrand";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                                          	

	$brand=curl_exec($ch);

	curl_close($ch);

	$getbrand=json_decode($brand);

	

	//End Get Brand

	

	// Start Get Product Category

	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);
	$url="http://".$baseurl."/salesforceapi/getProductCategory";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               	

	$productcategory=curl_exec($ch);

	curl_close($ch);

	$getproductcategory=json_decode($productcategory);	

	

	// End Get Product Category

	

	// Start Get Product Segment

	

	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
	$url="http://".$baseurl."/salesforceapi/getProductSegment";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                                	

	

	$productsegment=curl_exec($ch);

	curl_close($ch);

	$getproductsegment=json_decode($productsegment);

	

	// End Get Product Segment

	

	//Start Get Product SubType

	

	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);		
	$url="http://".$baseurl."/salesforceapi/getProductSubType";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                      

	$Subtype=curl_exec($ch);

	curl_close($ch);

	$getSubtype=json_decode($Subtype);	

	

	// End Get Product SubType

	

	// Start Get Package Type

	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);
	$url="http://".$baseurl."/salesforceapi/getPackagetype";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);     

	$packagetype=curl_exec($ch);

	curl_close($ch);

	$getpackagetype=json_decode($packagetype);	

	

	// End Get Package Type 

	

	// Start Get Quantity 

	

	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
	$url="http://".$baseurl."/salesforceapi/getQtyPcs";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);

	$qtypcs=curl_exec($ch);

	curl_close($ch);

	$getqtypcs=json_decode($qtypcs);

	

	// End Get Quantity

	

	// Start Get Product Type

	

	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
	$url="http://".$baseurl."/salesforceapi/getProductType";
	$header=array('Accept: application/json',
		'Content-Type: application/json');
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$brand_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                 

	$protype=curl_exec($ch);

	curl_close($ch);

	$getprotype=json_decode($protype);

	

	// End Get Product Type

	

	// Start Get License 

	

	$url="http://".$baseurl."/salesforceapi/getAllDistributer";

	$header=array('Accept: application/json',

		'Content-Type: application/json');

	$ch=curl_init();

	curl_setopt($ch,CURLOPT_URL,$url);

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 

	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	

	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          

		'Content-Type: application/json')                                                                    

	);                           

	$license=curl_exec($ch);

	curl_close($ch);

	$getlicense=json_decode($license);

	

	// End Get License 

	

	// Get Product 

	

	$form_product=array('distributerId'=>$_SESSION['userData']['distributerId']);	

	$product_string=json_encode($form_product);		

	$url="http://".$baseurl."/salesforceapi/getProduct";

	$header=

	array(

		'Accept: application/json',

		'Content-Type: application/json',

		);

	$ch=curl_init();

	curl_setopt($ch,CURLOPT_URL,$url);

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 

	curl_setopt($ch,CURLOPT_POSTFIELDS,$product_string);

	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

	//curl_setopt($ch, CURLOPT_HEADER, true);

	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          

		'Content-Type: application/json')                                                                    

	);                               		

	 $product=curl_exec($ch);

	curl_close($ch);

	$getProduct=json_decode($product);

	

	// End Product 

	

?> 

	<div class="content-wrapper">

			<div class="container">	

				<ol class="breadcrumb">

					<li class="breadcrumb-item">

						<a href="#">Products</a>

					</li>

					<li class="breadcrumb-item active">Edit Products</li>

				</ol>

			<div class="container">

			<div class="row" style="margin: 18px -15px;">

				<div class="col-md-8" style="padding:0px;"></div>

				<?php if(!empty($_GET['pro_id'])){?>

				<div class="col-md-4 csv" style="padding:0px;">

				<?php 

					@$proID=$_GET['pro_id'];

					@$source=$_GET['source'];

					if(!$source){

				?>

					<button onclick="editProfile(<?=$proID;?>);">Edit Product</button>

					<?php }else{?>

					

					<?php }?>

			   </div>

			   <?php }?>

			</div> 

			

			<!-- 	Edit Product & View Product Button -->

	

			<script>

				function editProfile(id){

					window.location.href="http://localhost/sales-force-admin/edit_product.php?pro_id="+id+"&source=edit";

				}

				function viewProfile(id){

					window.location.href="http://localhost/sales-force-admin/edit_product.php?pro_id="+id+"";

				}

			</script>

			<?php if(!empty($_GET['pro_id'])){?>

             <script>

			 

			  var proID='<?php echo $_GET['pro_id'];?>';

			 </script>

							

			<?php } ?>

			

			

	<!--Edit Product-->	

<?php if(!empty($proID)){

		foreach($getProduct->listProduct as $productData){

			if($productData->productId==$proID){?>

		<div class="row abc">	  

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Brand Name</label>

				<input type="hidden" id="updateid"  name="updateid" value="1" class="form-control">

				<select class="form-control" id="brand_name" name="brand_name">

				<option> Select Brand Name </option>	

				<?php foreach($getbrand->brandList as $brandData){?>

							<option value="<?= $brandData->brandId;?>"

								<?php if($productData->brandName==$brandData->brandName){echo 'selected'; } ?>>

								<?= $brandData->brandName;?></option>

				<?php } ?>

					

				</select>

			</div>

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Brand Code</label>

				<select class="form-control" id="brand_code" name="brand_code">				

				<option> Select Brand Code </option>	

				<?php foreach($getbrand->brandList as $brandcode){?>

						<option value="<?= $brandcode->brandId; ?>"<?php if($productData->brandCode==$brandcode->brandCode){echo 'selected'; } ?>><?= $brandcode->brandCode;?></option>

				<?php }?>

				</select>

			</div>			

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Internal Br. Code</label>

				<select class="form-control" id="internal_brand_code" name="internal_brand_code">

				<option> Select Internal Brand Code</option>	

				<?php foreach($getbrand->brandList as $internalbrandcode){?>

						<option value="<?= $internalbrandcode->brandId; ?>"<?php if($productData->internalBrandCode==$internalbrandcode->internalBrandCode){echo 'selected'; } ?>><?= $internalbrandcode->internalBrandCode;?></option>

				<?php }?>

				</select>

			</div>

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Product Name</label>

				<input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo $productData->productName;?>">

			</div>

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Product Code</label>

				<input type="text" id="product_code" name="product_code" class="form-control" value="<?php echo $productData->productCode;?>">

			</div>

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Product Category</label>

				<select class="form-control" id="product_category" name="product_category">

				<option> Select Product Category </option>	

				<?php foreach($getproductcategory->lstProductRawdata as $productcategoryData){?>

					<option value="<?=$productcategoryData->id?>"<?php if($productData->productcategoryName==$productcategoryData->name){echo 'selected'; } ?>><?= $productcategoryData->name;?></option>

				<?php } ?>

				</select>

			</div>

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Product Segment</label>

				<select class="form-control" id="product_segment" name="product_segment">

				<option>Select Product Segment</option>	

				<?php foreach($getproductsegment->lstProductRawdata as $productsegmentData){?>

					<option value="<?=$productsegmentData->id?>" <?php if($productData->productSegmentName==$productsegmentData->name){echo 'selected'; } ?>><?= $productsegmentData->name;?></option>

				<?php } ?>

				</select>

			</div>

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Subtype</label>

				<select class="form-control" id="subtype" name="subtype">

				<option>Select SubType</option>	

				<?php foreach($getSubtype->lstProductRawdata as $subtypeData){?>

					<option value="<?=$subtypeData->id?>" <?php if($productData->productSubTypeName==$subtypeData->name){echo 'selected'; } ?>><?= $subtypeData->name;?></option>

				<?php } ?>

				</select>

			</div>

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Package Type</label>

				<select class="form-control" id="package_type" name="package_type">

				<option> Select Package Type</option>	

				<?php foreach($getpackagetype->lstProductRawdata as $packageTypeData){?>

					<option value="<?=$packageTypeData->id?>"<?php if($productData->packagetype==$packageTypeData->name){echo 'selected'; } ?>><?= $packageTypeData->name;?></option>

				<?php } ?>

				</select>

			</div>			

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Qyt. (ML)</label>

				<select class="form-control" id="qyt_ml" name="qyt_ml">

				<option> Select Quantity Ml</option>	

				<?php foreach($getqtypcs->listQtyInPcs as $qtyData){?>

					<option value="<?=$qtyData->id?>" <?php if($productData->qtyMl==$qtyData->id){echo 'selected'; } ?>><?= $qtyData->qtyMl;?></option>

				<?php } ?>

				</select>

			</div>

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Pro. Type</label>

					<select class="form-control" id="pro_type" name="pro_type">

					<option> Select Pro Type </option>	

				<?php foreach($getprotype->lstProductRawdata as $proTypeData){?>

					<option value="<?=$proTypeData->id?>"<?php if($productData->productTypeName==$proTypeData->name){echo 'selected'; } ?>><?= $proTypeData->name;?></option>

				<?php } ?>

					</select>

			</div>

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Number</label>

				<select class="form-control" id="number" name="number">

					<?php if(isset($_POST['qty'])){?>

						<option value="<?php echo $value->id; ?>"><?php echo $value->pcs; ?></option>	

					<?php }?>

					

					

					<?php

							if($productData->boxSize==1){								

								echo '<option value="'.$productData->boxSize.'">'. '1'.'</option>';								

							}

							

					        foreach($getqtypcs->listQtyInPcs as $numberData){

								if($productData->boxSize == $numberData->id && !($productData->boxSize==1) ){

									$select='selected';

									echo '<option value="'. $numberData->id .'" '.$select.' >'. $numberData->pcs.'</option>';		

								}	

									//echo '<option value="'. $value->id .'" '.$select.' >'. $value->pcs.'</option>';	

							} ?>					

				</select>

			</div>

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">License</label>

				<select class="form-control" name="license" id="license">

						<option>Select</option>							

							<?php if(isset($_POST['brand_name'])){?>

							<option value="<?php echo $value->licenseId;?>" ><?php echo $value->licenseName; ?></option>

						<?php }?>

							<?php $arr=array(); foreach($getbrand->brandList as $value){?>

							<?php if(!in_array($value->licenseId,$arr,TRUE)){?>

						    <option value="<?php echo $value->licenseId; ?>" <?php if($productData->licenseId == $value->licenseId){echo 'selected'; } ?>><?php echo $value->licenseName; ?></option>

						    <?php } ?>

						<?php array_push($arr,$value->licenseId); } //print_r($arr);?>

				</select>

			</div>

			<div class="col-sm-3">

				<label for="defaultFormLoginEmailEx" class="grey-text">EX-Factory /CIF</label>

				<input type="text" id="ex_factory" name="ex_factory" class="form-control" value="<?php echo $productData->cif;?>">

			</div>

			<div class="col-sm-3">

				<label for="defaultFormLoginEmailEx" class="grey-text">Wholesale Price(WSP)</label>

				<input type="text" id="wholesale_price" name="wholesale_price" class="form-control" value="<?php echo $productData->wsp;?>">

			</div>

			<div class="col-sm-3">

				<label for="defaultFormLoginEmailEx" class="grey-text">Maximum Retail Price(MRP) </label>

				<input type="text" id="maximum_retail" name="maximum_retail" class="form-control" value="<?php echo $productData->mrp;?>">

			</div>	

			<div class="col-sm-3">

				<label for="defaultFormLoginEmailEx" class="grey-text">Excise Duty </label>

				<input type="number" id="excise_duty" name="excise_duty" class="form-control"  value="<?php echo $productData->exciseDuty;?>">

			</div>					

			<div class="col-sm-2">

				<label for="defaultFormLoginEmailEx" class="grey-text">Status</label>

				<select class="form-control" id="status" name="status">

						<option value="">Select Status</option>

						<option value="1" <?php echo ($productData->productStatus==1)?'selected':''?>>Active</option>

						<option value="2" <?php echo ($productData->productStatus==2)?'selected':''?>>Inactive</option>

					</select>

				</select>

			</div>

			<div class="col-sm-2">

				<button type="button" class="add-btn new-btn" id="update_product">UPDATE</button>

			</div>

		</div>  

<?php 

			}

		}

	}	

?>

	</div>

	</div>

</div>



<!--Script-->



<script>

	// Brand Name



		$('#brand_name').on('change', function(){

			var brandid=this.value;	

			if(brandid!=''){

				$.ajax({

					type: "GET",

					url: 'ajax.php',

					dataType:'JSON',

					data: 'brandid='+brandid+'&page=getbrandcode',				

					success: function(res){	

						console.log(res);

						$('#brand_code').html(res.brand_id);

						$('#internal_brand_code').html(res.internal_brand);

						$('#license').html(res.license_name);					

					}

				});

			}

		});

		

	// Brand Code	

		

		$('#brand_code').on('change', function () {

			var brand_code=this.value;	

			if(brand_code!=''){

				$.ajax({

					type: "GET",

					url: 'ajax.php',

					dataType:'JSON',

					data: 'brand_code='+brand_code+'&page=getbrandname',				

					success: function(res){	

						$('#brand_name').html(res.brand_id);

						$('#internal_brand_code').html(res.internal_brand);

						$('#license').html(res.license_name);

					}

				});

			}

		});

		

	// Internal Brand Code 

	

		$('#internal_brand_code').on('change', function () {

			var internal_brand_code=this.value;	

			if(internal_brand_code!=''){

				$.ajax({

					type: "GET",

					url: 'ajax.php',

					dataType:'JSON',

					data: 'internal_brand_code='+internal_brand_code+'&page=get_internal_brand_name',				

					success: function(res){	

						console.log(res);

						$('#brand_name').html(res.internal_brand);

						$('#brand_code').html(res.brand_id);

						$('#license').html(res.license_name);

					}

				});

			}

		});

		

	// Product Type

	

		$('#pro_type').on('change', function (){

			$('#number option[value!="0"]').remove();

			var pro_type=this.value;

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

							   $('#number').html(res.qty_num);

							}

						});

					}

				}

		});

		

	// License 

	

		$('#license').on('change', function () {

			var license=$('#license').val();

			if(license!=''){

				$.ajax({

					type: "GET",

					url: 'ajax.php',

					dataType:'JSON',

					data: 'license='+license+'&page=get_license_name',				

					success: function(res){	

						console.log(res);

						$('#internal_brand_code option[value!="0"]').remove();	

						$('#brand_code option[value!="0"]').remove();	

						$('#brand_name option[value!="0"]').remove();

						$('#internal_brand_code').html(res.internal_brand);

						$('#brand_code').html(res.brand_id);

						$('#brand_name').html(res.brand_name);

					}

				});

			}

		});

		

	// Edit Product

	

		$("#update_product").click(function(){

			var brand_name= $('#brand_name').val();

			var product_name= $('#product_name').val();

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

			var updateID=$('#updateid').val();

			var product_code=$('#product_code').val();

			var excise_duty=$('#excise_duty').val();

				$.ajax({

						type: 'POST',

						url:"ajax.php",

						dataType:'json',

						data:{'brand_name':brand_name,'product_name':product_name,'product_category':product_category,'product_segment':product_segment,'subtype':subtype,'package_type':package_type,'qyt_ml':qyt_ml,'pro_type':pro_type,'number':number,'license':license,'ex_factory':ex_factory,'wholesale_price':wholesale_price,'maximum_retail':maximum_retail,'excise_duty':excise_duty,'status':status,'productID':proID,'product_code':product_code,'updateID':updateID,'page':"update_product"},

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

		

	

	// Disabled Fields

		<?php if(!$source){ ?>

				$( "#brand_name" ).prop( "disabled", true );

				$( "#brand_code" ).prop( "disabled", true );

				$( "#internal_brand_code" ).prop( "disabled", true );

				$( "#product_code" ).prop( "disabled", true );

				$( "#license" ).prop( "disabled", true );

				$( "#product_name" ).prop( "disabled", true );

				$( "#product_code" ).prop( "disabled", true );

				$( "#product_category" ).prop( "disabled", true );

				$( "#product_segment" ).prop( "disabled", true );

				$( "#subtype" ).prop( "disabled", true );

				$( "#package_type" ).prop( "disabled", true );

				$( "#pro_type" ).prop( "disabled", true );

				$( "#qyt_ml" ).prop( "disabled", true );

				$( "#numer" ).prop( "disabled", true );

				$( "#wholesale_price" ).prop( "disabled", true );

				$( "#maximum_retail" ).prop( "disabled", true );

				$( "#ex_factory" ).prop( "disabled", true );

				$( "#excise_duty" ).prop( "disabled", true );

				$( "#status" ).prop( "disabled", true );

				$( "#number" ).prop( "disabled", true );

				$( "#update_product" ).hide();

		<?php }else{?>

				$( "#brand_name" ).prop( "disabled", true );

				$( "#brand_code" ).prop( "disabled", true );

				$( "#internal_brand_code" ).prop( "disabled", true );

				$( "#product_code" ).prop( "disabled", true );

				$( "#license" ).prop( "disabled", true );

		<?php }?>

	

</script>





	

<?php include ('footer.php');	?>