<?php
    require_once('config/config.php');
    $database = new DB();

    $score = $_POST['score'];
    $detail = $_POST['detail'];
    $product = $_SESSION['proID'];
    //$customer = $_POST['customer'];
    //hard-coded for now
    $customer = "1";


    $review = array(
        'rev_Score' => $score,
        'rev_Detail' => $detail,
        'pro_ID' => $product,
        'cus_ID' => $customer
    );

    //print_r($review);

    //$query = "INSERT INTO review (rev_Score, rev_Detail, pro_ID, cus_ID) VALUES (?,?,?,?)";
    $add_query = $database->insert('review', $review);

    if( $add_query )
      {
        header("Location: product.php?id=$product");
        exit;
         // echo '<p>Successfully inserted &quot;'. $review['rev_Detail']. '&quot; into the database.</p>';
      }

?>