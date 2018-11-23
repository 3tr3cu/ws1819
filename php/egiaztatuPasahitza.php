<?php
	require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
    $soapclient = new nusoap_client('http://ws842134.000webhostapp.com/project/php/egiaztatuPasahitzaZerb.php?wsdl',true);
	$varpass = $_GET['pass'];
	$soapresult = $soapclient->call('egiaztatu',array('x'=>1010, 'y'=>false));
	if($soapresult=='SERVICE UP'){
	    
		$soapresult = $soapclient->call('egiaztatu',array('x'=>$varpass,'y'=>true));
		if($soapresult=='BALIOZKOA'){
		    echo "BAI";
		} else if ($soapresult=='BALIOGABEA'){
		    echo "EZ2";
		} else echo "DC";
	} else{
		if ($soapresult=='ZERBITZURIK GABE'){
			echo "EZ";
		} else{
			echo "DC";
		}
	}
		
?>