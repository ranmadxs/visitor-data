<?php
include_once '../lib/dpr.php';
//dpr("XD");
$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='."190.164.212.151"));
dpr($meta);

$latitud = $meta['geoplugin_latitude'];
$longitud = $meta['geoplugin_longitude'];
$ciudad = $meta['geoplugin_city'];

dpr($_SERVER);
?>