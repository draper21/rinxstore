<?php require_once('config/config.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Rinx - Store</title>

    <!-- Google font -->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700"
      rel="stylesheet"
    />

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="css/smoothproducts.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css" />

    <!-- Favicons -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
    <link rel="manifest" href="img/favicons/site.webmanifest">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<!-- CSS file -->
<link rel="stylesheet" href="css/easy-autocomplete.min.css">

<!-- Additional CSS Themes file - not required-->
<link rel="stylesheet" href="css/easy-autocomplete.themes.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- HEADER -->
    <header>
      <!-- TOP HEADER -->
      <div id="top-header">
        <div class="container">
          <ul class="header-links pull-left">
            <li>
              <a href="#"><i class="fa fa-phone"></i> 281-330-8004</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a>
            </li>
            <li>
              <a href="#"
                ><i class="fa fa-map-marker"></i> 316 Stonecoal Road</a
              >
            </li>
          </ul>
          <ul class="header-links pull-right">
           
            <li>
              <?php if ($loggedin == 0) : ?>
                  <a href="myAccount.php"><i class="fa fa-user-o"></i> My Account </a>
                  <a href="logout.php"><i class="fa fa-user-o"></i> Logout </a>
              <?php endif; ?>
              <?php if ($loggedin == 1) : ?>
                  <a href="myAccount.php"><i class="fa fa-user-o"></i>Login </a>
                  <a href="createCustomer.php"><i class="fa fa-user-o"></i> Create Account </a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
      <!-- /TOP HEADER -->

      <!-- MAIN HEADER -->
      <div id="header">
        <!-- container -->
        <div class="container">
          <!-- row -->
          <div class="row">
            <!-- LOGO -->
            <div class="col-md-3">
              <div class="header-logo">
                <a href="index.php" class="logo">
                  <img src="./img/rinxlogo.png" alt="" />
                </a>
              </div>
            </div>
            <!-- /LOGO -->
            <!-- SEARCH BAR -->
           
            <div class="col-md-6">
                <?php //only let search work on store.php
                  if (stripos($_SERVER['REQUEST_URI'], 'store.php')){ 
                    echo ' <div class="newsletter">
                            <form name="formsearch" id="formsearch">
                              <input class="input" type="text" name = "search" id="search" placeholder="Search here"/>
                                <button id="submit" type="submit" name="submit" class="newsletter-btn" style="display:inline;">Search</button>   
                                <ul class="list-group" id="result"></ul>        
                            </form>
                          </div>';
                }
                ?>
            </div>
                
            <!-- /SEARCH BAR -->
            <!-- ACCOUNT -->
            <div class="col-md-3 clearfix">
              <div class="header-ctn">
              
<?php
  //$db = DB::getInstance();
  //$data = $db->get_results("select * from cart c, product p where c.pro_ID=p.pro_ID and cart_ID=1");
?>

                <!-- Mini Cart -->
                <div class="dropdown">
                  <a
                    class="dropdown-toggle"
                    data-toggle="dropdown"
                    aria-expanded="true"
                  >
                    <i class="fa fa-shopping-cart"></i>
                    <span>Your Cart</span>
                    <div class="qty" id="miniqty"><?=$CartID;?></div>
                  </a>
                  <div class="cart-dropdown">
                    <div class="cart-list">

                   <!--CART DATA LOADED FROM LOADCART.PHP -->

                    </div>
                    <div class="cart-summary">
                    <!-- CART TPTAL CAN GO HERE -->
                    $
                    </div>

                    <div class="cart-btns">
                      <a href="cart.php">View Cart</a>
                      <a href="checkout.php"
                        >Checkout <i class="fa fa-arrow-circle-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
                <!-- /Cart -->

                <!-- Menu Toogle -->
                <div class="menu-toggle">
                  <a href="#">
                    <i class="fa fa-bars"></i>
                    <span>Menu</span>
                  </a>
                </div>
                <!-- /Menu Toogle -->
              </div>
            </div>
            <!-- /ACCOUNT -->
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
      <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
      <!-- container -->
      <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
          <!-- NAV -->
          <ul class="main-nav nav navbar-nav">
            <li><a href="index.php">Featured</a></li>
            <li><a href="store.php">Store</a></li>
          </ul>
          <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
      </div>
      <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->
  </body>
</html>