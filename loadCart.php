<?php
    require_once('config/config.php');
    session_start();
 
    $db = DB::getInstance();
 
    $exists = "SELECT EXISTS(SELECT * FROM cartopts WHERE cart_id = '$CartID')";
    $check = $db->get_row($exists);

  //  if ($check[0] == 1) {
  //    //echo "RECORD EXISTS! <br />";
  //    $query = "SELECT * from cart c JOIN product p ON c.pro_ID=p.pro_ID left outer join cartopts co on c.cart_ID=co.cart_ID and c.pro_ID=co.pro_ID left outer join prodopt po on co.opt_ID=po.opt_ID where c.cart_ID='$CartID'";
  //    $results = $db->get_results($query);
  //    //add option price to product price
  //  }
  
    // TOTAL PRICE OF PRODUCTS WITH OPTIONS (ADD TO PRODUCTS W/O OPTIONS)
    list($optiontotal) = $db->get_row("SELECT SUM((pro_Price + opt_Price) * cart_qty)  from cart c JOIN product p ON c.pro_ID=p.pro_ID left outer join cartopts co on c.cart_ID=co.cart_ID and c.pro_ID=co.pro_ID left outer join prodopt po on co.opt_ID=po.opt_ID where c.cart_ID='$CartID' and opt_Price IS NOT NULL");
    //echo $optiontotal;

    //TOTAL PRICE OF PRODUCTS WITHOUT OPTIONS 
    list($nooptiontotal) = $db->get_row("SELECT SUM(pro_Price * cart_qty)  from cart c JOIN product p ON c.pro_ID=p.pro_ID left outer join cartopts co on c.cart_ID=co.cart_ID and c.pro_ID=co.pro_ID left outer join prodopt po on co.opt_ID=po.opt_ID where c.cart_ID='$CartID' and opt_Price IS NULL");
    //echo $nooptiontotal;

    $carttotal = $optiontotal + $nooptiontotal;
    //echo $carttotal;

  
      //echo "RECORD DOES NOT EXIST! <br />";
      $query = "SELECT * from cart c, product p where c.pro_ID=p.pro_ID and cart_ID='$CartID'";
      $results = $db->get_results($query);

    //echo $check[0];
    //echo $CartID;

    //  list($subtotal) = $db->get_row("SELECT SUM(b.pro_Price * a.cart_qty) FROM cart a, product b Where a.pro_ID = b.pro_ID  AND a.cart_ID = '$CartID'");

      //echo "<h5>SUBTOTAL: $" . $subtotal . "</h5>";
      list($totalitems) = $db->get_row("SELECT SUM(cart_qty) FROM cart WHERE cart_ID = '$CartID'");
   
      $send = array(
         'cart_details' => $results,
         'total_price' => $carttotal,
         'total_items' => $totalitems
      );


    echo json_encode($send);

    ?>