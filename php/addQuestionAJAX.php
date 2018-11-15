<!DOCTYPE HTML>
<HTML>
<head> <title>Add Questions</title> 
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Add a question</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />
		   <style>body{background-image: url("../images/bg.jpg");background-color: #cccccc;}</style>
		   
  </head>
  <body>
      
              <?php
              
              function login()
{
	if(empty($_POST['mail']))
	{

		return false;
	}
	if(empty($_POST['pass']))
	{

		return false;
	}
	
	return true;
		
}  
              
              

    if (login()){ }else {exit("Not authorized.");}
            
include 'dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{	
		$varMail = $_POST['mail'];
		$varQ = $_POST['q'];
		$varRight = $_POST['respRight'];
		$varWr1 = $_POST['respWr1'];
		$varWr2 = $_POST['respWr2'];
		$varWr3 = $_POST['respWr3'];
		$varDif = $_POST['dif'];
		$varSub = $_POST['subj'];
		
		$validData= false;
		
		if(preg_match('/^([a-z]+)([0-9]{3})@ikasle\\.ehu\\.eus$/',$varMail)){
			if (preg_match('/^[0-5]$/',$varDif)){
				if(preg_match('/^\\S.{9,}$/',$varQ)){
					if(preg_match('/^\\S.*$/',$varRight)){
						if(preg_match('/^\\S.*$/',$varWr1)){
							if(preg_match('/^\\S.*$/',$varWr2)){
								if(preg_match('/^\\S.*$/',$varWr3)){
									if(preg_match('/^\\S.*$/',$varSub)){
										$validData=true;
									}
								}
							}
						}
					}
					
				}
				
			}
		}
		
		if (!$validData){echo"No cheating!";} else {
		
		$db = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
		if (!$db)
		{echo "Problem accessing the database. Try again, please.";}
		else{
			
			$sql = "INSERT INTO questions (mail, q, respRight, respWr1, respWr2, respWr3, dif,  subj) VALUES ('$varMail', '$varQ', '$varRight', '$varWr1', '$varWr2', '$varWr3', '$varDif', '$varSub')";
			$ema = mysqli_query($db,$sql);
			if (!$ema){echo "There has been an error trying to insert. Try again, please.";} else {
			echo "Your question has been added correctly! Feel free to add another one.";
						
			$xml = simplexml_load_file('../xml/questions.xml');
			$assessmentItem = $xml->addChild('assessmentItem');
			
			$assessmentItem->addAttribute('author',$varMail);
			$assessmentItem->addAttribute('subject',$varSub);
			$itemBody = $assessmentItem->addChild('itemBody');
			$p = $itemBody->addChild('p', $varQ);
			$correctResponse = $assessmentItem->addChild('correctResponse');
			$value = $correctResponse->addChild('value',$varRight);
			$incorrectResponses = $assessmentItem->addChild('incorrectResponses');
			$value = $incorrectResponses->addChild('value',$varWr1);
			$value = $incorrectResponses->addChild('value',$varWr2);
			$value = $incorrectResponses->addChild('value',$varWr3);
			$xml->asXML('../xml/questions.xml');
            
			}
		}
mysqli_close($db);} }

?>

</body>
</html>
