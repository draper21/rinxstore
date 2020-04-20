<?php
require_once('config/config.php');
session_start();
$db = DB::getInstance();

$ProID = $_POST["product_id"];
//$CartID = $_SESSION['cartid'];  
    /**
     * Deleting data
     */
    //Run a query to delete rows from table where id = 3 and name = Awesome, LIMIT 1
    //$delete = array('pro_ID' => 4,);
    $delete = array(
        'pro_ID' => $ProID,
        'cart_ID' => $CartID
    );
    $deleted = $db->delete('cart', $delete, 1);
    if( $deleted )
    {
        echo '<p>Successfully deleted '.$delete['pro_ID'] .' from the cart table.</p>';
    }
    else {
        echo '<p>Unsuccessful deletion.  No matches for '.$delete['pro_ID'] .' found in the cart table.</p>';
    }

    $deletedopts = $db->delete('cartopts', $delete, 1);
    if( $deleted )
    {
        echo '<p>Successfully deleted '.$delete['pro_ID'] .' from the cartopts table.</p>';
    }
    else {
        echo '<p>Unsuccessful deletion.  No matches for '.$delete['pro_ID'] .' found in the cartopts table.</p>';
    }
?>