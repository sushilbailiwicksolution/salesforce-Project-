<?php
	 include ('header.php');
	?>
<?php 
	// get brand
	
	 $form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	
	$brand_string=json_encode($form_brand);		
	$url="http://".$baseurl."/salesforceapi/getZone";
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
	//print_r($data);
	$rowdataZone=json_decode($data);
	
	/*==========================================================GET RETAILER TYPE================================================================*/
      $_SESSION['userData']['distributerId'];
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
	$url="http://".$baseurl."/salesforceapi/getRetailerType";
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
	//print_r($data);
	$rowdata=json_decode($data);
	//echo '<pre>';print_r($rowdata->lstRetailerDetailedData);
	/*===========================================================END RETAILER TYPE================================================================*/
	/*===========================================================GET RETAILER SUB TYPE============================================================*/
	$form_brand=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$brand_string=json_encode($form_brand);	
	$url="http://".$baseurl."/salesforceapi/getRetailerSubType";
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
	//print_r($data);
	$rowdataSubtype=json_decode($data);
	//echo '<pre>';print_r($rowdataSubtype);
	/*===========================================================END RETAILER SUB TYPE=============================================================*/
	/*===========================================================GET RETAILER CATEGORY=============================================================*/
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
	$rowdataCat=json_decode($data);
	
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
	
	// get product
	
	$form_brand=array('distributerId'=>'1');
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
	//foreach($rowdata_product->listProduct as $productdata){
	//}
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
	
	// get retailer list
	
	$url="http://".$baseurl."/salesforceapi/getRetailer";
	$form_designation=array('distributerId'=>$_SESSION['userData']['distributerId']);
	$designation_string=json_encode($form_designation);
	$header=
	array(
		'Accept: application/json',
		'Content-Type: application/json',
		);

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$designation_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array(                                                                          
		'Content-Type: application/json')                                                                    
	);                               		
	 $retailer=curl_exec($ch);
	 //echo $data;
	curl_close($ch);
	$getRetailer=json_decode($retailer);

?>
  
	<div class="content-wrapper">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="#">Retailers / Retailer Assets</a>
				</li>
				<li class="breadcrumb-item active">Assign Assets</li>
			</ol>
		<div class="container" >		
			<div class="row" style="margin: 18px -15px;">
				<div class="col-md-3 add-form" >
						<label>Brand</label>
						<select class="form-control" name="brand_name" id="brand_name">
							<option>Select Brand</option>
								<?php foreach($rowdata_brand->brandList as $value){?>
									<option value="<?php echo $value->brandId;?>"><?php echo $value->brandName;?></option>
								<?php }?>						
						</select>	
				</div>
	<script>
					//  product
	
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
		
		
		
	</script>	
				
				<div class="col-md-3 add-form" >
				<label>Product</label>
					<select class="form-control" name="product" id="product">
							<option>Select Product</option>
							<?php foreach($rowdata_product->listProduct as $productvalue){
									?>								
									<option value="<?php echo $productvalue->productId;?>"><?php echo $productvalue->productName;?></option>
							<?php }?>
								
					</select>
				</div>
				<div class="col-md-3 add-form" >
				<label>Assets</label>
					<select class="form-control" name="assets" id="assets">						
						<option>Select Assets</option>
							<?php foreach($getAssets->listAssetByRetailerData as $assetsdata){?>
						<option value="<?php echo $assetsdata->id; ?>"><?php echo $assetsdata->assetName; ?></option>
							<?php }?>
					</select>
				</div>
		<script>
			// assets
		
		$('#product').on('change', function(){
			var proid=this.value;
			//alert(proid);
			if(proid!=''){
				$.ajax({
					type: "GET",
					url: 'ajax.php',
					dataType:'JSON',
					data: 'proid='+proid+'&page=get_assetsbyproductId',				
					success: function(res){	
						console.log(res);	
						$('#assets').html(res.assetsID);
					}
				});
			}
		});
		</script>
				<div class="col-md-3 add-form" >
				   <label>Qty.</label>
				   <input type="text" name="qty" id="qty" class="form-control">   
				</div>
				<div class="col-md-3 add-form" >
				   <label>Amount</label>
				   <input type="text" name="amount" id="amount" class="form-control">   
				</div>
				
				<div class="col-md-3 add-form" style="padding:0px;">
					<button type="submit" id="assign_assets" class="add-btn add-margin send-notification">Assign</button>
				</div>
			</div>
		   
	   
	<div class="row adv-s" id="show-search-box">
				
			   <div class="col-md-12">
			
			<div class="col-md-2 pd-3">
					<select class="form-control" id="type">
					<option value="">Type</option>
					<?php
					 foreach($rowdata->lstRetailerDetailedData as $retailerType){
						 ?>
						 <option value="<?php echo $retailerType->id;?>"><?php echo $retailerType->name;?></option>
						 <?php
						 
					 }
					?>
					</select>
			   </div>
			   <div class="col-md-2 pd-3">
					<select class="form-control" id="subtype">
						<option value="">Subtype</option>
						<?php
						 foreach($rowdataSubtype->lstRetailerDetailedData as $retailerSubType){
							 ?>
							 <option value="<?php echo $retailerSubType->id;?>"><?php echo $retailerSubType->name;?></option>
							 <?php
							 
						 }
						?>
					</select>
			   </div>
			   <div class="col-md-2 pd-3">
					<select class="form-control" id="cat">
						<option value="">Category</option>
						<?php
						  foreach($rowdataCat->lstRetailerDetailedData as $category){
							  ?>
							  <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
							  <?php
							  
						  }
						?>
						
					</select>
			   </div>
			   <div class="col-md-2 pd-3">
					<select class="form-control" id="zoneid">
					<option value="0">Please Select Zone</option>
					<?php
					foreach($rowdataZone->lstRetailerDetailedData as $value){
						//echo '<pre>';print_r($value);
						?>
						<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
						<?php
					}
					?>
					</select>
			   </div>
			  
			   
			    <div class="col-md-2 pd-3  padd0 ">
					<button type="submit" class="Adv-search-btn" id="searchretailer" placeholder="Search">Search</button>
			   </div>
			</div>
			   
			   
			 
		   </div>   
			<div class="row" id="showdata">	  			  
				<table class="table table-striped" style="border:1px solid #ddd; font-size:12px;" id="assign_assets">
					<thead>
						<tr>
							<th><input type="checkbox" id="checkAll"></th>
							<th style="width: 20%;">Retailer</th>
							<th style="width: 20%;">Address</th>
							<th>Zone</th>
							<th>SR</th>
							<th>Type</th>
							<th>Sub type </th>
							<th>Category</th>
							<th>Group</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($getRetailer->lstRetailerRawData as $retailerdata){?>
						<tr>							
							<td><input type="checkbox" class="checkItem" name="retailer_list[]" id="retailer_list[]" value="<?php echo $retailerdata->retailerId; ?>"></td>
							<td ><?php echo $retailerdata->retailerName;?></td>
							<td><?php echo $retailerdata->address;?></td>
							<td><?php echo $retailerdata->zoneName;?></td>
							<td><?php echo $retailerdata->srName;?></td>
							<td><?php echo $retailerdata->typeName;?></td>
							<td><?php echo $retailerdata->subTypeName;?></td>
							<td><?php echo $retailerdata->catogoryName;?></td>
							<td><?php echo $retailerdata->groupName;?></td>
						</tr>
					<?php }?>
					</tbody>
				</table>	  
			</div>
		</div>
	</div>
	<input type="hidden" id="checklength">
	<script>

$('#checkAll').click(function() {
			
         $(':checkbox.checkItem').prop('checked', this.checked); 
		  checked = []
          $(".checkItem:checked").each(function () {
           checked.push($(this).val())
          });
		   $('#csv_value').val(checked.join(","));
		   var csv_val=checked.join(",");
		  //alert(csv_val.length);
		  $('#checklength').val(csv_val.length);
       });	
	// assign assets
		$(document).ready(function(){
			
			$("#assign_assets").click(function(){
				var checklength=$('#checklength').val();
			
			if(checklength>=999){
				alert('You Can Not assign More then thousands retailer');
				return false;
				
			}
				var brand_name= $('#brand_name').val();
				var product= $('#product').val();
				var assets= $('#assets').val();
				var qty= $('#qty').val();
				var amount= $('#amount').val();					
				var retailer_list = [];
					$.each($("input[name='retailer_list[]']:checked"), function(){ 
						retailer_list.push($(this).val());
					});
				//alert("My favourite sports are: " + retailer_list.join(", "));
				
				$.ajax({
					type: 'POST',
					url:"ajax.php",
					data:{'brand_name':brand_name,'product':product,'assets':assets,'qty':qty,'amount':amount,'retailer_list':retailer_list,'page':"assign_assets"},
					dataType:'json',
					cache: false,
					success: function(data){
						console.log(data);
						if(data.statusCode == 0) {
							swal("Success",data.message, "success");
								setTimeout(function(){
									//window.location.href='retailer_assets.php';
								}, 2000);								
						}else{
								swal("Action failed",data.message, "error");
							}
					}
				});
				 return false;
			});
		});
		
		/***************************************************SEARCH RETAILER******************************************************/
		$('#searchretailer').on('click',function(){
		
			let type=$('#type').val();
			let subtype=$('#subtype').val();
			let cat=$('#cat').val();
			let zoneId=$('#zoneid').val();
			$.ajax({
			type:'POST',
            url:'ajax.php',
            data:{'type':type,'subtype':subtype,'cat':cat,'zoneId':zoneId,'page':'GetretailerBysearchparam'},
            async:false,
            success:function(res){
				//alert(res);
				$('#showdata').html(res);
				
			}			
			});
		});
		/*****************************************************END SEARCH RETAILER************************************************/
	</script>
	
	
   
   
    <?php
	 include ('footer.php');
	?>