<?php require_once("header.php");
	  require_once('config/config.php');	
	  
	  if (!empty($_GET))
	  {
		  $category =  $_GET['id'];
		  $_SESSION['editID'] = $_GET['id'];
	  }
	 
	  if (empty($_GET))
	  {
		  $category = NULL;
	  }

?>
	
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">

							<?php
							
								$database = new DB;
								
								$query = "SELECT * FROM category WHERE cat_SubCat IS NULL"; 
    							//$stmt = $database->prepare($query); 
								//$stmt->execute(); 
								//$res = $stmt->get_result();
								$res = $database->get_results($query);
								
	  						if (empty($category)) {
								echo '<h3 class="title">Featured Products</h3>';
							  }

							if (isset($category)){
								echo '<h3 class="title">Products</h3>';
							}
	  						?>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">

									<br />
									<?php		
						
								?>
								</ul>
								<br />
								<ul class="section-tab-nav tab-nav">
									<!--<h4 class='title'>Sub Categories</h4>-->
									<br />

								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							<div id="tab1" class="tab-pane active">
								<div class="products-slick" data-nav="#slick-nav-1">

									<?php 

									$query4 = "SELECT *
											   FROM product
											   WHERE pro_Feat = '1'";
									$res4 = $database->get_results($query4);

										foreach ($res4 as $row) :
									?>

									<div class="product">
										<a href="product.php?id=<?=$row['pro_ID'];?>">
											<div class="product-img">
												<img src="/cit410/products/<?=$row['pro_ID'];?>_1.jpg" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"> <?= $row['cat_Name'];?></p>
												<h2 class="product-name"> <?= $row['pro_Manufacturer'];?></h3>
													<h3 class="product-name"> <?= $row['pro_Name'];?></h3>
													<h4 class="product-price">$ <?= $row['pro_Price'];?></h4>
													<div class="product-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													</div>
											</div>
										</a>

										<div class="add-to-cart">
											<button class="quick-add-cart pull-left" id="<?=$row['pro_ID'];?>">add cart</button>
											<button class="quick-view-btn"
												data-toggle="modal" data-target="#ajaxModal" data-id="<?=$row['pro_ID'];?>">quick
												view</button>
										</div>
									</div>
									<?php endforeach; ?>

								</div>
								<div id="slick-nav-1" class="products-slick-nav"></div>
							</div>
							<!-- /tab -->
						</div>
					</div>
				</div>
				<!-- Products tab & slick -->

				
											
				<!-- Modal -->
  					<div class="modal fade" id="ajaxModal" role="dialog">
  						<div class="modal-dialog">
  							<!-- Modal content-->
  							<div class="modal-content">
  								<div class="modal-header">
  									<h4 class="modal-title">Quick View</h4>
  									<button type="button" class="close" data-dismiss="modal">&times;</button>
  								</div>
  								<div class="entry-point">
  									<!-- ajaxModal.php content here -->
  								</div>
  							</div>
  						</div>
  					</div>
				<!-- End Modal -->

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
		</div>
		<!-- /SECTION -->

	
		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">	
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->
							
<?php 
require_once("footer.php"); 
?>
<script>
	$(document).ready(function() {

		$('#price-min').val('<?=$_GET['lowslide'] ?? 1;?>');
		$('#price-max').val('<?=$_GET['highslide'] ?? 6000;?>');
	});
</script>
