<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{	
		$varMail = $_POST['mail'];
		$varQ = $_POST['q'];
		$varRight = $_POST['respRight'];
		$varWr1 = $_POST['respWr1'];
		$varWr2 = $_POST['respWr2'];
		$varWr3 = $_POST['respWr3'];
		$varDif = $_POST['dif'];
		$varSub = $_POST['Subj'];
		
		$db = mysqli_connect("localhost", "root", "", "quiz");
		if (!$db)
		{echo "OOPSIE WOOPSIE!! Uwu We made a fucky wucky!! A wittle fucko boingo! The code monkeys at our headquarters are working VEWY HAWD to fix this!"}
		exit;}




mysqli_close($db);

?>