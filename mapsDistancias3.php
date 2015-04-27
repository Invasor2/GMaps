<!DOCTYPE html>
<html>
    <head>
        <title>Data Layer: Simple</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <style>
            html, body, #map-canvas {
                height: 100%;
                margin: 0px;
                padding: 0px
            }
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
        <script>
            var map;
            function initialize() {
                // Create a simple map.
                map = new google.maps.Map(document.getElementById('map-canvas'), {
                    zoom: 4,
                    center: {lat: -28, lng: 137.883}
                });

                // Load a GeoJSON from the same server as our demo.
                map.data.loadGeoJson('https://storage.googleapis.com/maps-devrel/google.json');
            }

            google.maps.event.addDomListener(window, 'load', initialize);

        </script>
    </head>
    <body>
        <div id="map-canvas"></div>
    </body>
</html>