<?php
require_once 'dpa-api.php';
$objDPA = new DPA();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Google Maps JavaScript API v3 Example: Marker Animations</title>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script>
            var chile = new google.maps.LatLng(-36.4, -72.0);
            var regiones = [
<?php
$aRegiones = $objDPA->Regiones($aData);
$nro_regiones = count($aRegiones);
$cnt = 1;
foreach ($aRegiones as $r):
    $coma = '';
    if ($cnt < $nro_regiones)
        $coma = ',';
    echo "new google.maps.LatLng(" . $r->lat . ", " . $r->lng . ")" . $coma . "\n\r";
    $cnt++;
endforeach;
?>
    ];
    
    var provincias = [
<?php
$aProvincias = $objDPA->Provincias($aData);
$nro_provincias = count($aProvincias);
$cnt = 1;
foreach ($aProvincias as $p):
    $coma = '';
    if ($cnt < $nro_provincias)
        $coma = ',';
    echo "new google.maps.LatLng(" . $p->lat . ", " . $p->lng . ")" . $coma . "\n\r";
    $cnt++;
endforeach;
?>
    ];
    
    var comunas = [
<?php
$aComunas = $objDPA->Comunas($aData);
$nro_comunas = count($aComunas);
$cnt = 1;
foreach ($aComunas as $c):
    $coma = '';
    if ($cnt < $nro_comunas)
        $coma = ',';
    echo "new google.maps.LatLng(" . $c->lat . ", " . $c->lng . ")" . $coma . "\n\r";
    $cnt++;
endforeach;
?>
    ];
      
    var markers = [];
    var iterator = 0;
    var map;

    function initialize() {
        var mapOptions = {
            zoom: 4,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: chile
        };

        map = new google.maps.Map(document.getElementById('map_canvas'),
        mapOptions);
            
    }
    
    function drop(type) {
        switch(type){
            case "regiones":
                color = "228b22";
                break
            case "provincias":
                color = "ffff00";
                break
            case "comunas":
                color = "FF0000";
                break
        }
        
        type = eval(type);
        iterator = 0;
        for (var i = 0; i < type.length; i++) {
            setTimeout(function() {
                addMarker(type, color);
            }, i * 50);
        }
    }
    
    function addMarker(type, color) {
        markers.push(new google.maps.Marker({
            position: type[iterator],
            map: map,
            draggable: false,
            animation: google.maps.Animation.DROP,
            icon: "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + ((color) ? color : 'FAFAEE')
        }));
        iterator++;
    }
        </script>
    </head>
    <body onload="initialize()">
        <div id="map_canvas" style="width: 800px; height: 600px;">map div</div>
        <button id="drop" onclick="drop('regiones')">Regiones</button>
        <button id="drop" onclick="drop('provincias')">Provincias</button>
        <button id="drop" onclick="drop('comunas')">Comunas</button>
        <div style="clear: both"></div>
        <div id="info" style="border: 1px solid #ccc; float: right">
            info
        </div>
    </body>
</html>
