$(document).ready(function () {

    //get content for first dropdown - department
    $.ajax({
        url: "dropdown.php",
        method: "GET",
        dataType: "HTML",
        success: function (data) {
            $("#dropdownCategory").append(data);
        }
    });

    //when user selects department, populate second dropdown with equipment
    //for that specific department
    $("#dropdownCategory").change(function () {
        $.ajax({
            url: "dropdown2.php",
            method: "GET",
            data: {
                dropdown1: $(this).val().toLowerCase()
            },
            success: function (data) {
                $('#dropdownSubCategory').find('option').remove().end().append(data);

            }
        });
    });

});