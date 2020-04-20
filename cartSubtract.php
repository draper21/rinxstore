<?php
require_once('config/config.php');
session_start();
$db = DB::getInstance();

$ProID = $_POST["product_id"];
//$CartID = $_SESSION['cartid'];  
     /**
     * Updating data
     */

    //before subtracting, check to see if product is 1
    //if quantity is 1, do not allow user to subtract
    $found = $db->recordExists('cart', array('pro_ID' => "$ProID", 'cart_ID' => "$CartID", 'cart_qty' => 1));

    if (!$found)
    {
        //Fields and values to update
        $update = array("cart_qty" => "cart_qty - 1");
        //Add the WHERE clauses
        //$where_clause = array('cart_ID' => 1, 'pro_ID' => 5 );
        $where_clause = array('cart_ID' => $CartID, 'pro_ID' => $ProID );
        $updated = $db->update( 'cart', $update, $where_clause, 1 );
        if( $updated )
        {
            echo '<p>Successfully updated '.$where_clause['pro_ID']. ' to '. $update['cart_qty'].'</p>';
        }
    }
    else {
        echo "Cannot have a product below 1 quantity, delete instead.";
        $delete = array(
            'pro_ID' => $ProID,
            'cart_ID' => $CartID
        );
        $deleted = $db->delete('cart', $delete, 1);
        
        if( $deleted )
        {
            echo '<p>Successfully deleted '.$delete['pro_ID'] .' from the database.</p>';
        }
        else {
            echo '<p>Unsuccessful deletion.  No matches for '.$delete['pro_ID'] .' found in the database.</p>';
        }

        $deletedopts = $db->delete('cartopts', $delete, 1);
        
        if( $deleted )
        {
            echo '<p>Successfully deleted '.$delete['pro_ID'] .' from the cartopts table.</p>';
        }
        else {
            echo '<p>Unsuccessful deletion.  No matches for '.$delete['pro_ID'] .' found in the cartopts table.</p>';
        }
    }
?>