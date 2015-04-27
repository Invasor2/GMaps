<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <title>Simple markers</title>
        <style>
            html, body, #map-canvas {
                height: 100%;
                margin: 0px;
                padding: 0px
            }
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
        <script>
            function initialize() {
                var myLatlng = new google.maps.LatLng(41.9301771, 2.2552673);
                var mapOptions = {
                    zoom: 15,
                    center: myLatlng
                }
                /*MARK 1*/
                var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                var icono = crearIcono("images/homer.png");
                var titol = "Més o menys per aqui es casa meva";
                var contentString = '<div id="content">' +
                        '<div id="siteNotice"></div>' +
                        '<h1 id="firstHeading" class="firstHeading">Plaça major de Vic</h1>' +
                        '<div id="bodyContent">' +
                        '<p><b>Plaça major de Vic</b>, més o menys per aqui es casa meva.</p>' +
                        '</div>' +
                        '</div>';
                var marker = pintarMarcador(myLatlng, map, icono, titol);
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });

                /*MARK 2*/
                icono = crearIcono("images/fray.png");
                myLatlng = new google.maps.LatLng(41.9332746, 2.2425283);
                titol = "Aqui es la casa d'en Dani";
                pintarMarcador(myLatlng, map, icono, titol);
                /*MARK 3*/
                icono = crearIcono("images/casa.png");
                myLatlng = new google.maps.LatLng(41.9157195, 2.2589633);
                titol = "A l'estiu per aquí serà casa meva :/";
                pintarMarcador(myLatlng, map, icono, titol);
                google.maps.event.addListener(infoWindow, 'click', function () {
                    infowindow.open(map, infoWindow);
                });
            }
            google.maps.event.addDomListener(window, 'load', initialize);



            function pintarMarcador(lat, map, icono, titol) {
                return new google.maps.Marker({
                    position: lat,
                    map: map,
                    icon: icono,
                    title: titol
                });
            }

            function crearIcono(img) {
                return new google.maps.MarkerImage(img,
                        /* dimensions de la imatge */
                        new google.maps.Size(64, 64),
                        /* Origen de la imatge 0,0. */
                        new google.maps.Point(0, 0),
                        /* Punt d'ancoratge al mapa (varia en funció de les dimensions) */
                        new google.maps.Point(32, 64)
                        );
            }

        </script>
    </head>
    <body>
        <div id="map-canvas"></div>
    </body>