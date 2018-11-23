<?php

require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

$ns="http://ws842134.000webhostapp.com/project/php/egiaztatuPasahitzaZerb.php?wsdl";
$server = new soap_server;
$server->configureWSDL('egiaztatu',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

$server->register('egiaztatu',array('x'=>'xsd:string','y'=>'xsd:boolean'),array('z'=>'xsd:string'),$ns);

function egiaztatu($x, $y){
	if ($y == false){
		if ($x = 1010){
		return "SERVICE UP";}
		else {
			return "ZERBITZURIK GABE";
		}
	} else if ($y== true){
		$myfile = fopen("toppasswords.txt", "r");
        $content = fread($myfile,filesize("toppasswords.txt"));

		if (strpos($content,$x) !=false){
			return "BALIOGABEA";
		} else return "BALIOZKOA";
	}
}


if (!isset( $HTTP_RAW_POST_DATA )) {
$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
}
$server->service($HTTP_RAW_POST_DATA);

?>