<?php require_once("header.php");

$db = new DB();

//load customer information into variables
$query = "SELECT cus_FirstName, cus_LastName, cus_EMail, add_street, add_street2, add_City,
add_state, add_zip, car_Num, car_Name, car_Exp, car_Sec FROM customer c INNER JOIN address a
ON c.cus_ID = a.cus_ID INNER JOIN card d ON c.cus_ID = d.cus_ID WHERE c.cus_ID = $CusID";
list($firstname, $lastname, $email, $street, $street2, $city, $state, $zip, $cnum, $cname, $cexp, $csec) = $db->get_row($query);

//echo "First Name is " . $firstname . " " . $lastname;
?>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="first-name" placeholder="First Name" value="<?=$firstname?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name" value="<?=$lastname?>">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email" value="<?=$email?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="street" placeholder="Street" value="<?=$street?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="street2" placeholder="Street2" value="<?=$street2?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City" value="<?=$city?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="state" placeholder="State" value="<?=$state?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="ZIP Code" value="<?=$zip?>">
							</div>
							
						</div>
						<!-- /Billing Details -->

						<!-- Shiping Details -->
						<div class="shiping-details">
							<div class="section-title">
								<h3 class="title">Shipping address</h3>
							</div>
							<div class="input-checkbox">
								<input type="checkbox" id="shiping-address">
								<label for="shiping-address">
									<span></span>
									Ship to a diffrent address?
								</label>
								<div class="caption">
									<div class="form-group">
										<input class="input" type="text" name="first-name" placeholder="First Name">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="last-name" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input class="input" type="email" name="email" placeholder="Email">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="address" placeholder="Address">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="city" placeholder="City">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="country" placeholder="Country">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
									</div>
									<div class="form-group">
										<input class="input" type="tel" name="tel" placeholder="Telephone">
									</div>
								</div>
							</div>
						</div>
						<!-- /Shiping Details -->

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" placeholder="Order Notes"></textarea>
						</div>
						<!-- /Order notes -->
					</div>

<?php
  $db = DB::getInstance();
  $data = $db->get_results("select * from cart c, product p where c.pro_ID=p.pro_ID and cart_ID='$CartID'");
  //$CartID = $_SESSION['cartid'];  
                    
?>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
							<?php
                        //echo "Session ID = " . session_id() . "";
                      foreach ($data as $key=>$value)
                      {
						echo "<div class='order-col'>";
						echo "<div>Qty: ".$value['cart_qty']." - ".$value['pro_Name']."</div>";
						echo "<div>".$value['cart_qty']. " x ".$value['pro_Price']."</div>";
						echo "</div>";
					  }
					  
					  ?>
						
							</div>
							<div class="order-col">
								<div>Shipping (From 45619)</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								
					  		<div><strong class="order-total">
					  		<div class="cart-summary">
							  </div>
							  </div>

							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3" checked>
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Card Number: <?=$cnum?></p>
									<p>Name on Card: <?=$cname?></p>
									<p>Expiration: <?=$cexp?></p>
									<p>CVV: <?=$csec?></p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<!--<a href="#" class="primary-btn order-submit">Place order</a>-->
						<button class="primary-btn order-submit" id="placeorder">Place Order</button>
					</div>
					<!-- /Order Details -->
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

		<?php require_once("footer.php"); ?>
