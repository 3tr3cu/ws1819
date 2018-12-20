<?php session_start ();
              
	function login()
	{
		if(!isset($_SESSION['usr']))
		{
			return false;
		}
		if(!isset($_SESSION['type']))
		{
			if($_SESSION['type']!=1)	return false;
		}
	return true;
	}              
	if (login()){ }else {exit("Not authorized.");}		

	$xml = simplexml_load_file("../xml/questions.xml");



if(!$xml)  { echo "Can't display your amount of questions: No xml file was found<br>
Try again by refreshing.</a>";} 

else{ if(empty($xml->children())) {
  
 echo "There are currently no questions saved..";}
  else{

$total =0; $yours =0;
foreach ($xml->children() as $ai){
$total++;
    if ($ai['author']==$_SESSION['usr']){
    $yours++;
  }}
echo "Number of entries by you: $yours/$total";

  }
}
  ?>