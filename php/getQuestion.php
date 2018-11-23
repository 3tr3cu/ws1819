<?php

require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

include 'dbConfig.php';

$ns="http://ws842134.000webhostapp.com/project/php/getQuestion.php?wsdl";
$server = new soap_server;
$server->configureWSDL('retrieve',$ns);
$server->wsdl->schemaTargetNamespace=$ns;
$server->wsdl->addComplexType('Question','complexType','struct','all',
    '',
    	array(
    	    'author'=>array('name'=>'author', 'type' => 'xsd:string'),
        	'questiontext'=>array('name'=>'questiontext', 'type' => 'xsd:string'),
        	'respright'=>array('name'=>'respright', 'type' => 'xsd:string')
        )	
);

$server->register('retrieve',array('x'=>'xsd:string'),array('z'=>'tns:Question'),$ns);

function retrieve($x){
	  
    $db = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
    $items = new Question();
    $items->author =null;
    $items->questiontext=null;
    $items->respright=null;
    if (!db){
        return $items;
    }
    else{ $result = mysqli_query($db,"SELECT * FROM questions WHERE ID=".$x); 
        if (mysqli_num_rows($result) == 0){return $items;}
        else{ 
            $row = mysqli_fetch_array($result);
            $items->author = $row['mail'];
            $items->questiontext=$row['q'];
            $items->respright=$row['repsRight'];
            return $items;
        }
    mysqli_close($db);
        
    }
        
    
}


if (!isset( $HTTP_RAW_POST_DATA )) {
$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
}
$server->service($HTTP_RAW_POST_DATA);

?>