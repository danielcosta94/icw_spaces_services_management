$(function () {

    function centerMapLocalPosition(map) {
        // Try HTML5< geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                map.setCenter(pos);
            });
        }
    }

    function completeCitiesName() {
        var options = {
            types: ['(cities)']
        };

        var city_names = document.getElementsByName('city');

        for($i = 0; $i < city_names.length; $i++) {
            var autocomplete = new google.maps.places.Autocomplete(city_names[$i], options);
        }
    }

    function addSpaceMarkers(map) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "spaces_visible",
            success: function (data) {

                var data_spaces = {};

                for(var i = 0; i < data.length; i++) {
                    var latLng = data[i].latitude + "," + data[i].longitude;

                    if(data_spaces[latLng] != null) {
                        var found = false;

                        var index = 0;
                        var data_spaces_gps = data_spaces[latLng];
                        var tempSpace;
                        while (index < data_spaces[latLng].length && found == false) {
                            if(data_spaces_gps[index].id == data[i].id) {
                                tempSpace = data_spaces_gps[index];

                                switch (data[i].plan) {
                                    case 'hour':
                                        tempSpace['price_hour'] = data[i].price;
                                        break;
                                    case 'day':
                                        tempSpace['price_day'] = data[i].price;
                                        break;
                                    case 'week':
                                        tempSpace['price_week'] = data[i].price;
                                        break;
                                    case 'month':
                                        tempSpace['price_month'] = data[i].price;
                                        break;
                                }

                                found = true;
                            }
                            index++;
                        }


                        if(found == false) {
                            tempSpace = data[i];

                            switch (data[i].plan) {
                                case 'hour':
                                    tempSpace['price_hour'] = data[i].price;
                                    break;
                                case 'day':
                                    tempSpace['price_day'] = data[i].price;
                                    break;
                                case 'week':
                                    tempSpace['price_week'] = data[i].price;
                                    break;
                                case 'month':
                                    tempSpace['price_month'] = data[i].price;
                                    break;
                            }
                            data_spaces[latLng].push(tempSpace);
                        }
                    } else {
                        tempSpace = data[i];

                        switch (data[i].plan) {
                            case 'hour':
                                tempSpace['price_hour'] = data[i].price;
                                break;
                            case 'day':
                                tempSpace['price_day'] = data[i].price;
                                break;
                            case 'week':
                                tempSpace['price_week'] = data[i].price;
                                break;
                            case 'month':
                                tempSpace['price_month'] = data[i].price;
                                break;
                        }

                        data_spaces[latLng] = [tempSpace];
                    }
                }

                var geocoder = new google.maps.Geocoder();

                for(var data_space in data_spaces) {
                    var data_key = data_spaces[data_space];
                    var gps_points = data_space.split(",");

                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(gps_points[0], gps_points[1]),
                        map: map,
                        label: data_key.length.toString()
                    });

                    geocoder.geocode({'latLng': new google.maps.LatLng(gps_points[0], gps_points[1])}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {

                            var country_code;
                            $.each(results[results.length - 1].address_components, function (i, result) {
                                country_code = result.short_name;
                            });

                            $.ajax({
                                type: "GET",
                                url: "../country_currency",
                                data: {country_code: country_code},

                                success: function (data) {
                                    var currency = JSON.parse(data);
                                    var spaceContent = "";
                                    for(var j = 0; j < data_key.length; j++) {
                                        var spaceContent = spaceContent + '<div class="info-window">' +
                                            '<h3>' + "<a href='space-details/" + data_key[j].id + "'>" + data_key[j].name + "</a>" + '</h3>' +
                                            '<div class="info-content">' +
                                            '<img class="logo_img" src=' + '/storage/' +  data_key[j].path.split("public/")[1] + '>' +
                                            '<p>' + ((data_key[j].price_hour != null) ? "<strong style='display: inline'>Hour: </strong>" + data_key[j].price_hour + currency.symbol : "<strong style='display: inline' >Hour: </strong>" + "NA") + '</p>' +
                                            '<p>' + ((data_key[j].price_day != null) ? "<strong style='display: inline'>Day: </strong>" + data_key[j].price_day + currency.symbol : "<strong style='display: inline'>Day: </strong>" + "NA") + '</p>' +
                                            '<p>' + ((data_key[j].price_week != null) ? "<strong style='display: inline'>Week: </strong>" + data_key[j].price_week + currency.symbol: "<strong style='display: inline'>Week: </strong>" + "NA") + '</p>' +
                                            '<p>' + ((data_key[j].price_month != null) ? "<strong style='display: inline'>Month: </strong>" + data_key[j].price_month + currency.symbol : "<strong style='display: inline'>Month: </strong>" + "NA") + '</p>' +
                                            '<p>' + "<strong style='display: inline'>Capacity: </strong>" + data_key[j].capacity + '</p>'+
                                            '<hr>';
                                    }

                                    var infowindow = new google.maps.InfoWindow({
                                        content: spaceContent,
                                        maxWidth: 400
                                    });

                                    marker.addListener('click',(function (marker, infowindow) {
                                        return function() {
                                            infowindow.open(map,marker);
                                        };
                                    }(marker, infowindow)));
                                },
                                error: function () {
                                    var spaceContent = "";
                                    for(var j = 0; j < data_key.length; j++) {
                                        var spaceContent = spaceContent + '<div class="info-window">' +
                                            '<h3>' + "<a href='space-details/" + data_key[j].id + "'>" + data_key[j].name + "</a>" + '</h3>' +
                                            '<div class="info-content">' +
                                            '<img class="logo_img" src=' + '/storage/' +  data_key[j].path.split("public/")[1] + '>' +
                                            '<p>' + ((data_key[j].price_hour != null) ? "<strong style='display: inline'>Hour: </strong>" + data_key[j].price_hour: "<strong style='display: inline' >Hour: </strong>" + "NA") + '</p>' +
                                            '<p>' + ((data_key[j].price_day != null) ? "<strong style='display: inline'>Day: </strong>" + data_key[j].price_day : "<strong style='display: inline'>Day: </strong>" + "NA") + '</p>' +
                                            '<p>' + ((data_key[j].price_week != null) ? "<strong style='display: inline'>Week: </strong>" + data_key[j].price_week: "<strong style='display: inline'>Week: </strong>" + "NA") + '</p>' +
                                            '<p>' + ((data_key[j].price_month != null) ? "<strong style='display: inline'>Month: </strong>" + data_key[j].price_month : "<strong style='display: inline'>Month: </strong>" + "NA") + '</p>' +
                                            '<p>' + "<strong style='display: inline'>Capacity: </strong>" + data_key[j].capacity + '</p>'+
                                            '<hr>';
                                    }

                                    var infowindow = new google.maps.InfoWindow({
                                        content: spaceContent,
                                        maxWidth: 400
                                    });

                                    marker.addListener('click',(function (marker, infowindow) {
                                        return function() {
                                            infowindow.open(map,marker);
                                        };
                                    }(marker, infowindow)));
                                }
                            });


                        } else {
                            alert('Geocode was not successful for the following reason: ' + status);
                        }
                    });
                }
            }

        });
    }

    function addServicesMarkers(map) {
        var service_marker = 'images/service_marker.png';

        $.ajax({
            type: "GET",
            url: "services/services",
            success: function (data) {
                var services = JSON.parse(data);

                var markers = [];
                for(var i = 0; i < services.length; i++) {
                    markers[i] = new google.maps.Marker({
                        position: new google.maps.LatLng(services[i].latitude, services[i].longitude),
                        map: map,
                        icon: service_marker
                    });

                    markers[i].addListener('click',(function (service) {
                        return function () {
                            var serviceContent = '<div class="info-window">' +
                                '<h3>' + service.name + '</h3>' +
                                '<div class="info-content">' +
                                '<p>' + service.description + '</p>' +
                                '</div>' +
                                '</div>';

                            var infowindow = new google.maps.InfoWindow({
                                content: serviceContent,
                                maxWidth: 400
                            });

                            infowindow.open(map, this);
                        };
                    }(services[i])));
                }
            }
        });
    }

    function initMap() {

        var location = new google.maps.LatLng(41.149638, -8.625604);

        var mapCanvas = document.getElementById('property-map');
        var mapOptions = {
            center: location,
            zoom: 14,
            panControl: false,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(mapCanvas, mapOptions);


        centerMapLocalPosition(map);

        addSpaceMarkers(map);
        // addServicesMarkers(map);

        //     completeCitiesName();

    }

    google.maps.event.addDomListener(window, 'load', initMap);
});