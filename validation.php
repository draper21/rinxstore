<?php
    require_once('config\config.php');
    $database = new DB();
	//elminate special characters
    //$email = mysqli_real_escape_string($database, $_POST['email']); 
    //$password = mysqli_real_escape_string($database, $_POST['password']);

    $email = $_POST['email']; 
    $password = $_POST['password'];
    
    //echo "Here";
    //echo $email;
    //echo $password;
	//Find the username and password fields from the table login where username and password = the user input
    $query = "SELECT cus_EMail, cus_Password, cus_ID FROM customer WHERE cus_EMail = '$email'";

    list($emaildb, $passworddb, $cusID) = $database->get_row($query);
    //echo $emaildb, $passworddb, $cusID;

		if (($emaildb == $email) && ($passworddb == $password))
		{
			$_SESSION["cusID"] = $cusID;
			echo "Success";
		}
		else 
		{
			echo "FAILURE";
			$_SESSION["cusID"] = "Failed";
		}
	?>