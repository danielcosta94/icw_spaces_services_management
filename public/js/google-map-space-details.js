$(function () {

    function setMapAndLocation(latitude, longitude) {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geocoder = new google.maps.Geocoder();
                var coordinates_gps = document.getElementById('coordinates_gps');
                var coordinates = coordinates_gps.innerHTML.split(',');

                geocoder.geocode({'latLng': new google.maps.LatLng(coordinates[0], coordinates[1])}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {

                        var street_number = document.getElementById('street_number');
                        var route = document.getElementById('route');
                        var city = document.getElementById('city');
                        var county = document.getElementById('county');
                        var state = document.getElementById('state');
                        var country = document.getElementById('country');
                        var zip_code = document.getElementById('zip_code');
                        var country_code;
                        var currency_code = document.getElementsByClassName('currency_code');

                        $.each(results, function (i, result) {

                            // iterate through address_component array
                            $.each(result.address_components, function (j,address_component) {

                                if (address_component.types[0] == "route") {
                                    route.innerHTML = address_component.long_name;
                                }

                                if (address_component.types[0] == "administrative_area_level_1") {
                                    state.innerHTML = address_component.long_name;
                                } else if((address_component.types[0] == "locality")) {
                                    county.innerHTML = address_component.long_name;
                                }

                                if (address_component.types[0] == "administrative_area_level_2") {
                                    county.innerHTML = address_component.long_name;
                                }

                                if (address_component.types[0] == "administrative_area_level_3") {
                                    city.innerHTML = address_component.long_name;
                                } else if((address_component.types[0] == "locality")) {
                                    city.innerHTML = address_component.long_name;
                                }

                                if (address_component.types[0] == "country"){
                                    country.innerHTML = address_component.long_name;
                                    country_code = address_component.short_name;
                                }

                                if (address_component.types[0] == "postal_code"){
                                    zip_code.innerHTML = address_component.long_name;
                                }

                                if (address_component.types[0] == "street_number"){
                                    street_number.innerHTML = address_component.long_name + ' ';
                                }

                            });
                        });

                        $.ajax({
                            type: "GET",
                            url: "../country_currency",
                            data: {country_code: country_code},

                            success: function (data) {
                                var currency = JSON.parse(data);
                                for(i = 0; i < currency_code.length; i++) {
                                    currency_code[i].innerHTML = currency.symbol;
                                }
                            }
                        });
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            });
        }
    }

    function initMap() {
        var coordinates_gps = document.getElementById('coordinates_gps');
        var coordinates = coordinates_gps.innerHTML.split(',');
        setMapAndLocation(coordinates[0], coordinates[1]);

        var location = new google.maps.LatLng(coordinates[0], coordinates[1]);

        var mapCanvas = document.getElementById('property-map');
        var mapOptions = {
            center: location,
            zoom: 14,
            panControl: false,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(mapCanvas, mapOptions);

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(coordinates[0], coordinates[1]),
            map: map
        });

    }
    google.maps.event.addDomListener(window, 'load', initMap);
});
