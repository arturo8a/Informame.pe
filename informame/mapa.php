<?php
echo <<<ABC
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>:::colegios:::</title>
<script src="http://maps.google.com/maps?file=api&v=2&key=abcdefg" type="text/javascript"></script>
<script type="text/javascript" src="jquery-1.4.3.min.js" ></script>
<script type="text/javascript">
function load() {
if (GBrowserIsCompatible()) {
var map = new GMap2(document.getElementById("map"));



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
$resultado = mysql_query("SELECT latitud,longitud,direccion,nom_iiee FROM tbl_olpc WHERE departamento='LIMA'");
$contar=0;
while ($fila = mysql_fetch_assoc($resultado)){

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
$contar++;
if($contar == 1)
echo "map.setCenter(new GLatLng($latitud,$longitud), 4);";
echo <<<ABC
var point = new GLatLng($latitud,$longitud);
var address = '<b>{$fila["nom_iiee"]}</b><br/><i>{$fila["direccion"]}</i>';

var marker = addtag(point,address);
map.addOverlay(marker);
ABC;
}
echo <<<ABC
}
}

$(document).ready(function(){
	$('#departamentos').change(function(){
		var depa = $('#departamentos').val();
		$('#map').load('loadmapa.php?dep='+depa);
	});
});
</script>
</head>
<body onload="load()" onunload="GUnload()">
<select id="departamentos" >
<option value="AMAZONAS">AMAZONAS</option>
<option value="ANCASH">ANCASH</option>
<option value="APURIMAC">APURIMAC</option>
<option value="AREQUIPA">AREQUIPA</option>
<option value="CAJAMARCA">CAJAMARCA</option>
<option value="CALLAO">CALLAO</option>
<option value="CUSCO">CUSCO</option>
<option value="HUANCAVELICA">HUANCAVELICA</option>
<option value="HUANUCO">HUANUCO</option>
<option value="ICA">ICA</option>
<option value="JUNIN">JUNIN</option>
<option value="LALIBERTAD">LA LIBERTAD</option>
<option value="LAMBAYEQUE">LAMBAYEQUE</option>
<option value="LIMA" selected>LIMA</option>
<option value="LORETO">LORETO</option>
<option value="MADREDEDIOS">MADRE DE DIOS</option>
<option value="MOQUEGUA">MOQUEGUA</option>
<option value="PASCO">PASCO</option>
<option value="PIURA">PIURA</option>
<option value="PUNO">PUNO</option>
<option value="SANMARTIN">SAN MARTIN</option>
<option value="TACNA">TACNA</option>
<option value="TUMBES">TUMBES</option>
<option value="UCAYALI">UCAYALI</option>
</select>

<div align="center">
  <div id="map" style="width: 900px; height: 800px"></div>
</div>
</body>
</html>
ABC;
