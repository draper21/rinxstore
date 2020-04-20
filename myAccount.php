<?php require_once("header.php");

echo "logged in = " . $loggedin . "<br>";
echo "Customer ID: " . $_SESSION["cusID"];
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
        					<!-- IF NOT LOGGED IN -->

        					<div class="col-md-6 mx-auto">
        						<h4>Customer Login</h4>
        						<form id="loginform" name="loginform">
        							<div class="form-group">
        								<input type="email" name="email" id="email" placeholder="Email"
        									class="form-control" data-toggle="floatLabel" data-value="no-js">
        								<label for="email" generated="true">Email</label>
        								<label for="email" generated="true" class="error"></label>
        							</div>
        							<div class="form-group">
        								<input type="password" name="password" id="password" placeholder="Password"
        									class="form-control" data-toggle="floatLabel" data-value="no-js">
        								<label for="password" generated="true">Password</label>
        								<label for="password" generated="true" class="error"></label>
        							</div>
        							<button class="btn btn-primary" type="submit">Login</button>
        							<div class="text-center mt-4" id="errordiv">
        								<!--bootstrap alert danger to show red box with text -->
        								<div class="alert alert-danger" style="width:50%;max-width:80%;">
        									<span class="txt1">
        										<p>Invalid Username and/or Password</p>
        									</span>
        								</div>
        							</div>
        						</form>
        					</div>

        					<!-- END LOGIN -->
        					<?php endif; ?>

							<?php if ($loggedin == 0) : ?>
								<div class="col-md-6 mx-auto col-centered">
								<h4><center>Customer Dashboard</center></h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
								sed do eiusmod tempor incididunt ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
								</p>
								</div>

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
