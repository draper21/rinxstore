<?php
    require_once('config/config.php');
    $database = new DB();

    //customer
    $first = $_POST['firstname']; 
    $last = $_POST['lastname'];
    $email = $_POST['email']; 
    $password = $_POST['password'];
    //address
    $street = $_POST['street'];
    $street2 = $_POST['street2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    //billing
    $cardnum = $_POST['cardnum'];
    $cardname = $_POST['cardname'];
    $cardexp = $_POST['cardexp'];
    $cardcvv = $_POST['cardcvv'];
    $cardactive = "1";

    //customer
    $customer = array(
        'cus_FirstName' => $first,
        'cus_LastName' => $last,
        'cus_EMail' => $email,
        'cus_Password' => $password
    );
    
    // before inserting, check to see if the customer exists via unique email
    $found = $database->recordExists('customer', array('cus_EMail' => "$email"));

    if (!$found) {
    //customer
    $add_customer = $database->insert('customer', $customer);
    list($cusid) = $database->get_row("SELECT cus_ID FROM customer WHERE cus_EMail = '$email'");
    //echo "Cus ID: " . $cusid;

    //address - requires customer id
    $address = array(
        'add_Street' => $street,
        'add_Street2' => $street2,
        'add_City' => $city,
        'add_State' => $state,
        'add_Zip' => $zip,
        'cus_ID' => $cusid
    );
    //print_r($address);
    if (!empty($street)) {
    $add_address = $database->insert('address', $address);
    list($addid) = $database->get_row("SELECT add_ID FROM address WHERE cus_ID = '$cusid'");
    }
    //echo "Add ID: ". $addid;

    //billing - requries customer and address id
    $billing = array(
        'car_Num' => $cardnum,
        'car_Name' => $cardname,
        'car_Exp' => $cardexp,
        'car_Sec' => $cardcvv,
        'car_Active' => $cardactive,
        'add_ID' => $addid,
        'cus_ID' => $cusid
    );
    //print_r($billing);
    if (!empty($cardnum)) {
    $add_billing = $database->insert('card', $billing);
    }

    if( $add_customer )
      {
        echo "Success";

      }
    else {
        echo "Failure";
    }
}
else {
    echo "Exists";
}

?>