$(document).ready(function () {

    //$('.ajaxmodal').click(function () {
    $(".container").on("click", ".quick-view-btn", function () {

        var userid = $(this).data('id');
        var output = "";
        // AJAX request
        $.ajax({
            url: 'ajaxModal.php',
            type: 'POST',
            data: {
                userid: userid
            },
            success: function (data) {

                // Display Modal
                $('.entry-point').html(data);
                $('#ajaxModal').modal('show');
            }
        });

    });
});