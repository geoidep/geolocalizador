<?php
if (isset($_GET['codigo']))
    $codigo=$_GET['codigo'];
else
    $codigo="9999";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title>API</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
     <link rel="stylesheet" href="lib/leaflet.css"/>
     <link rel="stylesheet" href="lib/leaflet-search.css"/>
     <link rel="stylesheet" href="lib/Control.Coordinates.css"/>
     <link rel="stylesheet" href="lib/tercero/css/bootstrap.min.css">
    
   <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="lib/leaflet-src.js"></script>
 <script src="lib/leaflet-search.js"></script>
 <script src="lib/Control.Coordinates.js"></script>
 <script src="lib/tercero/js/jquery-3.3.1.min.js"></script>
 <script src="lib/tercero/js/popper.min.js"></script>
 <script src="lib/tercero/js/bootstrap.min.js"></script>
 <!--script type="text/javascript" src="puntos.js"></script-->
 <style>
   body { margin:0; padding:0; }
   #mapid { position:absolute; top:0; bottom:0; width:100%; }
 </style>
</head>
<body>
<div>
<input type="hidden" id="latitud"/>
<input type="hidden" id="longitud"/>
<input type="hidden" id="codigo" value="<?php echo $codigo?>"/>
</div>
<div id="mapid"></div>
<script>

var plat = -9.18117, plon = -75.48779, pzoom = 5;
var mymap = L.map('mapid').setView([plat, plon], pzoom);
var geojsonMarkerOptions = {
    radius: 0.1,
    weight: 0.1,
    opacity: 0.05,
    fillOpacity: 0.05
};
var controlSearch;
var puntos = L.geoJson({"type": "FeatureCollection",
                        "name": "puntos",
                        "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
                        "features": []
                        },{pointToLayer: function (feature, latlng) {
                               return L.circleMarker(latlng, geojsonMarkerOptions);}
                        });
//var puntos = L.geoJson(puntos,{pointToLayer: function (feature, latlng) { return L.circleMarker(latlng, geojsonMarkerOptions);}});
$('#mapid').css('cursor','crosshair');

 var urlWS = "http://localhost/service/json/";

 var get_zoom = function() {
    $.ajax({
        url: urlWS+'zoom.php',
        type: "POST",
        datatype: 'json',
        data: { codigo : $('#codigo').val()},
        success: function(data) {
            plat  = data["ZOOM"][0]['y'];
            plon  = data["ZOOM"][0]['x'];
            pzoom = data["ZOOM"][0]['zoom'];
            mymap.setView([plat, plon], pzoom);
        },
        error: function(obj, err, oterr) {
        }
    });
 };

 var get_puntoInteres = function() {
    $.ajax({
        url: urlWS+'puntoInteres.php',
        type: "POST",
        datatype: 'json',
        data: { codigo : $('#codigo').val()},
        success: function(data) {
            puntos.addData(data['PUNTOS']);
            controlSearch = new L.Control.Search({
                position:'topleft',
                layer: puntos,
                hideMarkerOnCollapse: false,
                propertyName: 'nombPunto',
                zoom: 18,
                textPlaceholder: 'Buscar...'
              });
            mymap.addControl(controlSearch);
        },
        error: function(obj, err, oterr) {
        }
    });
 };

var OSM_Mapnik = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: '&copy; OpenStreetMap | eturin',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiZGF2aXMxOCIsImEiOiJjaXczeHNkdzMwMmtlMnlvMHhkb2d1MTh5In0.7mxJQYB4VXZmp6SS0hHd0w'
}).addTo(mymap);

var c = new L.Control.Coordinates();

c.addTo(mymap);

var theMarker = {};

function onMapClick(e) {
    c.setCoordinates(e);
    lat = e.latlng.lat;
    lon = e.latlng.lng;
    
    document.querySelector('#latitud').value = lat.toString();
    document.querySelector('#longitud').value = lon.toString();
        //Clear existing marker, 
        if (theMarker != undefined) {
              mymap.removeLayer(theMarker);
        };
    //Add a marker to show where you clicked.
     theMarker = L.marker([lat,lon]).addTo(mymap);
}

mymap.on('click', onMapClick);

 $(document).ready(function(e){
    if($('#codigo').val()!="9999"){
        get_zoom();
        get_puntoInteres();
    }
});
</script>
</body>
</html>