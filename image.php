<?php
//include("geoiploc.php");
require_once dirname(__FILE__).'/../lib/apache-log4php-2.3.0/src/main/php/Logger.php';
Logger::configure(dirname(__FILE__).'/resources/appender_dailyfile.properties');

$logger = Logger::getRootLogger();

header ('Content-Type: image/png');
$im = @imagecreatetruecolor(120, 20)
or die('No se puede Iniciar el nuevo flujo a la imagen GD');
$color_texto = imagecolorallocate($im, 233, 14, 91);
$ip = $_SERVER["REMOTE_ADDR"];
if (isset($_SERVER["HTTP_FORWARDED"])){
	$ip = $_SERVER["HTTP_FORWARDED"];
}
if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
	$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];	
}

$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
$logger->info("  >>>>>    IP:".$ip."    <<<<<  ");
$logger->info($_SERVER);
$logger->info($meta);
imagestring($im, 1, 5, 5,  $_SERVER["REMOTE_ADDR"], $color_texto);
imagepng($im);
imagedestroy($im);
?>