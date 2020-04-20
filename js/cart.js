$(document).ready(function () {
  //--------------
  load_cart_data();

  function load_cart_data() {
    var output = "";

    $.ajax({
      url: "loadCart.php",
      method: "POST",
      dataType: "json",
      success: function (data) {
        $.each(data.cart_details, function (index, element) {
          output += "<div class='product-widget'>";
          output += "<div class='product-img'>";
          output +=
            "<img src='/cit410/products/" +
            element.pro_ID +
            "_1.jpg' alt='' />";
          output += "</div>";
          output += "<div class='product-body'>";
          output += "<h3 class='product-name'>";
          output += element.pro_Name;
          output += "</h3>";
          output += "<h4 class='product-price'>";
          output +=
            "<span class='qty'>Qty: " +
            element.cart_qty +
            " x</span>$" +
            element.pro_Price +
            "";
          output += "</h4>";
          output += "</div>";
          output +=
            "<button name='delete' class='delete' id='" + element.pro_ID + "'>";
          output += "<i class='fa fa-close'></i>";
          output += "</button>";
          output +=
            "<button name='addqty' class='addqty' id='" + element.pro_ID + "'>";
          output += "<i class='fa fa-plus-square'></i>";
          output += "</button>";
          output +=
            "<button name='subtract'class='subtract' id='" +
            element.pro_ID +
            "'>";
          output += "<i class='fa fa-minus-square'></i>";
          output += "</button>";
          output += "</div>";
        });
        output +=
          "<div class='order-col'><div><strong>TOTAL</strong></div><div><strong class='order-total'>$" +
          data.total_price +
          "</strong></div></div></div>";
        $("#loadcartid").empty().html(output);
        $(".cart-list").html(output);
        $("#miniqty").html(data.total_items);
        $(".cart-summary").html("TOTAL: $" + data.total_price);
      },
    });
  }

  //referenced https://stackoverflow.com/questions/18196185/jquery-click-event-doesnt-work-after-append-dont-know-how-to-use-on/18196235
  //$('#selector-to-thing-that-exists').on('click', '.thing-that-will-be-added-later', function() {
  //  alert('Do stuff here!');
  //});

  //delete from mini cart
  $(".cart-list").on("click", ".delete", function () {
    var product_id = $(this).attr("id");
    //alert(product_id);
    if (confirm("Are you sure you want to remove this product?")) {
      $.ajax({
        url: "cartDelete.php",
        method: "POST",
        data: {
          product_id: product_id
        },
        success: function () {
          load_cart_data();
          //alert("Item has been removed from Cart");
        },
      });
    } else {
      return false;
    }
  });

  //delete from main cart
  $(".order-products").on("click", ".delete", function () {
    var product_id = $(this).attr("id");
    //alert(product_id);
    if (confirm("Are you sure you want to remove this product?")) {
      $.ajax({
        url: "cartDelete.php",
        method: "POST",
        data: {
          product_id: product_id
        },
        success: function () {
          load_cart_data();
          //alert("Item has been removed from Cart");
        },
      });
    } else {
      return false;
    }
  });

  //add to quantity on mini cart
  $(".cart-list").on("click", ".addqty", function () {
    var product_id = $(this).attr("id");
    //alert(product_id);
    $.ajax({
      url: "cartIncrease.php",
      method: "POST",
      data: {
        product_id: product_id
      },
      success: function () {
        load_cart_data();
        //alert("Item has been removed from Cart");
      },
    });
  });

  //add to quantity on main cart
  $(".order-products").on("click", ".addqty", function () {
    var product_id = $(this).attr("id");
    //alert(product_id);
    $.ajax({
      url: "cartIncrease.php",
      method: "POST",
      data: {
        product_id: product_id
      },
      success: function () {
        load_cart_data();
        //alert("Item has been removed from Cart");
      },
    });
  });

  //subtract from quantity on minicart
  $(".cart-list").on("click", ".subtract", function () {
    var product_id = $(this).attr("id");
    //alert(product_id);
    $.ajax({
      url: "cartSubtract.php",
      method: "POST",
      data: {
        product_id: product_id
      },
      success: function () {
        load_cart_data();
        //alert("Item has been removed from Cart");
      },
    });
  });

  //subtract from quantity on main cart
  $(".order-products").on("click", ".subtract", function () {
    var product_id = $(this).attr("id");
    //alert(product_id);
    $.ajax({
      url: "cartSubtract.php",
      method: "POST",
      data: {
        product_id: product_id
      },
      success: function () {
        load_cart_data();
        //alert("Item has been removed from Cart");
      },
    });
  });

  //form submit for modal/product page with options and quantity
  $('#add_item').submit(function (event) {
    event.preventDefault();
    //alert("add to cart was clicked");
    var product_id = $(this).attr("id");
    $.ajax({
      url: "cartAdd.php",
      method: "POST",
      data: {
        option: $('#option').val(),
        productsubmit: $('#productsubmit').val(),
        quantitysubmit: $('#quantitysubmit').val(),
        product_id: product_id
      },
      success: function (data) {
        load_cart_data();
        alert("Item has been Added into Cart");
      },
    });
  });

  //add to cart from modal
  $(".container").on("click", ".add-cart-modal", function (event) {
    event.preventDefault();
    //alert("add to cart was clicked");
    var product_id = $(this).attr("id");
    $.ajax({
      url: "cartAdd.php",
      method: "POST",
      data: {
        option: $('#option').val(),
        productsubmit: $('#productsubmit').val(),
        quantitysubmit: $('#quantitysubmit').val(),
        product_id: product_id
      },
      success: function (data) {
        load_cart_data();
        alert("Item has been Added into Cart");
      },
    });
  });

  //add to cart from thumbnail
  $(".container").on("click", ".quick-add-cart", function (event) {
    event.preventDefault();
    //alert("add to cart was clicked");
    var product_id = $(this).attr("id");
    $.ajax({
      url: "cartQuickAdd.php",
      method: "POST",
      data: {
        product_id: product_id
      },
      success: function (data) {
        load_cart_data();
        alert("Item has been Added into Cart");
      },
    });
  });



  $("#placeorder").click(function () {
    alert("Place order was clicked");
  });
});