<?php
require_once 'system/core.php'; // запуск ядро 
require_once 'system/functions.php'; // запуск функций
$key = protect($_GET['k']);
if ($key != 'appInventor') { // Специальный код, чтобы сервер определил что это именно наша ардуинка
	exit;
}
$temp = protect($_GET['t']);
$hum = protect($_GET['h']);
$ram = protect($_GET['ram']);
$pir1 = protect($_GET['p1']);
$pir2 = 0;
$light = 0;
$rele1 = 0;
$reboot = protect($_GET['rb']);
$total = mysql_result(mysql_query("SELECT count(*) FROM `stat`"),0);
if ($total > 15) {
	mysql_query("DELETE FROM `stat` ORDER BY `id` ASC LIMIT 1");
}
mysql_query("UPDATE `settings` SET `value`='".time()."' WHERE `id`= 'connection'");
mysql_query("UPDATE `settings` SET `value`='".$ram."' WHERE `id`= 'ram'");
if ($reboot == 1) {
	mysql_query("UPDATE `settings` SET `value`='".time()."' WHERE `id`= 'reboot'");
}
if ($temp !='') {
	mysql_query("INSERT INTO `stat` (temp,hum,time) values ('".$temp."','".$hum."','".time()."') ");
} elseif ($pir1 !='') {
	mysql_query("UPDATE `sensor` SET `pir1`='".$pir1."',`pir2`='".$pir2."',`rele1`='".$rele1."',`light`='".$light."'");
}
echo 'Ок';
?>
