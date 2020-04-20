$(document).ready(function () {

    $('[data-toggle="floatLabel"]').attr('data-value', $(this).val()).on('keyup change', function () {
        $(this).attr('data-value', $(this).val());
    });

    $("#regform").validate({
        // Specify validation rules
        rules: {
            firstname: {
                required: true,
            },
            lastname: {
                required: true,
            },
            password: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true
            },
            cardnum: {
                required: false,
                minlength: 16,
                maxlength: 16

            },
            cardname: {
                required: false,
            },
            cardexp: {
                required: false,
            },
            cardcvv: {
                required: false,
                minlength: 3,
                maxlength: 3
            },
            street: {
                required: false,
            },
            city: {
                required: false,
            },
            state: {
                required: false,
                minlength: 2,
                maxlength: 2
            },
            zip: {
                required: false,
                minlength: 5
            }
        },
        // Specify validation error messages
        messages: {
            firstname: {
                required: "Please enter a first name"
            },
            lastname: {
                required: "Please enter a last name"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            email: "Please enter a valid email address",
            cardnum: {
                required: "Please enter your card number",
                minlength: "Your card number must be 16 digits",
                maxlength: "Your card number must be 16 digits"
            },
            cardname: {
                required: "Please enter your name as it appears on the card"
            },
            cardexp: {
                required: "Please enter your card's exipiration date"
            },
            cardcvv: {
                required: "Please enter your cards 3 digit security code",
                minlength: "Your card number must be 3 digits",
                maxlength: "Your card number must be 3 digits"
            },
            street: {
                required: "Please enter your street address"
            },
            city: {
                required: "Please enter your city name"
            },
            zip: {
                required: "Please provide a Zip Code",
                minlength: "Your Zip Code must be at least 5 characters long"
            }
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid

    });
    $('#regform').submit(function (event) {
        event.preventDefault();
        alert('reg form submitted');
        $.ajax({ //send to validation.php for validation
            url: "addCustomer.php",
            method: "POST",
            data: {
                'firstname': $('#firstname').val(),
                'lastname': $('#lastname').val(),
                'email': $('#email').val(),
                'password': $('#password').val(),
                'street': $('#street').val(),
                'street2': $('#street2').val(),
                'city': $('#city').val(),
                'state': $('#state').val(),
                'zip': $('#zip').val(),
                'cardnum': $('#cardnum').val(),
                'cardname': $('#cardname').val(),
                'cardexp': $('#cardexp').val(),
                'cardcvv': $('#cardcvv').val()
            },
            dataType: 'HTML',
            success: function (data) {
                if (data == "Success") {
                    alert("success");
                    window.location.href = "myAccount.php";
                } else if (data == "Exists") {
                    alert("A customer with that email already exists.");
                    //$('#email').val('');
                    //$('#password').val('');
                    //$('#firstname').val('');
                    //$('#lastname').val('');
                    //window.location.href = "drawEDIT.php";
                } else {
                    alert("error creating customer");
                    //show error div and clear username/password
                    //$('#email').val('');
                    //$('#password').val('');
                    //$('#firstname').val('');
                    //$('#lastname').val('');
                    //$('#errordiv').delay(500).fadeIn();
                }
            }
        });
    });


    $("#loginform").validate({

        // Specify validation rules
        rules: {
            email: {
                required: true,
                // Specify that email should be validated
                // by the built-in "email" rule
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        // Specify validation error messages
        messages: {
            firstname: "Please enter your first name",
            lastname: "Please enter your last name",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            email: "Please enter a valid email address"
        },


    });
    $('#loginform').submit(function (event) {
        event.preventDefault();
        //$("#loginform").validate();
        //alert('login form submitted');
        $.ajax({ //send to validation.php for validation
            url: "validation.php",
            method: "POST",
            data: {
                'email': $('#email').val(),
                'password': $('#password').val()
            },
            dataType: 'HTML',
            success: function (data) {
                if (data == "Success") {
                    alert("success");
                    window.location.href = "myAccount.php";
                }
                //if (data == "Admin") {
                //    //alert("admin");
                //    window.location.href = "drawEDIT.php";
                //} 
                else {
                    //alert("invalid username/password");
                    //show error div and clear username/password
                    $('#email').val('');
                    $('#password').val('');
                    $('#errordiv').delay(500).fadeIn();
                }
            }
        });

    });



});