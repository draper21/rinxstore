<?php

//echo "inside config.php";
session_start();

$_SESSION['cartid'] = session_id();
$CartID = $_SESSION['cartid'];

if (!empty($_SESSION["cusID"])) {
	$loggedin = 0;
	$CusID = $_SESSION["cusID"];
}
else {
	$loggedin = 1;
}
//echo "cart id= " . $_SESSION['cartid'];


define( 'DB_HOST', 'cit.marshall.edu');
define( 'DB_USER', 'CIT485S20');
define( 'DB_PASS', 'cit485s20data1!');
define( 'DB_NAME', 'CIT485S20');
define( 'SEND_ERRORS_TO', 'draper9@marshall.edu');
define( 'DISPLAY_DEBUG', true);

function __autoload($classname) {
    $filename = "classes/". $classname ."_class.php";
    require_once($filename);
}

if (!empty($_GET))
	{
	  $category =  $_GET['id'];
	  $_SESSION['category'] = $_GET['id'];
	}
	 
if (empty($_GET))
	{
	  $category = NULL;
	}

function AllStars() {

	$product = $_SESSION['proID'];
	$database = new DB();
	$query = "SELECT * FROM review WHERE pro_ID = $product";
	$reviews = $database->get_results($query);
	//math for rating average
	//total reviews
	//$query1 = "SELECT count(rev_ID) AS TotalReviews FROM review WHERE pro_ID = $product";
	$query1 = "SELECT * FROM review WHERE pro_ID = $product";
	$count = $database->num_rows($query1);
	//avg of review scores
	$query2 = "SELECT avg(rev_Score) AS SumOfReviews FROM review WHERE Pro_ID = $product";
	$avg = $database->get_results($query2);
	$avg = $avg[0]['SumOfReviews'];

	if ($avg >= 0 && $avg < 0.5)
	{
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	// 0.5 to 1 - half a star
	if ($avg >= 0.5 && $avg < 1)
	{
		echo '<i class="fa fa-star-half-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	// 1 to 1.5 - 1 star
	if ($avg >= 1 && $avg < 1.5)
	{
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	// 1.5 to 2 - 1 and a half stars
	if ($avg >= 1.5 && $avg < 2)
	{
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star-half-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	// 2 to 2.5 - 2 stars
	if ($avg >= 2 && $avg < 2.5)
	{
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	// 2.5 to 3 - 2 and a half stars
	if ($avg >= 2.5 && $avg < 3)
	{
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star-half-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	// 3 to 3.5 - 3 stars
	if ($avg >= 3 && $avg < 3.5)
	{		
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	// 3.5 to 4 - 3 and a half stars
	if ($avg >= 3.5 && $avg < 4)
	{
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star-half-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	// 4 to 4.5 - 4 stars
	if ($avg >= 4 && $avg < 4.5)
	{
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	// 4.5 to 5 - 4 and a half stars
	if ($avg >= 4.5 && $avg < 5)
	{
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star-half-o" style="color:red"></i>';
	}
	// 5 stars
	if ($avg >= 5)
	{
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
		echo '<i class="fa fa-star"></i>';
	}
	echo ' out of ' . $count . ' reviews.';
}

function Reviews() {

	$product = $_SESSION['proID'];
	$database = new DB();
	$query = "SELECT * FROM review WHERE pro_ID = $product";
	$reviews = $database->get_results($query);
	//math for rating average
	//total reviews
	//$query1 = "SELECT count(rev_ID) AS TotalReviews FROM review WHERE pro_ID = $product";
	$query1 = "SELECT * FROM review WHERE pro_ID = $product";
	$count = $database->num_rows($query1);
	//avg of review scores
	$query2 = "SELECT avg(rev_Score) AS SumOfReviews FROM review WHERE Pro_ID = $product";
	$avg = $database->get_results($query2);
	$avg = $avg[0]['SumOfReviews'];
	echo '<br />';
	echo '<h3 class="product-price">'.$count . ' Reviews</h3>';
	echo '<br />';
	foreach($reviews as $review) :
		//echo $review['rev_Score'];
		$score = $review['rev_Score']; 
	if ($score == 0)
	{
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	
	// 1 to 1.5 - 1 star
	if ($score ==1)
	{
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	
	// 2 to 2.5 - 2 stars
	if ($score == 2)
	{
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	
	// 3 to 3.5 - 3 stars
	if ($score == 3)
	{		
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	
	// 4 to 4.5 - 4 stars
	if ($score == 4)
	{
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star-o" style="color:red"></i>';
	}
	
	// 5 stars
	if ($score >= 5)
	{
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star"style="color:red"></i>';
		echo '<i class="fa fa-star"style="color:red"></i>';
	}
		
		echo ' ' . $review['rev_Detail'];
		echo '<br />';

	endforeach;
}
?>
