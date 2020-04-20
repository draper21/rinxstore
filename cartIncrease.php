<?php
require_once('config/config.php');
session_start();
$db = DB::getInstance();

$ProID = $_POST["product_id"];
//$CartID = $_SESSION['cartid'];  
     /**
     * Updating data
     */
    //Fields and values to update
    $update = array("cart_qty" => "cart_qty + 1");
    //Add the WHERE clauses
    //$where_clause = array('cart_ID' => 1, 'pro_ID' => 5 );
    $where_clause = array('cart_ID' => $CartID, 'pro_ID' => $ProID );
    $updated = $db->update( 'cart', $update, $where_clause, 1 );
    if( $updated )
    {
        echo '<p>Successfully updated '.$where_clause['pro_ID']. ' to '. $update['cart_qty'].'</p>';
    }
?>