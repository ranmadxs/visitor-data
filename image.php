<?php
require_once dirname(__FILE__).'/../lib/apache-log4php-2.3.0/src/main/php/Logger.php';
Logger::configure(dirname(__FILE__).'/resources/appender_dailyfile.properties');

$logger = Logger::getRootLogger();

header ('Content-Type: image/png');
$im = @imagecreatetruecolor(1, 1)
or die('No se puede Iniciar el nuevo flujo a la imagen GD');
$fondo = imagecolorallocate($im, 255, 255, 255);
$color_texto = imagecolorallocate($im, 0, 0, 255);
$ip = $_SERVER["REMOTE_ADDR"];
if (isset($_SERVER["HTTP_FORWARDED"])){
	$ip = $_SERVER["HTTP_FORWARDED"];
}
if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
	$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];	
}

$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
$logger->info("  >>>>>   INICIO IP:".$ip."    <<<<<  ");
$logger->info($_SERVER);
$logger->info($meta);
$logger->info("  >>>>>  FIN  IP:".$ip."    <<<<<  ");
imagestring($im, 2, 5, 5,  "", $color_texto);
imagefill($im, 0, 0, $fondo);
imagepng($im);
imagedestroy($im);
?>