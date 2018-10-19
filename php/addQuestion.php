<!DOCTYPE HTML>
<HTML>
<head> <title>Add Questions</title> </head>
<body>
<h1>Adding questions</h1>
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
		
		$db = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
		if (!$db)
		{echo "OOPSIE WOOPSIE!! Uwu We made a fucky wucky!! A wittle fucko boingo! The code monkeys at our headquarters are working VEWY HAWD to fix this!<br>
	gO BAWCK plz <a href='../addQuestion.html'>Twy again, pwease... (´w`U).</a>";}
		else{
			
			$sql = "INSERT INTO questions (mail, q, respRight, respWr1, respWr2, respWr3, dif,  subj) VALUES ('$varMail', '$varQ', '$varRight', '$varWr1', '$varWr2', '$varWr3', '$varDif', '$varSub')";
			$ema = mysqli_query($db,$sql);
			if (!$ema){echo "There has been an error trying to insert. <a href='../addQuestion.html'>Try again, please.</a>";} else {
			echo "Your question has been added correctly!<a href='../addQuestion.html'>Click here to add another one?</a> <a href='.\ShowQuestions.php'> Or maybe you'd like to consult the existing questions?</a>";
			}
		}
		exit;
		mysqli_close($db);} else {echo "You shall not pass!! \(=`^´=) <a href='../addQuestion.html'>Access the form.</a>";}
		




?>

</body>
</HTML>