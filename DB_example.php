<?

    require_once("config/config.php");


    //Initiate the class
    $database = new DB();

    //OR...
    $database = DB::getInstance();

    /**
     * Filter all post data
     */
    $_POST['name'] = 'This database class is "super awesome" & whatnots';
    if( isset( $_POST ) )
    {
        foreach( $_POST as $key => $value )
        {
            $_POST[$key] = $database->filter( $value );
        }
    }
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    /**
     * Auto filter an entire array
     */
    $array = array(
        'name' => array( 'first' => '"Super awesome"' ),
        'email' => '%&&<stuff',
        'something_else' => "'single quotes are awesome'"
    );
    $array = $database->filter( $array );
    echo '<pre>';
    print_r($array);
    echo '</pre>';


    /**
     * Inserting data
     */
    //The fields and values to insert
    $names = array(
        'cus_FirstName' => "Jennifer",
        'cus_LastName' => "Morgan",
        'cus_EMail' => "jennifer.morgan@marshall.edu",
        'cus_Password' => "ILuvMyHusband"
    );

    // before inserting, check to see if the email exists
    //$query ="select * from customer where cus_EMail = 'jennifer.morgan@marshall.edu'";
    //$found = $database->num_rows($query);

    // or

    // before inserting, check to see if the email exists
    $found = $database->recordExists('customer', array('cus_EMail' => 'jennifer.morgan@marshall.edu'));

    if (!$found)
    {
      $add_query = $database->insert( 'customer', $names );
      if( $add_query )
      {
          echo '<p>Successfully inserted &quot;'. $names['cus_FirstName']. '&quot; into the database.</p>';
      }

      $last = $database->lastid();

      echo "Jennifer's record was inserted and given the PK (ID): " . $last . "<br />";
    }
    else {
      echo "Customer with that email address already exists";
    }

    /**
     * Insert multiple records in single query
     */
    //Field names
    $fields = array(
        'cus_FirstName',
        'cus_LastName',
        'cus_Email',
        'cus_Password'
    );
    //Values to insert
    $records = array(
        array(
           "Michael", "Morgan", "michaelbmorgan5@gmail.com", "whatever"
        ),
        array(
            "Alex", "Morgan", "alexlewismorgan5@gmail.com", "mypass"
        ),
        array(
            "Katie", "Morgan", "katienicolemorgan@gmail.com", "princess"
        ),
        array(
            "Larry", "Morgan", "lmorgan@gmail.com", "coach"
        )
    );

    $inserted = $database->insert_multi( 'customer', $fields, $records );
    if( $inserted )
    {
        echo '<p>'.$inserted .' records inserted</p>';
    }

    /**
     * Retrieve results of a standard query
     */
    $query = "SELECT * FROM customer";
    $results = $database->get_results( $query );
    foreach( $results as $row )
    {
      echo $row['cus_LastName'] . ", " . $row['cus_FirstName'] . " - " . $row['cus_EMail'] .'<br />';
    }

    /**
    * Same as above but returns JSON
    */
    $query = "SELECT * FROM customer";
    $results = $database->get_results( $query );
    $data = json_encode($results);

    // verify JSON
    echo "<pre>";
    print_r($data);

    // transform JSON back to PHP array
    $phparray = json_decode($data);
    print_r($phparray);
    echo "</pre>";


    /**
     * Retrieving a single row of data
     */
    $query = "SELECT * FROM customer WHERE cus_EMail LIKE '%morgan%'";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $id, $fname, $lname, $email, $password ) = $database->get_row( $query );
        echo "<p>With an ID of $id, $fname $lname has a password of $password</p>";
    }
    else
    {
        echo 'No results found for a person with email like &quot;morgan&quot;';
    }


    /**
     * Updating data
     */
    //Fields and values to update
    $update = array(
        'cus_FirstName' => "Jen",
        'cus_Password' => md5("realprincess")
    );
    //Add the WHERE clauses
    $where_clause = array(
        'cus_ID' => $last
    );
    $updated = $database->update( 'customer', $update, $where_clause, 1 );
    if( $updated )
    {
        echo '<p>Successfully updated '.$where_clause['cus_ID']. ' to '. $update['cus_FirstName'].'</p>';
    }

    /**
     * Deleting data
     */
    //Run a query to delete rows from table where id = 3 and name = Awesome, LIMIT 1
    $delete = array(
        'cus_ID' => 3,
        'cus_FirstName' => 'Jack'
    );
    $deleted = $database->delete('customer', $delete, 1);
    if( $deleted )
    {
        echo '<p>Successfully deleted '.$delete['cus_FirstName'] .' from the database.</p>';
    }
    else {
        echo '<p>Unsuccessful deletion.  No matches for '.$delete['cus_FirstName'] .' found in the database.</p>';
    }


    /**
     * Checking to see if a value exists
     */
    $check_column = 'cus_ID';
    $check_for = array( 'cus_LastName' => 'Morgan' );
    $exists = $database->exists( 'customer', $check_column,  $check_for );
    if( $exists )
    {
        echo '<p>Morgan DOES exist!</p>';
    }
    else
        echo "<p>Morgan doesn't exist.";


    /**
     * Checking to see if a table exists
     */
    if( !$database->table_exists( 'customer' ) )
    {
        //Run a table install, the table doesn't exist
    }


    /**
     * Truncating tables
     * Commented out intentionally (just in case!)
     */
    //Truncate a single table, no output display
    //$truncate = $database->truncate( array('example_phpmvc') );

    //Truncate multiple tables, display number of tables truncated
    //echo $database->truncate( array('example_phpmvc', 'my_other_table') );


    /**
     * List the fields in a table
     */
    $fields = $database->list_fields( "SELECT * FROM customer" );
    echo '<pre>';
    print_r( $fields );
    echo '</pre>';


    /**
     * Output the number of fields in a table
     */
    echo $database->num_fields( "SELECT * FROM customer" );


    /**
     * Display the number of queries performed by the class
     * Applies across multiple instances of the DB class
     */
    echo '<hr />' . $database->total_queries();
?>
