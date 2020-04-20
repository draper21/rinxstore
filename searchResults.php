<?php
	 require_once('config/config.php');
    $search =  $_POST['search'] ?? $_GET['search'];
    $database = new DB();

    //WORKING QUERY//
    //main categories do not work yet...they are empty in SQL

    /* $query = "select cat_ID from category where cat_Name LIKE '%".$search ."%'";
    $results = $database->get_results($query);
    foreach ($results as $result)
      $inList[] = $result['cat_ID']; */
    
    /* $inImploded = implode(",", $inList);
    $query = "select cat_ID from category where cat_SubCat IN ($inImploded)";
    $results = $database->get_results($query);
    foreach ($results as $result)
       $inList[] = $result['cat_ID'];
      
    $inImploded = implode(",", $inList); */
        
    $query = "SELECT DISTINCT pro_ID, pro_Name, pro_Descript, pro_Price, pro_Qty, pro_Manufacturer, pro_Model, product.cat_ID, pro_Feat, pro_Weight, category.cat_Name
    FROM product INNER JOIN category ON product.cat_ID = category.cat_ID
    WHERE (category.cat_Name LIKE '%".$search."%')
    OR pro_Manufacturer LIKE '%".$search."%' 
    OR pro_Name LIKE '%".$search."%' 
    OR pro_Price LIKE '%".$search."%'
    LIMIT 99";

    //OR product.cat_ID IN ('$inImploded')";

	  $results = $database->get_results($query);

    $array = [];


      foreach ($results as $result) :
        $array = array(
            'proID' => $result['pro_ID'],
            'proName' => $result['pro_Name'],
            'proDesc' => $result['pro_Descript'],
            'proPrice' => $result['pro_Price'],
            'proQty' => $result['pro_Qty'],
            'proManu' => $result['pro_Manufacturer'],
            'proModel' => $result['pro_Model'],
            'catID' => $result['product.cat_ID'],
            'proFeat' => $result['pro_Feat'],
            'proWeight' => $result['pro_Weight'],
            'catName' => $result['cat_Name']
        );

      $data[] = $array;
   
      endforeach;

     echo json_encode($data);
     exit();

	?> 