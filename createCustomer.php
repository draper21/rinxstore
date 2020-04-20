<?php require_once("header.php");

//$loggedin = 1;

?>
        
		
        <!-- SECTION -->
        <div class="section">
        	<!-- container -->
        	<div class="container">
        		<!-- row -->
        		<div class="row">

        			<div class="container my-5">
        				<div class="row">

        					<?php if ($loggedin == 1) : ?>
        					<!-- CREATE USER -->
        					<form name="regform" id="regform">
        						<div class="col-md-6 mx-auto">
        							<h4> User Information</h4>
        							<div class="form-group">
        								<input type="text" name="firstname" id="firstname" class="form-control"
        									placeholder="First Name" data-toggle="floatLabel" data-value="no-js">
        								<label for="firstname" generated="true">First Name</label>
        								<label for="firstname" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name"
        									data-toggle="floatLabel" data-value="no-js">
        								<label for="lastname" generated="true">Last Name</label>
        								<label for="lastname" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="password" name="password" id="password" class="form-control"
        									placeholder="Password" data-toggle="floatLabel" data-value="no-js">
        								<label for="password" generated="true">Password</label>
        								<label for="password" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="text" name="email" id="email" class="form-control" placeholder="Email"
        									data-toggle="floatLabel" data-value="no-js">
        								<label for="email" generated="true">Email</label>
        								<label for="email" generated="true" class="error"></label>
        							</div>
        						</div>

        						<div class="col-md-6 mx-auto">
        							<h4>Billing Information (Not Mandatory)</h4>
        							<div class="form-group">
        								<input type="number" name="cardnum" id="cardnum" class="form-control" placeholder="Card Number"
        									data-toggle="floatLabel" data-value="no-js">
        								<label for="cardnum" generated="true">Card Number</label>
        								<label for="cardnum" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="text" name="cardname" id="cardname" class="form-control"
        									placeholder="Name (as it appears on card)" data-toggle="floatLabel" data-value="no-js">
        								<label for="cardname" generated="true">Name (as it appears on card)</label>
        								<label for="cardname" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="text" name="cardexp" id="cardexp" class="form-control"
        									placeholder="Expiration Date" data-toggle="floatLabel" data-value="no-js">
        								<label for="cardexp" generated="true">Expiration Date</label>
        								<label for="cardexp" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="number" name="cardcvv" id="cardcvv" class="form-control"
        									placeholder="3 Digit Security Code (CVV)" data-toggle="floatLabel" data-value="no-js">
        								<label for="cardcvv" generated="true">3 Digit Security Code (CVV)</label>
        								<label for="cardcvv" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="text" name="street" id="street" class="form-control" placeholder="Street"
        									data-toggle="floatLabel" data-value="no-js">
        								<label for="street" generated="true">Street</label>
        								<label for="street" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="text" name="street2" id="street2" class="form-control" placeholder="Street 2"
        									data-toggle="floatLabel" data-value="no-js">
        								<label for="street2" generated="true">Street 2</label>
        								<label for="street2" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="text" name="city" id="city" class="form-control" placeholder="City"
        									data-toggle="floatLabel" data-value="no-js">
        								<label for="city" generated="true">City</label>
        								<label for="city" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="text" name="state" id="state" class="form-control" placeholder="State (Two-Digit)"
        									data-toggle="floatLabel" data-value="no-js">
        								<label for="state" generated="true">State (Two-Digit)</label>
        								<label for="state" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="text" name="zip" id="zip" class="form-control" placeholder="Zip Code"
        									data-toggle="floatLabel" data-value="no-js">
        								<label for="zip" generated="true">Zip Code</label>
        								<label for="zip" generated="true" class="error"></label>
        							</div>
									<div class="text-center mt-4" id="errordiv">
								<!--bootstrap alert danger to show red box with text -->
								<div class="alert alert-danger" style="width:50%;max-width:80%;">
									<span class="txt1">
										<p>Invalid Username and/or Password</p>
									</span>
								</div>
								</div>
        						</div>
								<div class="col text-center">
        								<button class="btn btn-primary" type="submit">Create User</button>
        							</div>
        					</form>
							
        					<!-- END CREATE USER -->
        					<?php endif; ?>

						</div>		

        				</div>
        			</div>

        		</div>
        		<!-- /row -->
        	</div>
        	<!-- /container -->
        </div>
        <!-- /SECTION -->
		<?php require_once("footer.php"); ?>