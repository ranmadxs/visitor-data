<?php
require_once dirname(__FILE__).'/../lib/apache-log4php-2.3.0/src/main/php/Logger.php';
Logger::configure(dirname(__FILE__).'/resources/appender_dailyfile.properties');

$logger = Logger::getRootLogger();

header ('Content-Type: image/png');
$im = @imagecreatetruecolor(120, 20)
or die('No se puede Iniciar el nuevo flujo a la imagen GD');
$color_texto = imagecolorallocate($im, 233, 14, 91);
$txt = "Hola ".$_SERVER["REMOTE_ADDR"];
$logger->info($txt);
imagestring($im, 1, 5, 5,  $txt, $color_texto);
imagepng($im);
imagedestroy($im);
?>