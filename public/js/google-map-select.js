$(function () {

    var latitude = 0;
    var longitude = 0;
    var map;
    var marker;

    function centerMapLocalPosition(map) {
        // Try HTML5< geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {

                latitude = position.coords.latitude;
                longitude = position.coords.longitude;

                var pos = {
                    lat: latitude,
                    lng: longitude
                };

                map.setCenter(pos);
            });
        }
    }

    function centerMapSpacePosition(map, latitude, longitude) {
        var pos = {
            lat: latitude,
            lng: longitude
        };

        map.setCenter(pos);
    }

    function initMap() {
        var mapCanvas = document.getElementById('property-map');
        var mapOptions = {
            zoom: 14,
            panControl: false,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(mapCanvas, mapOptions);

        latitude = document.getElementById('latitude').value;
        longitude = document.getElementById('longitude').value;

        try {
            $latitude_float = parseFloat(latitude);
            $longitude_float = parseFloat(longitude);


            if(latitude === "" && longitude === "") {
                centerMapLocalPosition(map);
            } else {
                centerMapSpacePosition(map, $latitude_float, $longitude_float);
            }

            setTimeout(function(){
                var myLatlng = new google.maps.LatLng(latitude, longitude);

                // Place a draggable marker on the map
                marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    draggable: true
                });

                placeMarker();
                google.maps.event.addListener(marker, 'position_changed', placeMarker);

                google.maps.event.addListener(map, 'dblclick', function(e) {
                    var positionDoubleclick = e.latLng;
                    marker.setPosition(positionDoubleclick);
                });
            }, 500);
        }catch (exception){
        }


    }

    function placeMarker() {
        $("#latitude").attr('value', marker.position.lat());
        $("#longitude").attr('value', marker.position.lng());
    }

    google.maps.event.addDomListener(window, 'load', initMap);

});