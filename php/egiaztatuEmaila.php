<?php
	require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
    $soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl',true);
	$varmail = $_GET['mail'];
	$soapresult = $soapclient->call('egiaztatuE',array('x'=>$varmail));
	if($soapresult=='BAI'){
		echo "BAI";
	} else{
		if ($soapresult=='EZ'){
			echo "EZ";
		} else{
			echo "DC";
		}
	}
		
?>