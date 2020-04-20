<?php
  class cart
  {
    private $database;

    public function getCart()
    {
          $q = "select * from product, cart where product.pro_ID=cart.pro_ID and cart_ID='" . session_id() . "'";
          $products = $this->database->get_results($q);

          return $products;


    }

    public function getJSONCart()
    {
          $q = "select pro_ID ID, cart_qty QTY from cart where cart_ID='" . session_id() . "'";
          $cart['products'] = $this->database->get_results($q);
          $cart['status'] = "Success";
          return json_encode($cart);
    }

    public function __construct()
    {
        $this->database = DB::getInstance();
    }

    public function processAddition($prodID)
    {
      // Check to see if the product already exists in the user’s cart
      // a.	IF NOT, addItem($prodID)
      //If so, incrementQuantity($prodID)

      // TEST INCREMENT!!!!!
      $this->incrementQuantity($prodID);

    }
    public function incrementQuantity($prodID)
    {
      // update the quantity for the product passed as a parameter for the current cart
      $update = array( 'cart_qty' => "cart_qty + 1" );
      $update_where = array( 'cart_ID' => session_id(), 'pro_ID' => $prodID );
      $this->database->update( 'cart', $update, $update_where, 1 );
    }

    public function addItem($prodID)
    {
      // update the quantity for the product passed as a parameter for the current cart
      $user_data = array(
            'cart_ID' => session_id(),
            'pro_ID' => $prodID,
            'cart_qty' => 1
       );
      $this->database->insert( cart, $user_data );
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

      return array('');	// any other variables you add to the class go here
    }

    public function __wakeup()
    {
       // reinstantiate a connection to the DB
      $this->database = DB::getInstance();
    }
  }
?>
