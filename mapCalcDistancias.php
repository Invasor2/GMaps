<!DOCTYPE html>
<html>
    <head>
        <title>Distance Matrix service</title>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
        <style>
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            #map-canvas {
                height: 100%;
                width: 50%;
            }
            #content-pane {
                float:right;
                width:48%;
                padding-left: 2%;
            }
            #outputDiv {
                font-size: 11px;
            }
        </style>
        <script>

            var map;
            var geocoder;
            var bounds = new google.maps.LatLngBounds();
            var markersArray = [];

            var origin = new google.maps.LatLng(39.0461912, -0.3155186);
            var destination = new google.maps.LatLng(38.982858, -0.517936);

            var destinationIcon = "images/casa.png";
            var originIcon = "images/homer.png";

            function initialize() {
                var opts = {
                    center: new google.maps.LatLng(39.0461912, -0.3155186),
                    zoom: 10
                };
                map = new google.maps.Map(document.getElementById('map-canvas'), opts);
                geocoder = new google.maps.Geocoder();
            }

            function calculateDistances() {
                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix(
                        {
                            origins: [origin],
                            destinations: [destination],
                            travelMode: google.maps.TravelMode.DRIVING,
                            unitSystem: google.maps.UnitSystem.METRIC,
                            avoidHighways: false,
                            avoidTolls: false
                        }, callback);
            }

            function callback(response, status) {
                if (status !== google.maps.DistanceMatrixStatus.OK) {
                    alert('Error was: ' + status);
                } else {
                    var origins = response.originAddresses;
                    var destinations = response.destinationAddresses;
                    var outputDiv = document.getElementById('outputDiv');
                    outputDiv.innerHTML = '';
                    deleteOverlays();

                    for (var i = 0; i < origins.length; i++) {
                        var results = response.rows[i].elements;
                        addMarker(origins[i], false);
                        for (var j = 0; j < results.length; j++) {
                            addMarker(destinations[j], true);
                            outputDiv.innerHTML += origins[i] + ' a ' + destinations[j]
                                    + ': ' + results[j].distance.text + ' en '
                                    + results[j].duration.text + '<br>';
                        }
                    }
                }
            }

            function addMarker(location, isDestination) {
                var icon;
                if (isDestination) {
                    icon = destinationIcon;
                } else {
                    icon = originIcon;
                }
                geocoder.geocode({'address': location}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        bounds.extend(results[0].geometry.location);
                        map.fitBounds(bounds);
                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            icon: icon
                        });
                        markersArray.push(marker);
                    } else {
                        alert('Geocode was not successful for the following reason: '
                                + status);
                    }
                });
            }

            function deleteOverlays() {
                for (var i = 0; i < markersArray.length; i++) {
                    markersArray[i].setMap(null);
                }
                markersArray = [];
            }

            google.maps.event.addDomListener(window, 'load', initialize);

        </script>

    </head>
    <body>
        <div id="content-pane">
            <div id="inputs">
                <pre>
'Font menor, Simat';
'Castell, Xàtiva';
                </pre>
                <p><button type="button" onclick="calculateDistances();">Calcular
                        distàncies</button></p>
            </div>
            <div id="outputDiv"></div>
        </div>
        <div id="map-canvas"></div>
    </body>
</html>