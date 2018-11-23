<!DOCTYPE HTML>
<HTML>
<head> <title>Add Questions</title> </head>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Register</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />
		   <style>body{background-image: url("../images/bg.jpg");background-color: #cccccc;}
		   p{color: #ff0000}
		   </style>
		   
	<script src='../js/jquery-3.2.1.js'></script>
	<script> 
	var validMail;
	var validPass;
	
		$(document).ready(function(){
			
			$("form").submit(function(e){
				var email = new RegExp('^([a-z]+)([0-9]{3})@ikasle\\.ehu\\.eus$');
				var izena = new RegExp('^[A-Z][a-z]+( [A-Z][a-z]+)+$');
				var pasahitza = new RegExp('^\\S.{7,}$');
				
				var p1 = $("#p").val();
				var p2 = $("#p2").val()
				
				if (p1 == p2){
				
					var Val = $("#mail").val();
					if (email.test(Val))
					{
						Val = $("#n").val();
						if (izena.test(Val))
						{
							Val = $("#p").val();
							if (!pasahitza.test(Val))
							{
								alert('Invalid password. Must be at least 8 characters long without spaces.');
								e.preventDefault();
							} else if (validMail==false||validPass==false){
							    
							    alert('Invalid data.');
								e.preventDefault();
							}
						
						}
						else{
						alert('Invalid name. Please, watch your capitalization and do not leave any empty spaces.');
						e.preventDefault();
						}
					
					} else {
					alert("Enter a valid ikasle.ehu.eus domain email");
					e.preventDefault();
					}
				} else {
					alert("The two passwords don't match.");
				e.preventDefault();
				}
			});
			
		
		});
		
	function isemailok(){
		$.ajax({
			type:"GET",
			url: "./egiaztatuEmaila.php?mail="+$("#mail").val(),
			success: function(data){
				if (data=="BAI"){
					$("#mailvalidation").text("");
					validMail=true;
				}
				else if(data=="EZ"){
					$("#mailvalidation").text("Email must be part of the course.");
					validMail=false;
				}
				else {
					$("#mailvalidation").text("Validation failed due to external circumstances.");
					validMail=false;
				}
				
			} 
		});
	}
	
	function ispassok(){
		$.ajax({
			type: "GET",
			url: "./egiaztatuPasahitza.php?pass="+$("#p").val(),
			success: function(data){
				if (data=="BAI"){
					$("#passvalidation").text("");
					validPass=true;
				}
				else if(data=="EZ"){
					$("#passvalidation").text("Service denied");
					validPass=false;
				}
				else if (data="EZ2"){
				    $("#passvalidation").text("Not safe enough of a password.");
					validPass=false;
				}
				else if (data="DC") {
					$("#passvalidation").text("Validation failed due to external circumstances.");
					validPass=false;
				}
			}
		});
	}
	
	</script>
	
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      <span class="right"><a href=".\login.php">Log In</a> </span>
	  <span class="right"><a href='.\signUp.php'>Sign up</a> </span>
      <span class="right" style="display:none;"><a href="/logout">LogOut</a> </span>
	<h2>Sign Up</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='./layout.php'>Home</a></span>
		<span><a href='/quizzes'>Quizzes</a></span>
		<span><a href='./credits.php'>Credits</a></span>
	</nav>
    <section class="main" id="s1">
	
		<form id="regF" name="regF" method="post">
	
			Email: <br>
			<input name="mail" id="mail" type="text" onchange="isemailok()" required></input> <br>
		
			Full name (at least one surname): <br>
			<input name="n" id="n" type="text" required></input> <br>
			
			Password (at least 8 characters long): <br>
			<input name="p" id="p" type="password" onchange="ispassok()" required></input> <br>
			
			Confirm password: <br>
			<input name="p2" id="p2" type="password" required></input> <br>
			
			All fields are mandatory <br>
	
			<input type="submit" id="bttn" name="sbmitBttn" value="Submit"></input> <input type="reset" id="rstbttn"></input> <br>
		
	</form>
			<p id="mailvalidation"></p>
			<p id="passvalidation"></p>

	
	<?php 

include 'dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{	
		$varMail = $_POST['mail'];
		$varN = $_POST['n'];
		$varP = $_POST['p'];
		
		$validData= false;
		
		if(preg_match('/^([a-z]+)([0-9]{3})@ikasle\\.ehu\\.eus$/',$varMail)){
			if (preg_match('/^[A-Z][a-z]+( [A-Z][a-z]+)+$/',$varN)){
				if(preg_match('/^\\S{8,}$/',$varP)){
					
					$validData=true;		
				}
			}
		}	
		if (!$validData){echo"No cheating!";} else {
		    
			
				$db = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
				if (!$db){
					echo "Problem accessing the database. Try again, please.";}
				else{
					$sql = "INSERT INTO users (mail, name, password) VALUES ('$varMail', '$varN', '$varP')";
					$ema = mysqli_query($db,$sql);
					if (!$ema){
						echo "There has been an error. Try again, please.";
						} else {
						echo "Registered succesfully! Please log in to continue.";
					}
				}
				mysqli_close($db);
			
		} 
}
?>
    </section>
	
	<footer class='main' id='f1'>
		 <a href='https://github.com/3tr3cu/ws1819'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>