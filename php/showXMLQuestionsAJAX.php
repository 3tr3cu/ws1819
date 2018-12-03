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



if(!$xml)  { echo "No xml file was found<br>
Try again by refreshing, or <a href='./layout.php'> go back, please.</a>";} 

else{ if(empty($xml->children())) {
  
 echo "There is no information to display.";}
  else{ echo "
 
  <table border='1'>
<tr>
<th>Mail</th>
<th>Question</th>
<th>Right answer</th>

</tr>";

foreach ($xml->children() as $ai){
    if ($ai['author']==$_SESSION['usr']){

  echo "<tr>";
  echo "<td>" . $ai['author'] . "</td>";
  echo "<td>" . $ai->itemBody->p . "</td>";
  echo "<td>" . $ai->correctResponse->value . "</td>";
  echo "</tr>";
  }}
echo "</table> ";

  }
}
  ?>