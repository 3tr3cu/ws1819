<?php
              
              function login()
{
	if(empty($_GET['mail']))
	{

		return false;
	}
	if(empty($_GET['pass']))
	{

		return false;
	}
	
	return true;
		
}  
              
              
              if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            	if (login()){ 
	                
                	}else {exit("Not authorized.");}
            
        } else {exit("Not authorized.");}
	

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
    if ($ai['author']==$_GET['mail']){

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
