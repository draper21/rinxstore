<?php require_once("header.php");
	  require_once('config/config.php');
	  $database = new DB();
?>
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">
				<!-- aside Widget -->
				<div class="aside">
					<!--<h3 class="aside-title">Categories</h3>-->
					<div class="checkbox-filter">
						<h4>CATEGORY</h4>
						<?php		
							$query = "SELECT * FROM category WHERE cat_SubCat IS NULL ORDER BY cat_Name";
							$results = $database->get_results( $query );
							foreach( $results as $row ) {
								echo "<ul><a href=" . 'store.php' . '?id=' . $row['cat_ID'] . ">" . $row['cat_Name'] . "</a></ul>";
								echo "<br />";
							}
						?>
						<br>
						<h4>SUB CATEGORY</h4>
						<?php
							if (isset($category)) {
									$query2 = "SELECT * FROM category WHERE cat_SubCat=(SELECT cat_SubCat FROM category WHERE cat_ID=$category) OR cat_SubCat=$category ORDER BY cat_Name";
									$results2 = $database->get_results( $query2);	
										foreach ( $results2 as $row) {
										echo "<ul><a href=" . "store.php" . "?id=" . $row['cat_ID'] . ">" . $row['cat_Name'] . "</ul></a>";
										echo "<br />";
									}	
							}
						?>
					</div>
				</div>
				<!-- /aside Widget -->

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Price</h3>
					<div class="price-filter">
						<div id="price-slider"></div>
						<div class="input-number price-min">
							<input id="price-min" type="number">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
						<span>-</span>
						<div class="input-number price-max">
							<input id="price-max" type="number">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
					</div>
				</div>
				<!-- /aside Widget -->
				<div class="aside">
				<h3 class="aside-title">Brand</h3>
				<div class="checkbox-filter" id="checkfilter">
				<form class="brand" name="brand" id="brand">
				<?php
						$query = "SELECT DISTINCT pro_Manufacturer FROM product ORDER BY pro_Manufacturer";
						$results = $database->get_results( $query );
						foreach( $results as $row ) {
							//echo "<ul><a href=" . 'store.php' . '?id=' . $row['cat_ID'] . ">" . $row['cat_Name'] . "</a></ul>";
							//echo "<br />";
							echo '<div class="input-checkbox">';
							echo '<input type="checkbox" name="chbox[]" value="'.$row['pro_Manufacturer'].'" id="'.$row['pro_Manufacturer'].'">';
							echo '<label for="'.$row['pro_Manufacturer'].'">';
							echo '<span></span>';
							echo $row['pro_Manufacturer'];
							echo '</label>';
							echo '</div>';
						}
				?>
				</form>
				</div>
				</div>
				
			</div>
			<!-- /ASIDE -->

			<?php
	
				//pagination variables	
				//REFERENCE: https://www.youtube.com/watch?v=S0Getpg3l_A
				
				$limit =  6;
				$page = isset($_GET['page']) ? $_GET['page'] : 1;
				$start = ($page - 1) * $limit;


				// search through all categories
				if ($category == NULL) {
					$query = "SELECT * FROM product LIMIT $start, $limit";
					$products = $database->get_results($query);

					$query = "SELECT count(pro_ID) AS id FROM product";
					$prodCount = $database->get_results($query);
					

				}

				//search through a specific category
				if ($category != NULL) {

					$query = "SELECT *, category.cat_SubCat, category.cat_Name  
							  FROM product
							  INNER JOIN category ON product.cat_ID = category.cat_ID
							  WHERE category.cat_ID = $category OR category.cat_SubCat = $category 
							  LIMIT $start, $limit";
					$products = $database->get_results($query);

					$query = "SELECT count(pro_ID), category.cat_SubCat, category.cat_Name 
							  AS id 
							  FROM product
							  INNER JOIN category ON product.cat_ID = category.cat_ID
							  WHERE category.cat_ID = $category OR category.cat_SubCat = $category 
							  LIMIT $start, $limit";
					$prodCount = $database->get_results($query);	

				}
				$total = $prodCount[0]['id'];
				$pages = ceil( $total / $limit);
				$Previous = $page - 1;
				$Next = $page + 1;
			?>

			<!-- STORE --------------------------------------------------------------------------------------------------------------------------->
			<div id="store" class="col-md-9">
				<!-- store top filter -->
				<div class="store-filter clearfix">
					<div class="store-sort">
						<ul class="store-pagination">
							<li>
								<a href="store.php?page=<?= $Previous; ?>" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
								</a>
							</li>
							<?php for($i = 1; $i<= $pages; $i++) : ?>
							<li><a href="store.php?page=<?= $i; ?>"><?= $i; ?></a></li>
							<?php endfor; ?>
							<li>
								<a href="store.php?page=<?= $Next; ?>" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /store top filter -->
				<br>


				<!-- store products -->
				<div id="products">
				<?php foreach($products as $product) : 

					
				$dir = "C:/inetpub/wwwroot/cit410/products/". $product['pro_ID'] . "_";
				// Initialize filecount variavle 
				$filecount = 0; 
				$files2 = glob( $dir ."*" ); 
				  
				if( $files2 ) { 
					$filecount = count($files2); 
				} 
				?>
				
				<div class="col-md-4 col-xs-6" id="searchProduct">
					<div class="product">
						<a href="product.php?id=<?=$product['pro_ID'];?>">
							<div class="product-img">
								<img src="/cit410/products/<?=$product['pro_ID'];?>_1.jpg" alt="">
							</div>
							<div class="product-body">
								<p class="product-category"><?=$product['cat_Name'];?></p>
								<h2 class="product-name"><?=$product['pro_Manufacturer'];?></h3>
									<h3 class="product-name" style="overflow: hidden; white-space: nowrap;">
										<?=$product['pro_Name'];?></h3>
									<h4 class="product-price">$<?=$product['pro_Price'];?></h4>
									<div class="product-rating">
									<!--<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>-->
									</div>
							</div>
						</a>
						<div class="add-to-cart">
								<button class="quick-add-cart pull-left" id="<?=$product['pro_ID'];?>">add cart</button>
								<button class="quick-view-btn" data-toggle="modal" data-target="#ajaxModal" data-id="<?=$product['pro_ID'];?>">quick view</button>
						</div>



					</div>
				</div>
				
				<?php endforeach; ?>
				</div>

				<div class="clearfix visible-sm visible-xs"></div>
				<!-- /store products -->


				<!-- store bottom filter -->
				
				<!-- /store bottom filter -->

			</div>
			<!-- /STORE ------------------------------------------------------------------------------------------------------------------------------->

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

<?php require_once("footer.php"); ?>

<script>
	$(document).ready(function() {

		$('#price-min').val('<?=$_GET['lowslide'] ?? 1;?>');
		$('#price-max').val('<?=$_GET['highslide'] ?? 6000;?>');
	});
</script>