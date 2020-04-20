<?php
require_once('config/config.php');
session_start();
$db = DB::getInstance();


if (!empty($_GET))
{
	$product =  $_GET['id'];
	$_SESSION['proID'] = $_GET['id'];
}

$userid = $_POST['userid'];

$query = "SELECT * FROM product WHERE pro_ID = $userid"; 
list($proID, $proName, $proDescript, $proPrice, $proQty, $proManufacturer, $proModel, $catID, $proFeat, $proWeight) = $db->get_row($query);

$dir = "C:/inetpub/wwwroot/cit410/products/". $proID . "_";
// Initialize filecount variavle 
$filecount = 0; 
$files2 = glob( $dir ."*" ); 
  
if( $files2 ) { 
    $filecount = count($files2); 
} 
    

                           $output .= 
                                    '<div class="modal-body">
                                    <div class="row">
									<!-- Product details -->
									<div class="col-lg-12">

                                    <div class="col-md-12 col-md">	
						                <div class="sp-wrap">';
							        
								        for ($i = 1; $i <= $filecount; $i++) {
									        $output .= '<a href="/cit410/products/' . $proID. '_' . $i .'.jpg"><img src="/cit410/products/' . $proID. '_' . $i .'.jpg" alt=""></a>';
								        }
							       
					        $output .= '</div>
					                </div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="product-details">
											<h2 class="product-name">'.$proManufacturer.'</h2>
											<h2 class="product-name">'.$proName.'</h2>
											<div>

											</div>
											<div>
												<h3 class="product-price">$'.$proPrice.'</h3>
												<span class="product-available">'.$proQty.' In Stock</span>
											</div>
											<div class="product-rating">';
												//AllStars();
											$output .= '</div>
											<br>
											<br>
											<p>'.$proDescript.'</p>';
											
											$query2 = "SELECT * FROM prodopt WHERE pro_ID = $proID";
											$prodopts = $db->get_results($query2);
							
											$output .= '<form id="add_item">
												<div class="product-options">
												<label>
												Option
												<select class="input-select" id="option">
													<option value="0">No Option</option>';
												 foreach($prodopts as $prodopt) : 
													$output .= '<option value="'.$prodopt['opt_ID'].'">'.$prodopt['opt_Value'].'</option>';
												 endforeach; 
												$output .= '</select>
												</label>
												<input type="hidden" name="productsubmit" id="productsubmit" value="'.$proID.'"/>
												<div class="add-to-cart">
												<div class="qty-label">
													Qty
													<div class="input-number">
														<input type="number" id="quantitysubmit" name="quantitysubmit" value="1">
													</div>
												</div>
											</div>
											</div>
										</div>
									</div>
									<!-- /Product details -->
								</div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                          <button class="add-cart-modal pull-left" id="'.$proID.'" data-dismiss="modal">Add Cart</button>
                                          <a href="product.php?id='.$proID.'">
                                          <button class="quick-view-btn pull-right">Product Page</button>
                                          </a>
									  </div>
									  </form>';
									  

echo $output
?>
<script type="text/javascript" src="js/smoothproducts.min.js"></script>
		<script type="text/javascript">
		/* wait for images to load */
			$('.sp-wrap').smoothproducts();
		
		</script>