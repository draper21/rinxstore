<?php require_once('header.php');
	  require_once('config/config.php');

if (!empty($_GET))
{
	$product =  $_GET['id'];
	$_SESSION['proID'] = $_GET['id'];
}



$database = new DB();

//$query = "SELECT * FROM product WHERE pro_ID = $product"; 
$query = "SELECT * FROM product p WHERE pro_ID = $product";
list($proID, $proName, $proDescript, $proPrice, $proQty, $proManufacturer, $proModel, $catID, $proFeat, $proWeight) = $database->get_row($query);


$dir = "C:/inetpub/wwwroot/cit410/products/". $proID . "_";

// Initialize filecount variavle 
$filecount = 0; 
$files2 = glob( $dir ."*" ); 
  
if( $files2 ) { 
    $filecount = count($files2); 
} 
?>
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md">	
						<div class="sp-wrap">
							<?php 
								for ($i = 1; $i <= $filecount; $i++) {
									echo '<a href="/cit410/products/' . $proID. '_' . $i .'.jpg"><img src="/cit410/products/' . $proID. '_' . $i .'.jpg" alt=""></a>';
								}
							?>
						</div>
					</div>
				
					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?php echo $proManufacturer;?></h2>
							<h2 class="product-name"><?php echo $proName;?></h2>
							<div>
								
							</div>
							<div>
								<h3 class="product-price">$<?php echo $proPrice;?></h3>
								<span class="product-available"><?php echo $proQty;?> In Stock</span>
							</div>
							<div class="product-rating">
							<?php AllStars(); ?>
							</div>
							<br>
							<br>
							<p><?php echo $proDescript; ?></p>

							<?php
								$query2 = "SELECT * FROM prodopt WHERE pro_ID = $product";
								$prodopts = $database->get_results($query2);
							?>
							<form id="add_item">
							<div class="product-options">
								<label>
									Option
									<select class="input-select" id="option">
										<option value="0">No Option</option>
									<?php foreach($prodopts as $prodopt) : ?>
										<option value="<?=$prodopt['opt_ID'];?>"><?=$prodopt['opt_Value'];?></option>
									<?php endforeach; ?>
									</select>
								</label>
								
								<input type="hidden" name="productsubmit" id="productsubmit" value="<?= $proID; ?>"/>
							</div>
						    
							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number" id="quantitysubmit" name="quantitysubmit" value = "1">
									</div>
								</div>
								<button type="submit" class="add-to-cart-btn" id="<?= $proID; ?>"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
							</form>

							<!--Rating/Review System-->
							<h3 class="product-price">Leave a Review</h3>
							<form action="addReview.php" class="form-contact" method="post" enctype="multipart/form-data" name="form1" id="form1">
							<div class="form-group">
                  			  <label for="score">RATING</label>
								<label>
								<select name="score" id="score" style="width:100%;max-width:100%;" required='required'
                      				class="input-select">
                      				<option value="" disabled selected></option>
									<option value=0>0</option>
									<option value=1>1</option>
									<option value=2>2</option>  
									<option value=3>3</option>  
									<option value=4>4</option>  
									<option value=5>5</option>    
                    			</select>
								</label>
								<br>
                  			  <label for="detail">COMMENTS</label>
                  			  <textarea class="form-control different-control w-20" name="detail"
                  			    placeholder="Enter detail" required='required'></textarea>
                  			  <br>
								<div class="add-to-cart">
                  			  <button class="add-to-cart-btn"><i class="fa fa-comment"></i>Submit</button>
								</div>
                  			</div>
							</form>
							<?php Reviews(); ?>
						</div>
					</div>
					<!-- /Product details -->
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		
		<script type="text/javascript" src="js/smoothproducts.min.js"></script>
		<script type="text/javascript">
		/* wait for images to load */
			$('.sp-wrap').smoothproducts();
		
		</script>
				
		<?php require_once("footer.php"); ?>