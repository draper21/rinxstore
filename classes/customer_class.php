<?
  class customer
  {
    private $customerID;
    private $DB;

    function __construct()
    {
      $this->DB = DB::getInstance();
      $this->customerID = -1;
    }

    public function __sleep()
    {
      /****************
        serialize() checks if your class has a function with the magic name  __sleep(). If so,
        that function is executed prior to any serialization.  It can clean up the
        object and is supposed to return an array with the names of all variables of that object
        that should be serialized. If the method doesn't return anything then NULL is
        serialized and E_NOTICE is issued.
      ****************/

      return array('customerID');	// any other variables you add to the class go here
    }

    public function __wakeup()
    {
	     // reinstantiate a connection to the DB
      $this->DB = DB::getInstance();
    }

    public function setCustomerID($id)
    {
      $this->customerID = $id;
    }

    public function getAddresses()
    {
      // get all currently saved addresses for this customer
      $q = "select * from address where cus_ID=" . $this->customerID;
      // get our results from the database, store them in $results which is
      // an array of records
      // FIRST, make sure the user has addresses
    //  $verification = $this->link->recordExists("address", array('cus_ID' => $this->customerID));
    //  if ($verification)
        $data = $this->DB->get_results($q);

      return $data;
    }

    /**
    *  @param $addy array holding an address for insertion
    **/
    public function addAddress($addy)
    {
      $address['add_Street'] = $addy['street'];
      $address['add_Street2'] = $addy['street2'];
      $address['add_City'] = $addy['city'];
      $address['add_State'] = $addy['state'];
      $address['add_Zip'] = $addy['zip'];
      $address['cus_ID'] = $this->customerID;
      return $this->DB->insert("address", $address);
    }

  }
?>
