<?php

$dato = urldecode($_GET['dep']);
echo <<<ABC
<script type="text/javascript">
if (GBrowserIsCompatible()) {
var map = new GMap2(document.getElementById("map"));

map.setCenter(new GLatLng(-10.106836,-75.031367), 8);

map.addControl(new GMapTypeControl());
map.addControl(new GLargeMapControl());
map.addControl(new GScaleControl());
map.addControl(new GOverviewMapControl());
function addtag(point, address) {
        var marker = new GMarker(point);
        GEvent.addListener(marker, "click", function() {
		marker.openInfoWindowHtml(address); } );
        return marker;
        }
ABC;

mysql_connect("localhost", "root", "");
mysql_select_db("pruebas");
$resultado = mysql_query("SELECT latitud,longitud,direccion,nom_iiee FROM tbl_olpc WHERE departamento='$dato'");

$contar=0;
while ($fila = mysql_fetch_assoc($resultado)){
$contar++;
$total = strlen($fila["latitud"]);
$normal = $fila["latitud"];
$latitud = '';
$corta = $total - 6;
for($i=0;$i<$total;$i++){
	$latitud .= $normal{$i};
	if($i == $corta)
	$latitud.=".";
}

$total = strlen($fila["longitud"]);
$normal = $fila["longitud"];
$longitud= '';
$corta = $total - 6;
for($i=0;$i<$total;$i++){
	$longitud .= $normal{$i};
	if($i == $corta)
	$longitud.=".";
}
$fila["nom_iiee"] = addslashes(str_replace(".","",$fila["nom_iiee"]));
$fila["direccion"] = addslashes(str_replace(".","",$fila["direccion"]));

echo <<<ABC
var point = new GLatLng($latitud,$longitud);
var address = '<b>{$fila["nom_iiee"]}</b><br/><i>{$fila["direccion"]}</i>';

var marker = addtag(point,address);
map.addOverlay(marker);
ABC;
}
echo "}</script>";
?>