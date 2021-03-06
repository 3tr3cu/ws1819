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
		   
	<script src='../js/jquery-3.2.1.js'></script>
	<script> 
		$(document).ready(function(){
			
			$("form").submit(function(e){
			    
			    var email = new RegExp('^([a-z]+)([0-9]{3})@ikasle\\.ehu\\.eus$');
				var zailtasuna = new RegExp('^[0-5]$');
				var galdera = new RegExp('^\\S.{9,}$');
				
				var Val = $("#mail").val();
				if (email.test(Val))
				{
					Val = $("#q").val();
					if (galdera.test(Val))
					{
						Val = $("#dif").val();
						if (!zailtasuna.test(Val))
						{
							alert('Invalid difficulty number: choose from 0 to 5');
							e.preventDefault();
						}
						
					}
					else{
					alert('Invalid question: must be at least 10 characters');
					e.preventDefault();
					}
					
				} else {
				alert("Enter a valid ikasle.ehu.eus domain email");
				e.preventDefault();
				}
			});
			
		
		});
	
	</script>
	
  </head>
  <body>
      
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
              
              

            	if (login()){ 
	                
                	}else {exit("Not authorized.");}
            

	
	?>
      
  <div id='page-wrap'>
	<header class='main' id='h1'>
          You are currently logged in, <?php echo $_GET['mail'];?>. <span class='right'><a href='.\logOut.php'>Log Out</a></span>
	<h2>Add a Question</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='./layout.php<?php 
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>Home</a></span>
		<span><a href='/quizzes'>Quizzes</a></span>
		<span><a href='./credits.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>Credits</a></span>
		<span><a href='.\addQuestion.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>Add a question</a></span>
		<span><a href='.\ShowQuestions.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>See the questions (php)</a></span>
		<span><a href='.\showXMLQuestions.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>See the questions (xml)</a></span>
		<span><a href='.\handlingQuizesAJAX.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>Manage Quizzes (AJAX)</a></span>
		<span><a href='.\getquest.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>Consult Questions</a></span>
		
	</nav>
    <section class="main" id="s1">
        

	
		<form id="galderenF" name="galderenF" method="post" action=".\addQuestion.php<?php 
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>">
	
			Submitter Email:(*) <br>
			<input name="mail" id="mail" type="text" required></input> <br>
		
			Question:(*) <br>
			<input name="q" id="q" type="text" required></input> <br>
			
			Right Answer:(*) <br>
			<input name="respRight" type="text" required></input> <br>
			
			Wrong Answer 1:(*) <br>
			<input name="respWr1" type="text" required></input> <br>
		
			Wrong Answer 2:(*) <br>
			<input name="respWr2" type="text" required></input> <br>
			
			Wrong Answer 3:(*) <br>
			<input name="respWr3" type="text" required></input> <br>
		
			Difficulty:(*) <br>
			<input name="dif" id="dif" type="number" required></input> <br>
			
			Subject:(*) <br>
			<input name="subj" type="text" required></input> <br>
			
			(Fields marked as (*) are mandatory) <br>
	
			<input type="submit" id="bttn" name="sbmitBttn" value="Submit"></input> <input type="reset" id="rstbttn"></input> <br>
		
	</form>
	
	<?php 

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
            echo "Check the existing questions: <a href='.\ShowQuestions.php?mail=$usr&pass=$pass'>(php)</a> <a href='.\showXMLQuestions.php?mail=$usr&pass=$pass'> (xml)</a>";
			}
		}
mysqli_close($db);} }

?>
    </section>
	
	<footer class='main' id='f1'>
		 <a href='https://github.com/3tr3cu/ws1819'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>