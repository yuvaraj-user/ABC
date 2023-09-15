<?php
include("mac.php");

ob_start();

system('ipconfig /all');


$mycom=ob_get_contents();

ob_clean();

$findme = "Physical";

$pmac = strpos($mycom, $findme);


$mac=substr($mycom,($pmac+36),17);



ob_start();

 system('wmic csproduct get uuid');


 $mycom=ob_get_contents();

ob_clean();

$findme = "uuid";

$pproc = strpos($mycom, $findme);


$proc1=substr($mycom,($pproc+36),50);

//$proc=rtrim($proc1);
 $proc=preg_replace('/\s+/', '', $proc1);
 $secureProcess_one=preg_replace('/\s+/', '', $secureProcess1);
 $secureProcess_two=preg_replace('/\s+/', '', $secureProcess2);

?>