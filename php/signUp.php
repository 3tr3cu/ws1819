<?php
 session_start ();

?><!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quizzes</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
		   .important {text-decoration: underline;}
		   .navbar-collapse.collapse.in { display: block!important; }
		   #h1{font-size:small}</style>
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
    
    <span class="right"><a href=".\login.php">Log In</a> </span> | <span class="right"><a href=".\signUp.php">Sign up</a> </span>
    
	<h2>User Registration</h2>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Menu</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="layout.php">Home</a>
      <a class="nav-item nav-link" href="#">Quizzes</a>
      <a class="nav-item nav-link" href="credits.php">Credits</a>
	</div>
		</div>
	</nav>
    </header>



    <section class="main" id="s1">
        <br>
	

<div style="text-align: center;" >

<div  class="form-border"  >
		<form id="regF" name="regF" method="post">
			
			<div class="form-group">
			<label class="control-label" for="mail" >Email:</label> 				
   			 <input placeholder="Enter your email"  class="form-control" name="mail" id="mail" type="text" onchange="isemailok()" required></input>			
			</div>
		
			<div class="form-group">		
			<label  for="n" >Full name:</label> 
			<input placeholder="Enter your Name (at least one surname)"  class="form-control" name="n" id="n" type="text" required></input> 
			</div>

			<div class="form-group">	
			<label for="p" >Password:</label> 
			<input placeholder="Enter a password at least 8 characters long" class="form-control" name="p" id="p" type="password" onchange="ispassok()" required></input> 
			</div>

			<div class="form-group">
			<label for="p2" >Confirm password:</label>  
			<input placeholder="Confirm password"   class="form-control" name="p2" id="p2" type="password" required></input> 
			</div>

			<small id="emailHelp" class="form-text text-muted"></small>

			<p class="important">All fields are mandatory</p> 
	
			<input class="btn btn-lg btn-primary" type="submit" id="bttn" name="sbmitBttn" value="Register"></input> 
			<input class="btn btn-secondary btn-lg" type="reset" id="rstbttn" value="Reset"></input>
		
	</form>
</div>
</div>


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
				    $hash = password_hash($_POST['p'], PASSWORD_BCRYPT);
					$sql = "INSERT INTO users (mail, name, password) VALUES ('$varMail', '$varN', '$hash')";
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>