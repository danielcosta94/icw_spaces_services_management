// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

function completeCitiesName() {
    var options = {
        types: ['(cities)']
    };

    var city_names = document.getElementsByName('city');

    for($i = 0; $i < city_names.length; $i++) {
        var autocomplete = new google.maps.places.Autocomplete(city_names[$i], options);
    }
}