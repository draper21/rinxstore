<?php
    require_once('config/config.php');
    $database = new DB();

    $product = $_SESSION['editID'];



    $query = "SELECT * FROM review WHERE pro_ID = $product";
    $reviews = $database->get_results($query);
    
    foreach($reviews as $review) :



    endforeach;

?>