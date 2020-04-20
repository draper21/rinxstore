<?php
    require_once('config/config.php');
    $database = new DB();

	$slide1 = $_GET['lowslide'] ?? 1;
	$slide2 = $_GET['highslide'] ?? 6000;
	$cat = $_GET['cat'];
	$Manuf = $_GET['chbox'];
	$in =  "'" . implode ( "', '", $Manuf ) . "'";

    //pagination variables	
	//REFERENCE: https://www.youtube.com/watch?v=S0Getpg3l_A		
	$limit =  6;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
		
			//$query = "SELECT * FROM product LIMIT $start, $limit";
			// WHERE pro_Price BETWEEN $slide1 AND $slide2
			if ($cat == NULL && $Manuf != NULL) {
				$query = "SELECT * FROM product WHERE pro_Manufacturer IN ($in) AND pro_Price BETWEEN $slide1 AND $slide2 ORDER BY pro_Price LIMIT $start, $limit";
				$products = $database->get_results($query);
				$query = "SELECT count(pro_ID) AS id FROM product WHERE pro_Manufacturer IN ($in) AND pro_Price BETWEEN $slide1 AND $slide2 LIMIT $start, $limit";
				$prodCount = $database->get_results($query);
				}
			if ($cat == NULL && $Manuf == NULL) {
				$query = "SELECT * FROM product WHERE pro_Price BETWEEN $slide1 AND $slide2 ORDER BY pro_Price LIMIT $start, $limit";
				$products = $database->get_results($query);
				$query = "SELECT count(pro_ID) AS id FROM product WHERE pro_Price BETWEEN $slide1 AND $slide2 LIMIT $start, $limit";
				$prodCount = $database->get_results($query);
				}
			//query if category is null and checkboxes are null
			if ($cat != NULL && $Manuf == NULL) {
			$query = "SELECT *, category.cat_SubCat, category.cat_Name
					  FROM product INNER JOIN category ON product.cat_ID = category.cat_ID
					  WHERE (category.cat_ID = $cat or category.cat_Subcat = $cat)
					  AND (pro_Price BETWEEN $slide1 AND $slide2) 
					  LIMIT $start, $limit";
			$products = $database->get_results($query);
			$query = "SELECT count(pro_ID), category.cat_SubCat, category.cat_Name 
					  AS id FROM product
					  INNER JOIN category ON product.cat_ID = category.cat_ID
					  WHERE (category.cat_ID = $cat OR category.cat_SubCat = $cat)
					  AND (pro_Price BETWEEN $slide1 AND $slide2)
					  LIMIT $start, $limit";
			$prodCount = $database->get_results($query);
			}
			//query if category is not null and checkbox is not null
			if ($cat != NULL && $Manuf != NULL) {
				$query = "SELECT *, category.cat_SubCat, category.cat_Name
						  FROM product INNER JOIN category ON product.cat_ID = category.cat_ID
						  WHERE pro_Manufacturer IN ($in)						  
						  AND (category.cat_ID = $cat OR category.cat_Subcat = $cat)
						  AND (pro_Price BETWEEN $slide1 AND $slide2) 
						  LIMIT $start, $limit";
				$products = $database->get_results($query);
				$query = "SELECT count(pro_ID), category.cat_SubCat, category.cat_Name 
						  AS id FROM product
						  INNER JOIN category ON product.cat_ID = category.cat_ID
						  WHERE pro_Manufacturer IN ($in)
						  AND (category.cat_ID = $cat OR category.cat_SubCat = $cat)
						  AND (pro_Price BETWEEN $slide1 AND $slide2)
						  LIMIT $start, $limit";
				$prodCount = $database->get_results($query);
				}
				//echo $query;
				$total = $prodCount[0]['id'];
				$pages = ceil( $total / $limit);
				$Previous = $page - 1;
                $Next = $page + 1;
				
				echo '<br>';
				echo '<!-- store products -->';
				echo '<div id="products">';
					foreach($products as $product) :
						$dir = "C:/inetpub/wwwroot/cit410/products/". $product['pro_ID'] . "_";
						// Initialize filecount variavle 
						$filecount = 0; 
						$files2 = glob( $dir ."*" ); 

						if( $files2 ) { 
							$filecount = count($files2); 
						} 
						
				echo '<div class="col-md-4 col-xs-6" id="searchProduct">';
				echo '<div class="product">';
				echo '<a href="product.php?id='.$product['pro_ID'].'">';
				echo '<div class="product-img">';
				echo '<img src="/cit410/products/'.$product['pro_ID'].'_1.jpg" alt="">';
				echo '</div>';
				echo '<div class="product-body">';
				echo '<h2 class="product-name">'.$product['pro_Manufacturer'].'</h3>';
				echo '<h3 class="product-name">'.$product['pro_Name'].'</h3>'; //style="overflow: hidden; white-space: nowrap;"
				echo '<h4 class="product-price">$'.$product['pro_Price'].'</h4>';
				echo '</div>';
				echo '</a>';
				echo '<div class="add-to-cart">';
				echo '<button class="quick-add-cart pull-left" id="'.$product['pro_ID'].'"> add cart</button>';
			    echo '<button class="quick-view-btn pull-right" data-toggle="modal" data-target="#ajaxModal" data-id="'.$product['pro_ID'].'">quick view</button>';
				echo '</div>';
				

				echo '</div>';
				echo '</div>';
				endforeach;
				echo '</div>';
				echo '<div class="clearfix visible-sm visible-xs"></div>';
				//store products 
				//store bottom filter 
				//store bottom filter 


?>
<script>
$('#product-main-img').slick({
		infinite: true,
		speed: 300,
		dots: true,
		arrows: true,
		fade: false,
		asNavFor: '#product-imgs',
	});

	$('#product-imgs').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		centerMode: true,
		focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
		asNavFor: '#product-main-img',
		responsive: [{
			breakpoint: 991,
			settings: {
				vertical: false,
				arrows: false,
				dots: true,
			}
		}, ]
	});
</script>