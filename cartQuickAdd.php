<?php
require_once('config/config.php');
session_start();
$db = DB::getInstance();

$ProID = $_POST["product_id"];
//$CartID = $_SESSION['cartid'];     
 /**
     * Inserting data
     */
    //The fields and values to insert
    $item = array(
        'cart_ID' => "$CartID",
        'pro_ID' => "$ProID",
        'cart_qty' => "1"
    );

    // before inserting, check to see if the email exists
    //$query ="select * from customer where cus_EMail = 'jennifer.morgan@marshall.edu'";
    //$found = $database->num_rows($query);

    // or

    // before inserting, check to see if the product exists
    $found = $db->recordExists('cart', array('pro_ID' => "$ProID", 'cart_ID' => "$CartID"));

    //if product doesnt exist in cart, add
    if (!$found)
    {
      $add_query = $db->insert( 'cart', $item );
      if( $add_query )
      {
          echo '<p>Successfully inserted &quot;'. $item['pro_ID']. '&quot; into the db.</p>';
      }

      $last = $db->lastid();

      echo "record was inserted and given the PK (ID): " . $last . "<br />";
    }
    else {
        //increment instead
        echo "Product with that ID already exists, incrementing instead";
        $update = array("cart_qty" => "cart_qty + 1");
        $where_clause = array('cart_ID' => $CartID, 'pro_ID' => $ProID );
        $updated = $db->update( 'cart', $update, $where_clause, 1 );
        if( $updated )
        {
            echo '<p>Successfully updated '.$where_clause['pro_ID']. ' to '. $update['cart_qty'].'</p>';
        }
    }

    
?>