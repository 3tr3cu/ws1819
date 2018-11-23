<?php
	require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
    $targID = $_GET['id'];
    $soapclient = new nusoap_client('http://ws842134.000webhostapp.com/project/php/getQuestion?wsdl',true);
	$soapresult = $soapclient->call('retrieve',array('x'=>$targID));
	echo var_dump($soapresult);
	echo "Galderaren egilea:<br>";
	echo "$soapresult->author<br>";
	echo "Galdera:<br>";
	echo "$soapresult->questiontext<br>";
	echo "Emaitza:<br>";
	echo "$soapresult->respright";

?>