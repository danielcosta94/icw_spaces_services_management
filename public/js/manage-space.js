$(document).ready(function() {
    var has_prices = false;
    var has_timetable = false;

    function manage_separators() {
        var navListItems = $('ul.setup-panel li a'),
            allWells = $('.setup-content');

        allWells.hide();

        navListItems.click(function(e)
        {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this).closest('li');

            if (!$item.hasClass('disabled')) {
                navListItems.closest('li').removeClass('active');
                $item.addClass('active');
                allWells.hide();
                $target.show();
            }
        });

        $('ul.setup-panel li.active a').trigger('click');
    }

    function manage_prices() {
        $("#price_hour").change(function() {
            has_prices = this.value != "" && price_hour_check.checked == true;
        });

        $("#price_hour_check").change(function() {
            has_prices = price_hour.value != "" && this.checked == true;
        });

        $("#price_day").change(function() {
            has_prices = this.value != "" && price_day_check.checked == true;
        });

        $("#price_day_check").change(function() {
            has_prices = price_day.value != "" && this.checked == true;
        });

        $("#price_week").change(function() {
            has_prices = this.value != "" && price_week_check.checked == true;
        });

        $("#price_week_check").change(function() {
            has_prices = price_week.value != "" && this.checked == true;
        });

        $("#price_month").change(function() {
            has_prices = this.value != "" && price_month_check.checked == true;
        });

        $("#price_month_check").change(function() {
            has_prices = price_month.value != "" && this.checked == true;
        });
    }

    function manage_timetable() {
        $('#monday_opening_hour').on('change', function(e) {
            var monday_opening_hour = document.getElementById("monday_opening_hour");
            var monday_closing_hour = document.getElementById("monday_closing_hour");

            try {
                $monday_opening_hour_int = parseInt(monday_opening_hour.value);
                $monday_closing_hour_int = parseInt(monday_closing_hour.value);

                if($monday_opening_hour_int < 0 || $monday_closing_hour_int > 23) {
                    monday_opening_hour.value = 0;
                }

                if($monday_opening_hour_int > $monday_closing_hour_int) {
                    monday_closing_hour.value = monday_opening_hour.value;
                }
            }catch (exception){
            }
        });

        $('#monday_closing_hour').on('change', function(e) {
            var monday_closing_hour = document.getElementById("monday_closing_hour");
            var monday_opening_hour = document.getElementById("monday_opening_hour");


            try {
                $monday_opening_hour_int = parseInt(monday_opening_hour.value);
                $monday_closing_hour_int = parseInt(monday_closing_hour.value);

                if($monday_closing_hour_int < 0 || $monday_closing_hour_int > 23) {
                    monday_closing_hour.value = 23;
                }

                if($monday_closing_hour_int < $monday_opening_hour_int) {
                    monday_opening_hour.value = monday_closing_hour.value;
                }
            }catch (exception){
            }
        });

        $('#tuesday_opening_hour').on('change', function(e) {
            var tuesday_opening_hour = document.getElementById("tuesday_opening_hour");
            var tuesday_closing_hour = document.getElementById("tuesday_closing_hour");

            try {
                $tuesday_opening_hour_int = parseInt(tuesday_opening_hour.value);
                $tuesday_closing_hour_int = parseInt(tuesday_closing_hour.value);

                if($tuesday_opening_hour_int < 0 || $tuesday_closing_hour_int > 23) {
                    tuesday_opening_hour.value = 0;
                }

                if($tuesday_opening_hour_int > $tuesday_closing_hour_int) {
                    tuesday_closing_hour.value = tuesday_opening_hour.value;
                }
            }catch (exception){
            }
        });

        $('#tuesday_closing_hour').on('change', function(e) {
            var tuesday_closing_hour = document.getElementById("tuesday_closing_hour");
            var tuesday_opening_hour = document.getElementById("tuesday_opening_hour");


            try {
                $tuesday_opening_hour_int = parseInt(tuesday_opening_hour.value);
                $tuesday_closing_hour_int = parseInt(tuesday_closing_hour.value);

                if($tuesday_closing_hour_int < 0 || $tuesday_closing_hour_int > 23) {
                    tuesday_closing_hour.value = 23;
                }

                if($tuesday_closing_hour_int < $tuesday_opening_hour_int) {
                    tuesday_opening_hour.value = tuesday_closing_hour.value;
                }
            }catch (exception){
            }
        });


        $('#wednesday_opening_hour').on('change', function(e) {
            var wednesday_opening_hour = document.getElementById("wednesday_opening_hour");
            var wednesday_closing_hour = document.getElementById("wednesday_closing_hour");

            try {
                $wednesday_opening_hour_int = parseInt(wednesday_opening_hour.value);
                $wednesday_closing_hour_int = parseInt(wednesday_closing_hour.value);

                if($wednesday_opening_hour_int < 0 || $wednesday_closing_hour_int > 23) {
                    wednesday_opening_hour.value = 0;
                }

                if($wednesday_opening_hour_int > $wednesday_closing_hour_int) {
                    wednesday_closing_hour.value = wednesday_opening_hour.value;
                }
            }catch (exception){
            }
        });

        $('#wednesday_closing_hour').on('change', function(e) {
            var wednesday_closing_hour = document.getElementById("wednesday_closing_hour");
            var wednesday_opening_hour = document.getElementById("wednesday_opening_hour");


            try {
                $wednesday_opening_hour_int = parseInt(wednesday_opening_hour.value);
                $wednesday_closing_hour_int = parseInt(wednesday_closing_hour.value);

                if($wednesday_closing_hour_int < 0 || $wednesday_closing_hour_int > 23) {
                    wednesday_closing_hour.value = 23;
                }

                if($wednesday_closing_hour_int < $wednesday_opening_hour_int) {
                    wednesday_opening_hour.value = wednesday_closing_hour.value;
                }
            }catch (exception){
            }
        });

        $('#thursday_opening_hour').on('change', function(e) {
            var thursday_opening_hour = document.getElementById("thursday_opening_hour");
            var thursday_closing_hour = document.getElementById("thursday_closing_hour");

            try {
                $thursday_opening_hour_int = parseInt(thursday_opening_hour.value);
                $thursday_closing_hour_int = parseInt(thursday_closing_hour.value);

                if($thursday_opening_hour_int < 0 || $thursday_closing_hour_int > 23) {
                    thursday_opening_hour.value = 0;
                }

                if($thursday_opening_hour_int > $thursday_closing_hour_int) {
                    thursday_closing_hour.value = thursday_opening_hour.value;
                }
            }catch (exception){
            }
        });

        $('#thursday_closing_hour').on('change', function(e) {
            var thursday_closing_hour = document.getElementById("thursday_closing_hour");
            var thursday_opening_hour = document.getElementById("thursday_opening_hour");


            try {
                $thursday_opening_hour_int = parseInt(thursday_opening_hour.value);
                $thursday_closing_hour_int = parseInt(thursday_closing_hour.value);

                if($thursday_closing_hour_int < 0 || $thursday_closing_hour_int > 23) {
                    thursday_closing_hour.value = 23;
                }

                if($thursday_closing_hour_int < $thursday_opening_hour_int) {
                    thursday_opening_hour.value = thursday_closing_hour.value;
                }
            }catch (exception){
            }
        });

        $('#friday_opening_hour').on('change', function(e) {
            var friday_opening_hour = document.getElementById("friday_opening_hour");
            var friday_closing_hour = document.getElementById("friday_closing_hour");

            try {
                $friday_opening_hour_int = parseInt(friday_opening_hour.value);
                $friday_closing_hour_int = parseInt(friday_closing_hour.value);

                if($friday_opening_hour_int < 0 || $friday_closing_hour_int > 23) {
                    friday_opening_hour.value = 0;
                }

                if($friday_opening_hour_int > $friday_closing_hour_int) {
                    friday_closing_hour.value = friday_opening_hour.value;
                }
            }catch (exception){
            }
        });

        $('#friday_closing_hour').on('change', function(e) {
            var friday_closing_hour = document.getElementById("friday_closing_hour");
            var friday_opening_hour = document.getElementById("friday_opening_hour");


            try {
                $friday_opening_hour_int = parseInt(friday_opening_hour.value);
                $friday_closing_hour_int = parseInt(friday_closing_hour.value);

                if($friday_closing_hour_int < 0 || $friday_closing_hour_int > 23) {
                    friday_closing_hour.value = 23;
                }

                if($friday_closing_hour_int < $friday_opening_hour_int) {
                    friday_opening_hour.value = friday_closing_hour.value;
                }
            }catch (exception){
            }
        });

        $('#saturday_opening_hour').on('change', function(e) {
            var saturday_opening_hour = document.getElementById("saturday_opening_hour");
            var saturday_closing_hour = document.getElementById("saturday_closing_hour");

            try {
                $saturday_opening_hour_int = parseInt(saturday_opening_hour.value);
                $saturday_closing_hour_int = parseInt(saturday_closing_hour.value);

                if($saturday_opening_hour_int < 0 || $saturday_closing_hour_int > 23) {
                    saturday_opening_hour.value = 0;
                }

                if($saturday_opening_hour_int > $saturday_closing_hour_int) {
                    saturday_closing_hour.value = saturday_opening_hour.value;
                }
            }catch (exception){
            }
        });

        $('#saturday_closing_hour').on('change', function(e) {
            var saturday_closing_hour = document.getElementById("saturday_closing_hour");
            var saturday_opening_hour = document.getElementById("saturday_opening_hour");


            try {
                $saturday_opening_hour_int = parseInt(saturday_opening_hour.value);
                $saturday_closing_hour_int = parseInt(saturday_closing_hour.value);

                if($saturday_closing_hour_int < 0 || $saturday_closing_hour_int > 23) {
                    saturday_closing_hour.value = 23;
                }

                if($saturday_closing_hour_int < $saturday_opening_hour_int) {
                    saturday_opening_hour.value = saturday_closing_hour.value;
                }
            }catch (exception){
            }
        });

        $('#sunday_opening_hour').on('change', function(e) {
            var sunday_opening_hour = document.getElementById("sunday_opening_hour");
            var sunday_closing_hour = document.getElementById("sunday_closing_hour");

            try {
                $sunday_opening_hour_int = parseInt(sunday_opening_hour.value);
                $sunday_closing_hour_int = parseInt(sunday_closing_hour.value);

                if($sunday_opening_hour_int < 0 || $sunday_closing_hour_int > 23) {
                    sunday_opening_hour.value = 0;
                }

                if($sunday_opening_hour_int > $sunday_closing_hour_int) {
                    sunday_closing_hour.value = sunday_opening_hour.value;
                }
            }catch (exception){
            }
        });

        $('#sunday_closing_hour').on('change', function(e) {
            var sunday_closing_hour = document.getElementById("sunday_closing_hour");
            var sunday_opening_hour = document.getElementById("sunday_opening_hour");


            try {
                $sunday_opening_hour_int = parseInt(sunday_opening_hour.value);
                $sunday_closing_hour_int = parseInt(sunday_closing_hour.value);

                if($sunday_closing_hour_int < 0 || $sunday_closing_hour_int > 23) {
                    sunday_closing_hour.value = 23;
                }

                if($sunday_closing_hour_int < $sunday_opening_hour_int) {
                    sunday_opening_hour.value = sunday_closing_hour.value;
                }
            }catch (exception){
            }
        });

        $("#monday_check").on('change', function(data) {
            has_timetable = this.checked == true;
        });

        $("#tuesday_check").on('change', function(data) {
            has_timetable = this.checked == true;
        });

        $("#wednesday_check").on('change', function(data) {
            has_timetable = this.checked == true;
        });

        $("#thursday_check").on('change', function(data) {
            has_timetable = this.checked == true;
        });

        $("#friday_check").on('change', function(data) {
            has_timetable = this.checked == true;
        });

        $("#saturday_check").on('change', function(data) {
            has_timetable = this.checked == true;
        });

        $("#sunday_check").on('change', function(data) {
            has_timetable = this.checked == true;
        });
    }

    function check_has_timetable() {
        var monday_check = document.getElementById('monday_check');
        var tuesday_check = document.getElementById('tuesday_check');
        var wednesday_check = document.getElementById('wednesday_check');
        var thursday_check = document.getElementById('thursday_check');
        var friday_check = document.getElementById('friday_check');
        var saturday_check = document.getElementById('saturday_check');
        var sunday_check = document.getElementById('sunday_check');

        if(monday_check.checked == false && tuesday_check.checked == false && wednesday_check.checked == false &&
            thursday_check.checked == false && friday_check.checked == false && saturday_check.checked == false &&
            sunday_check.checked == false){
            return false;
        } else {
            return true;
        }
    }

    function manage_submit() {
        $.ajax({
            type: "GET",
            url: "../manage_space_error_messages",
            success: function (data) {
                $("#submit_space").click(function(event) {
                    var error_messages = JSON.parse(data);

                    has_timetable = check_has_timetable();
                    if (!(has_prices && has_timetable)) {
                        if (!has_prices) {
                            swal(error_messages[0], error_messages[1], "error");
                        }
                        if (!has_timetable) {
                            swal(error_messages[0], error_messages[2], "error");
                        }
                        event.preventDefault();
                    }
                });
            }
        });
    }

    function manage_space_availability() {
        var url = window.location.pathname;
        var url_split = url.split('/');
        var space_id = url_split[url_split.length - 1];

        $("#disable_space").on('click', function(data) {
            $.ajax({
                type: "GET",
                url: "../spaces/activation",
                data: {space_id: space_id, active: 0},
                success: function () {
                    var disable_space = document.getElementById('disable_space');
                    disable_space.classList.add("collapse");
                    var enable_space = document.getElementById('enable_space');
                    enable_space.classList.remove("collapse");
                },

                error: function (data) {
                    console.log('Error');
                }
            });
        });

        $("#enable_space").on('click', function(data) {
            $.ajax({
                type: "GET",
                url: "../spaces/activation",
                data: {space_id: space_id, active: 1},
                success: function (data) {
                    var enable_space = document.getElementById('enable_space');
                    enable_space.classList.add("collapse");
                    var disable_space = document.getElementById('disable_space');
                    disable_space.classList.remove("collapse");
                },

                error: function (data) {
                    console.log('Error');
                }
            });
        });

        $("#invalidate_space").on('click', function(data) {
            $.ajax({
                type: "GET",
                url: "../spaces/validation",
                data: {space_id: space_id, validated: 0},
                success: function () {
                    var invalidate_space = document.getElementById('invalidate_space');
                    invalidate_space.classList.add("collapse");
                    var validate_space = document.getElementById('validate_space');
                    validate_space.classList.remove("collapse");
                },

                error: function (data) {
                    console.log('Error');
                }
            });
        });

        $("#validate_space").on('click', function(data) {
            $.ajax({
                type: "GET",
                url: "../spaces/validation",
                data: {space_id: space_id, validated: 1},
                success: function (data) {
                    var validate_space = document.getElementById('validate_space');
                    validate_space.classList.add("collapse");
                    var invalidate_space = document.getElementById('invalidate_space');
                    invalidate_space.classList.remove("collapse");
                },

                error: function (data) {
                    console.log('Error');
                }
            });
        });
    }

    manage_separators();
    manage_prices();
    manage_timetable();
    manage_submit();
    manage_space_availability();

});


