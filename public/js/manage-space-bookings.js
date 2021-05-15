$(function () {

    function manage_list() {
        $.ajax({
            type: "GET",
            url: "../all_space_bookings",
            success: function (data) {
                var space_bookings = JSON.parse(data);

                for(var i = 0; i < space_bookings.length; i++) {
                    $("#" + space_bookings[i].id ).click(function(event) {
                        event.preventDefault();
                        swal({
                            title: "Are you sure?",
                            text: "Do you want to cancel this booking?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        }).then((willDelete) => {
                            if (willDelete) {
                                $(this).unbind('click').click();
                            }
                        });
                    });
                }
            }
        });
    }

    function manage_booking() {
        $("#cancel").click(function(event) {
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Do you want to cancel this booking?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $(this).unbind('click').click();
                }
            });
        });

        $("#check-in").click(function(event) {
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Do you want to check-in?",
                icon: "info",
                buttons: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $(this).unbind('click').click();
                }
            });
        });

        $("#check-out").click(function(event) {
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Do you want to check-out?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $(this).unbind('click').click();
                }
            });
        });
    }

    manage_list();
    manage_booking();
});