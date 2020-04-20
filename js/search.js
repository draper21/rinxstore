$(document).ready(function () {

  $("#formsearch").submit(function (event) {
    event.preventDefault();
    //alert('test');

    var output = "";
    $.ajax({
      url: "searchResults.php",
      method: "POST",
      data: {
        search: $("#search").val()
      },
      dataType: "json",
      success: function (data) {

        $.each(data, function (index, element) {

          output += '<div class="col-md-4 col-xs-6" id="searchProduct">';
          output += '<div class="product">';
          output += '<a href="product.php?id=' + element.proID + '">';
          output += '<div class="product-img">';
          output +=
            '<img src="/cit410/products/' + element.proID + '_1.jpg" alt="">';
          output += "</div>";
          output += '<div class="product-body">';
          output += '<h2 class="product-name"> ' + element.proManu + "</h3>";
          output += '<h3 class="product-name"> ' + element.proName + "</h3>";
          output += '<h4 class="product-price">$ ' + element.proPrice + "</h4>";
          output += '<div class="product-rating">';
          output += '<i class="fa fa-star"></i>';
          output += '<i class="fa fa-star"></i>';
          output += '<i class="fa fa-star"></i>';
          output += '<i class="fa fa-star"></i>';
          output += '<i class="fa fa-star"></i>';
          output += "</div>";
          output += "</div>";
          output += "</a>";
          output += '<div class="add-to-cart">';
          output += '<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>';
          output += "</div>";
          output += "</div>";
          output += "</div>";
        });
        $("#products").empty().html(output);
      }
    });
  });

  //http://easyautocomplete.com/ - jquery AJAX plugin for live search
  var options = {
    url: "searchResults.php",
    getValue: function (element) {
      return element.proName;
    },

    list: {
      match: {
        enabled: true
      },
      onClickEvent: function () {
        //alert('hi jack');
        $("#search").submit();
      },
      onKeyEnterEvent: function () {
        //alert('hi jack');
        $("#search").submit();
      },
    },
    theme: "square"
  };
  $("#search").easyAutocomplete(options);
});